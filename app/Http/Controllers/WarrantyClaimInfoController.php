<?php

namespace App\Http\Controllers;

use App\Exports\PartsDetailExport;
use App\Models\Parts;
use App\Models\PartsDetail;
use App\Models\Product;
use App\Models\User;
use App\Models\UserArea;
use App\Models\WarrantyClaimInfo;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use Maatwebsite\Excel\Facades\Excel;
use DB;

class WarrantyClaimInfoController extends Controller
{
    public function index(Request $request)
    {
        $user = Auth::user();
        $data = [];
        $data['ChassisNo'] = $request->ChassisNo;
        $data['CustomerCode'] = $request->CustomerCode;
        $data['Status'] = $request->Status;
        $data['Purpose'] = $request->Purpose;
        $data['ProductId'] = $request->ProductId;
        $data['date_from'] = $request->date_from;
        $data['date_to'] = $request->date_to;

        $warrantyClaims = WarrantyClaimInfo::query()->where(function ($query) use ($user) {
            if ($user->RoleId == 1) {
                $query->where('SPOId', $user->Id);
            } elseif ($user->RoleId == 3) {
                $query->where('EngineerId', $user->Id);
            }
        })->where('Status','!=','Inactive');

        if($data['Status']){
            $warrantyClaims = $warrantyClaims->where('Status', $data['Status']);
        }
        if ($data['ProductId']){
            $warrantyClaims = $warrantyClaims->where('ProductId', $data['ProductId']);
        }
        if ($data['Purpose']){
            $warrantyClaims = $warrantyClaims->where('Purpose', $data['Purpose']);
        }
        if ($data['ChassisNo']){
            $warrantyClaims = $warrantyClaims->where('ChassisNumber', 'LIKE', '%'.$data['ChassisNo'].'%');
        }
        if ($data['CustomerCode']){
            $warrantyClaims = $warrantyClaims->where('CustomerCode', 'LIKE', '%'.$data['CustomerCode'].'%');
        }
        if ($data['date_from'] && $data['date_to']){
            $warrantyClaims = $warrantyClaims->whereBetween('CreatedAt', [$data['date_from'],$data['date_to']]);
        }

        if ($request->export != 'Y'){
            $warrantyClaims = $warrantyClaims->orderBy('Id', 'desc')->paginate(10);
            $warrantyClaims->appends($request->all());
        }else{

            $result = [];
            $partsDetails = PartsDetail::whereHas('warranty_claim', function ($query) use ($data) {
                if ($data['date_from'] && $data['date_to']){
                    $query->whereDate('CreatedAt', '>=', $data['date_from']);
                    $query->whereDate('CreatedAt', '<=', $data['date_to']);
                }
                if ($data['Status']){
                    $query->where('Status',$data['Status']);
                }
                if ($data['ProductId']){
                    $query->where('ProductId',$data['ProductId']);
                }
            })->get();

            foreach ($partsDetails as $parts) {
                $result[] = [
                    'Id' => $parts->Id,
                    'Product' => $parts->warranty_claim->product->Name,
                    'Engineer' => $parts->warranty_claim->engineer->Name,
                    'SPO' => $parts->warranty_claim->spo->Name,
                    'Purpose' => $parts->warranty_claim->Purpose,
                    'DeliveryDate' => $parts->warranty_claim->DeliveryDate,
                    'CustomerCode' => $parts->warranty_claim->CustomerCode,
                    'CustomerName' => $parts->warranty_claim->CustomerName,
                    'CustomerNumber' => $parts->warranty_claim->CustomerNumber,
                    'ChassisNumber' => $parts->warranty_claim->ChassisNumber,
                    'PartsCode' => $parts->PartsNumber,
                    'PartsName' => $parts->PartsName,
                    'Quantity' => $parts->Quantity,
                    'Price' => $parts->Price,
                    'Status' => $parts->warranty_claim->Status,
                    'PendingTime' => $parts->warranty_claim->CreatedAt,
                    'SubmittedTime' => $parts->warranty_claim->SubmittedTime,
                    'ApprovedTime' => $parts->warranty_claim->ApprovedTime
                ];
            }

            $this->exportexcel($result,'Warranty');
        }

        return view('admin.warranty_claim_info.list', compact('warrantyClaims','data'));
    }

    public function inactiveWarrentyClaimList()
    {
        $inputs = ['Status'=>"", 'ProductId'=>"", 'ChassisNo'=>''];
        $user = Auth::user();
        // dd($user);
        $warrantyClaims = WarrantyClaimInfo::where(function ($query) use ($user) {
            if ($user->RoleId == 1) {
                $query->where('SPOId', $user->Id);
            } elseif ($user->RoleId == 3) {
                $query->where('EngineerId', $user->Id);
            }
        })->orderBy('Id', 'desc')->where('Status','=','Inactive')->paginate(10);

        return view('admin.warranty_claim_info.inactive_list', compact('warrantyClaims','inputs'));
    }

    public function create()
    {
        $products = Product::all();
        $engineers = UserArea::where('RegionId', Auth::user()->RegionId)->get();
        // dd($engineers);
        // $allParts = Parts::orderBy('PartsCode', 'asc')->get();
        $allParts = DB::select("SELECT ProductCode,ProductName,UnitPrice from
                    [192.168.100.25].MotorSparePartsMirror.dbo.Product as P
                    WHERE P.Business IN('Q','W') order by ProductCode asc");

        return view('admin.warranty_claim_info.create', compact('products', 'engineers', 'allParts'));
    }

    public function store(Request $request)
    {
        // return $request->all();

        $request->validate([
            'ProductId' => 'required',
            'EngineerId' => 'required',
            'CustomerCode' => 'required',
            'CustomerName' => 'required',
            'CustomerNumber' => 'required',
            'ChassisNumber' => 'required',
            'Status' => 'required',
            'Purpose' => 'required',
            // 'PartsName' => 'required',
            // 'PartsNumber' => 'required',
            // 'Quantity' => 'required',
            // 'Price' => 'required',
        ]);

        $warranty = new WarrantyClaimInfo;
        $warranty->ProductId = $request->ProductId;
        $warranty->EngineerId = $request->EngineerId;
        $warranty->SPOId = Auth::user()->Id;
        $warranty->CustomerCode = $request->CustomerCode;
        $warranty->CustomerName = $request->CustomerName;
        $warranty->CustomerNumber = $request->CustomerNumber;
        $warranty->ChassisNumber = $request->ChassisNumber;
        $warranty->Status = $request->Status;
        $warranty->Purpose = $request->Purpose;
        $warranty->WarrantyDone = 0;
        $warranty->InvoiceDone = 0;
        // $warranty->DeliveryDate = date('Y-m-d H:i:s');
        $warranty->CreatedAt = Carbon::now();

        if ($warranty->save()) {
            foreach ($request->group_a as $part) {
                // $partsIdWiseDetail = Parts::where('PartsCode', $part['PartsCode'])->first();
                $partId = $part['PartsCode'];
                $partsIdWiseDetail = DB::select("SELECT ProductCode,ProductName,UnitPrice from
                                    [192.168.100.25].MotorSparePartsMirror.dbo.Product as P
                                    WHERE P.ProductCode='$partId'")[0];
                $partsDetail = new PartsDetail;
                $partsDetail->PartsName = $partsIdWiseDetail->ProductName;
                $partsDetail->PartsNumber = $partsIdWiseDetail->ProductCode;
                $partsDetail->Quantity = $part['Quantity'];
                $partsDetail->Price = $partsIdWiseDetail->UnitPrice * $part['Quantity'];
                $partsDetail->CreatedAt = Carbon::now();
                $partsDetail->WarrantyclaiminfoId = $warranty->Id;
                $partsDetail->save();
            }
        }

        $smscontent = 'আপনার নামে নতুন ওয়ারেন্টি ক্লেইম করা হয়েছে। কাস্টমার কোডঃ '.$request->CustomerCode;
        $replacedNumber = str_replace("-","",$warranty->engineer->Mobile);
        // $replacedNumber = "01322 901274";
        $mobileno = str_replace(" ","",$replacedNumber);

        $to = $mobileno;
        $sId = '8809617615000';
        $applicationName = 'Motors Service';
        $moduleName = 'Warranty Claim';
        $otherInfo = 'W';
        $userId = Auth::user()->Id;
        $vendor = 'smsq';
        $message = $smscontent;
        $message = $this->sendSmsQ($to, $sId, $applicationName, $moduleName, $otherInfo, $userId, $vendor, $message);

        return redirect(route('claim-warranty.index'))->with('success', 'Warranty Claim info created successfully');
    }

    public function show($id)
    {
        $warranty = WarrantyClaimInfo::findOrFail($id);

        return view('admin.warranty_claim_info.show', compact('warranty'));
    }

    public function edit($id)
    {
        $products = Product::all();
        $engineers = UserArea::where('RegionId', Auth::user()->RegionId)->get();
        // dd($engineers);
        $allParts = Parts::orderBy('PartsCode', 'asc')->get();
        $warranty = WarrantyClaimInfo::findOrFail($id);
        $partsDetails = PartsDetail::where('WarrantyclaiminfoId', $id)->get();
        // dd($warranty->parts);
        return view('admin.warranty_claim_info.edit', compact('products', 'engineers', 'allParts', 'warranty', 'partsDetails'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'ProductId' => 'required',
            'EngineerId' => 'required',
            'CustomerCode' => 'required',
            'CustomerName' => 'required',
            'CustomerNumber' => 'required',
            'ChassisNumber' => 'required',
            'Status' => 'required',
            'Purpose' => 'required',
            // 'PartsName' => 'required',
            // 'PartsNumber' => 'required',
            // 'Quantity' => 'required',
            // 'Price' => 'required',
        ]);

        $warranty = WarrantyClaimInfo::findOrFail($id);
        $warranty->ProductId = $request->ProductId;
        $warranty->EngineerId = $request->EngineerId;
        $warranty->CustomerCode = $request->CustomerCode;
        $warranty->CustomerName = $request->CustomerName;
        $warranty->CustomerNumber = $request->CustomerNumber;
        $warranty->ChassisNumber = $request->ChassisNumber;
        $warranty->Status = $request->Status;
        $warranty->Purpose = $request->Purpose;
        $warranty->UpdatedAt = Carbon::now();

        if ($warranty->save()) {
            foreach ($warranty->parts as $delete_parts) {
                $delete_parts->delete();
            }
            foreach ($request->group_a as $part) {
                // $partsIdWiseDetail = Parts::where('PartsCode', $part['PartsCode'])->first();
                $partId = $part['PartsCode'];
                $partsIdWiseDetail = DB::select("SELECT ProductCode,ProductName,UnitPrice from
                                    [192.168.100.25].MotorSparePartsMirror.dbo.Product as P
                                    WHERE P.ProductCode='$partId'")[0];
                $partsDetail = new PartsDetail;
                $partsDetail->PartsName = $partsIdWiseDetail->ProductName;
                $partsDetail->PartsNumber = $partsIdWiseDetail->ProductCode;
                $partsDetail->Quantity = $part['Quantity'];
                $partsDetail->Price = $partsIdWiseDetail->UnitPrice * $part['Quantity'];
                $partsDetail->UpdatedAt = Carbon::now();
                $partsDetail->WarrantyclaiminfoId = $warranty->Id;
                $partsDetail->save();
            }
        }

        $smscontent = 'আপনার নামে নতুন ওয়ারেন্টি ক্লেইম করা হয়েছে। কাস্টমার কোডঃ '.$request->CustomerCode;
        $replacedNumber = str_replace("-","",$warranty->engineer['Mobile']);
        // $replacedNumber = "01322 901274";
        $mobileno = str_replace(" ","",$replacedNumber);

        $to = $mobileno;
        $sId = '8809617615000';
        $applicationName = 'Motors Service';
        $moduleName = 'Warranty Claim';
        $otherInfo = 'W';
        $userId = Auth::user()->Id;
        $vendor = 'smsq';
        $message = $smscontent;
        $message = $this->sendSmsQ($to, $sId, $applicationName, $moduleName, $otherInfo, $userId, $vendor, $message);

        return redirect(route('claim-warranty.index'))->with('success', 'Warranty Claim info updated successfully');
    }

    public function destroy($id)
    {
        $warranty = WarrantyClaimInfo::findOrFail($id);
        $warranty->Status = 'Inactive';
        $warranty->save();
        //$warranty->parts()->delete();
        //$warranty->serviceDetail()->delete();
        //$warranty->documents()->delete();
        //$warranty->delete();
        return redirect(route('claim-warranty.index'))->with('success', 'Warranty Claim Info deleted successfully');
    }

    public function searchByPartsNumber(Request $request)
    {
        // return $request->all();
        $parts = Parts::where('PartsCode', 'LIKE', '%' . $request->search . '%')->get();
        foreach ($parts as $part) {
            $allParts[] = ['id' => $part->PartsCode, 'text' => $part->PartsCode];
        }

        return response()->json($allParts);
    }

    public function getPartsByCode($selectedParts)
    {
        // return $request->all();
        // $parts = Parts::where('PartsCode', '=', $selectedParts)->first();
        $parts = DB::select("SELECT ProductCode,ProductName,UnitPrice from
                [192.168.100.25].MotorSparePartsMirror.dbo.Product as P
                WHERE P.ProductCode='$selectedParts'");
        // foreach($parts as $part){
        //     $allParts[] = ['id'=>$part->PartsCode, 'text'=>$part->PartsCode];
        // }

        return $parts;
    }

    public function exportWarrantyClaimInfoTable(Request $request)
    {
        return Excel::download(new PartsDetailExport($request), 'warranty_claim_infos_export.xlsx');
    }

    public function searchWarrantyClaimInfoByStatus(Request $request)
    {
        $user = Auth::user();
        $data = [];
        $data['ChassisNo'] = $request->ChassisNo;
        $data['CustomerCode'] = $request->CustomerCode;
        $data['Status'] = $request->Status;
        $data['ProductId'] = $request->ProductId;
        $data['date_from'] = $request->date_from;
        $data['date_to'] = $request->date_to;

        $warrantyClaims = WarrantyClaimInfo::query()->where(function ($query) use ($user) {
            if ($user->RoleId == 1) {
                $query->where('SPOId', $user->Id);
            } elseif ($user->RoleId == 3) {
                $query->where('EngineerId', $user->Id);
            }
        });

        if($data['Status']){
            $warrantyClaims = $warrantyClaims->where('Status', $data['Status']);
        }
        if ($data['ProductId']){
            $warrantyClaims = $warrantyClaims->where('ProductId', $data['ProductId']);
        }
        if ($data['ChassisNo']){
            $warrantyClaims = $warrantyClaims->where('ChassisNumber', 'LIKE', '%'.$data['ChassisNo'].'%');
        }
        if ($data['CustomerCode']){
            $warrantyClaims = $warrantyClaims->where('CustomerCode', 'LIKE', '%'.$data['CustomerCode'].'%');
        }
        if ($data['date_from'] && $data['date_to']){
            $warrantyClaims = $warrantyClaims->whereBetween('CreatedAt', [$data['date_from'],$data['date_to']]);
        }

        if ($request->export != 'Y'){
            $warrantyClaims = $warrantyClaims->orderBy('Id', 'desc')->paginate(10);
        }else{
            $result = [];
            $partsDetails = PartsDetail::whereHas('warranty_claim', function ($query) use ($data) {
                $query->whereDate('CreatedAt', '>=', $data['date_from']);
                $query->whereDate('CreatedAt', '<=', $data['date_to']);
                if ($data['Status']){
                    $query->where('Status',$data['Status']);
                }
                if ($data['ProductId']){
                    $query->where('ProductId',$data['ProductId']);
                }

            })->with('warranty_claim')->get();

            foreach ($partsDetails as $parts) {
                $result[] = [
                    'Id' => $parts->Id,
                    'Product' => $parts->warranty_claim->product->Name,
                    'Engineer' => $parts->warranty_claim->engineer->Name,
                    'SPO' => $parts->warranty_claim->spo->Name,
                    'Purpose' => $parts->warranty_claim->Purpose,
                    'DeliveryDate' => $parts->warranty_claim->DeliveryDate,
                    'CustomerCode' => $parts->warranty_claim->CustomerCode,
                    'CustomerName' => $parts->warranty_claim->CustomerName,
                    'CustomerNumber' => $parts->warranty_claim->CustomerNumber,
                    'ChassisNumber' => $parts->warranty_claim->ChassisNumber,
                    'PartsCode' => $parts->PartsNumber,
                    'PartsName' => $parts->PartsName,
                    'Quantity' => $parts->Quantity,
                    'Price' => $parts->Price,
                    'Status' => $parts->warranty_claim->Status,
                    'PendingTime' => $parts->warranty_claim->CreatedAt,
                    'SubmittedTime' => $parts->warranty_claim->SubmittedTime,
                    'ApprovedTime' => $parts->warranty_claim->ApprovedTime
                ];
            }

            $this->exportexcel($result,'Warranty');

        }

        return view('admin.warranty_claim_info.list', compact('warrantyClaims', 'data'));
    }

    public function exportexcel($result,$filename){
        for($i=0; $i<count($result); $i++){
            unset($result[$i]['PageNo']);
        }

        $arrayheading[0] = array_keys($result[0]);
        $result = array_merge($arrayheading, $result);

        header("Content-Disposition: attachment; filename=\"{$filename}.xls\"");
        header("Content-Type: application/vnd.ms-excel;");
        header("Pragma: no-cache");
        header("Expires: 0");
        $out = fopen("php://output", 'w');
        fputs( $out, "\xEF\xBB\xBF" ); // UTF-8 BOM !!!!!

        foreach ($result as $data)
        {
            fputcsv($out, $data);
        }

        fclose($out);
        exit();
    }

    public function searchWarrantyClaimInfoByChassisNo(Request $request)
    {
        $user = Auth::user();
        $data = [];
        $data['ChassisNo'] = $request->ChassisNo;
        $data['CustomerCode'] = $request->CustomerCode;
        $data['Status'] = $request->Status;
        $data['ProductId'] = $request->ProductId;
        $data['date_from'] = $request->date_from;
        $data['date_to'] = $request->date_to;

        $warrantyClaims = WarrantyClaimInfo::where(function ($query) use ($user) {
            if ($user->RoleId == 1) {
                $query->where('SPOId', $user->Id);
            } elseif ($user->RoleId == 3) {
                $query->where('EngineerId', $user->Id);
            }
        });
        if($inputs['ChassisNo'] != ""){
            $warrantyClaims = $warrantyClaims->where('ChassisNumber', 'LIKE', '%'.Session::get('ChassisNo').'%');
        }
        if($inputs['CustomerCode'] != ""){
            $warrantyClaims = $warrantyClaims->where('CustomerCode', 'LIKE', '%'.Session::get('CustomerCode').'%');
        }

        $warrantyClaims = $warrantyClaims->orderBy('Id', 'desc')->paginate(10);

        return view('admin.warranty_claim_info.list', compact('warrantyClaims', 'inputs'));
    }

    public function AdminWarrantyClaimDone($id)
    {
        $warrantyClaim = WarrantyClaimInfo::findOrFail($id);
        $warrantyClaim->WarrantyDone = 1;
        $warrantyClaim->save();
        return redirect(route('claim-warranty.index'));
    }

    public function SpoInvoiceClaimDone($id)
    {
        $warrantyClaim = WarrantyClaimInfo::findOrFail($id);
        $warrantyClaim->InvoiceDone = 1;
        $warrantyClaim->save();
        return redirect(route('claim-warranty.index'));
    }

    public function AdminAskingPartsToSpo($id)
    {
        $warrantyClaim = WarrantyClaimInfo::findOrFail($id);
        $warrantyClaim->AskingParts = 1;
        $warrantyClaim->save();
        return redirect(route('claim-warranty.index'));
    }

    public function warrantyClaimLockUnlock($id){
        $warrantyClaim = WarrantyClaimInfo::findOrFail($id);
        if ($warrantyClaim->Locked == 0){
            $warrantyClaim->Locked = 1;
        }else{
            $warrantyClaim->Locked = 0;
        }
        $warrantyClaim->save();
        return redirect()->back()->with('success', 'Changed successfully');
    }

    public function sendsms($ip, $userid, $password, $smstext, $receipient) {
        $smsUrl = "http://{$ip}/httpapi/sendsms?userId={$userid}&password={$password}&smsText=" . $smstext . "&commaSeperatedReceiverNumbers=" . $receipient;
        //echo $smsUrl; exit();
        $response = file_get_contents($smsUrl);
        //print_r($response); exit();
        return json_decode($response);
    }

    public static function sendSmsQ($to, $sId, $applicationName, $moduleName, $otherInfo, $userId, $vendor, $message)
    {
        $curl = curl_init();
        curl_setopt_array($curl, array(
            CURLOPT_URL => 'http://192.168.102.10/apps/api/send-sms/sms-master',
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => '',
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 0,
            CURLOPT_FOLLOWLOCATION => true,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => 'POST',
            CURLOPT_POSTFIELDS => 'To='.$to.'&SID='.$sId.'&ApplicationName='.urlencode($applicationName).'&ModuleName='.urlencode($moduleName).'&OtherInfo='.urlencode($otherInfo).'&userID='.$userId.'&Message='.$message.'&SmsVendor='.$vendor,
            CURLOPT_HTTPHEADER => array(
                'Content-Type: application/x-www-form-urlencoded'
            ),
            CURLOPT_SSL_VERIFYPEER => false,
            CURLOPT_SSL_VERIFYHOST => false
        ));
        $response = curl_exec($curl);

        curl_close($curl);
        return $response;
    }
}
