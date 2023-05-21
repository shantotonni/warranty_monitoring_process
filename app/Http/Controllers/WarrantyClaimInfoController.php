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
    public function index()
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
        })->orderBy('Id', 'desc')->paginate(10);

        return view('admin.warranty_claim_info.list', compact('warrantyClaims','inputs'));
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

        $respons = $this->sendsms($ip = '192.168.100.213', $userid = 'motors', $password = 'Asdf1234', $smstext = urlencode($smscontent), $receipient = urlencode($mobileno));


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

        $respons = $this->sendsms($ip = '192.168.100.213', $userid = 'motors', $password = 'Asdf1234', $smstext = urlencode($smscontent), $receipient = urlencode($mobileno));



        return redirect(route('claim-warranty.index'))->with('success', 'Warranty Claim info updated successfully');
    }

    public function destroy($id)
    {
        $warranty = WarrantyClaimInfo::findOrFail($id);
        $warranty->parts()->delete();
        $warranty->serviceDetail()->delete();
        $warranty->documents()->delete();
        $warranty->delete();
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
        $inputs['Status'] = "";
        $inputs['ProductId'] = "";
        $inputs['ChassisNo'] = "";
        // dd($inputs);

        if($request->has('Status')){
            Session::put('Status', $request->Status);
            Session::put('ProductId', $request->ProductId);
        }
        $inputs['Status'] = Session::get('Status');
        $inputs['ProductId'] = Session::get('ProductId');
        // dd(Session::get('Status'));
        $warrantyClaims = WarrantyClaimInfo::where(function ($query) use ($user) {
            if ($user->RoleId == 1) {
                $query->where('SPOId', $user->Id);
            } elseif ($user->RoleId == 3) {
                $query->where('EngineerId', $user->Id);
            }
        });
        if($inputs['Status'] != "" && $inputs['ProductId'] != ""){
            $warrantyClaims = $warrantyClaims->where('Status', Session::get('Status'))
                                ->where('ProductId', Session::get('ProductId'))
                                ->orderBy('Id', 'desc')->paginate(10);
        }
        if($inputs['Status'] != "" && $inputs['ProductId'] == ""){
            $warrantyClaims = $warrantyClaims->where('Status', Session::get('Status'))
                                ->orderBy('Id', 'desc')->paginate(10);
        }
        if($inputs['Status'] == "" && $inputs['ProductId'] != ""){
            $warrantyClaims = $warrantyClaims->where('ProductId', Session::get('ProductId'))
                                ->orderBy('Id', 'desc')->paginate(10);
        }
        if($inputs['Status'] == "" && $inputs['ProductId'] == ""){
            $warrantyClaims = $warrantyClaims->orderBy('Id', 'desc')->paginate(10);
        }

        return view('admin.warranty_claim_info.list', compact('warrantyClaims', 'inputs'));
    }

    // public function searchWarrantyClaimInfoByProduct(Request $request)
    // {
    //     $user = Auth::user();
    //     $productId = $request->ProductId;
    //     $inputs['ProductId'] = "";
    //     $inputs['Status'] = "";
    //     // dd($inputs);

    //     if($request->has('ProductId')){
    //         Session::put('ProductId', $request->ProductId);
    //     }
    //     $inputs['ProductId'] = Session::get('ProductId');
    //     // dd(Session::get('ProductId'));
    //     $warrantyClaims = WarrantyClaimInfo::where(function ($query) use ($user) {
    //         if ($user->RoleId == 1) {
    //             $query->where('SPOId', $user->Id);
    //         } elseif ($user->RoleId == 3) {
    //             $query->where('EngineerId', $user->Id);
    //         }
    //     })->where('ProductId', Session::get('ProductId'))->orderBy('Id', 'desc')->paginate(10);

    //     return view('admin.warranty_claim_info.list', compact('warrantyClaims', 'inputs'));
    // }

    public function searchWarrantyClaimInfoByChassisNo(Request $request)
    {
        $user = Auth::user();
        $inputs['ChassisNo'] = "";
        $inputs['Status'] = "";
        $inputs['ProductId'] = "";

        if($request->has('ChassisNo')){
            Session::put('ChassisNo', $request->ChassisNo);
        }
        $inputs['ChassisNo'] = Session::get('ChassisNo');

        $warrantyClaims = WarrantyClaimInfo::where(function ($query) use ($user) {
            if ($user->RoleId == 1) {
                $query->where('SPOId', $user->Id);
            } elseif ($user->RoleId == 3) {
                $query->where('EngineerId', $user->Id);
            }
        });
        if($inputs['ChassisNo'] != ""){
            $warrantyClaims = $warrantyClaims->where('ChassisNumber', 'LIKE', '%'.Session::get('ChassisNo').'%')
                                ->orderBy('Id', 'desc')->paginate(10);
        }

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
}
