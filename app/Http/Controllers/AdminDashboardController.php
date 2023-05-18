<?php

namespace App\Http\Controllers;

use App\Models\Document;
use App\Models\WarrantyClaimInfo;
use Carbon\Carbon;
use Illuminate\Contracts\Session\Session;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Response;
use Illuminate\Support\Facades\Session as FacadesSession;
use Image;
use ZipArchive;

class AdminDashboardController extends Controller
{
    public function index()
    {
        $warrantyClaims = WarrantyClaimInfo::paginate(10);
        return view('admin.main_dashboard.dashboard', compact('warrantyClaims'));
    }

    public function create()
    {
    }

    public function store(Request $request)
    {
    }

    public function show($id)
    {
        $warranty = WarrantyClaimInfo::findOrFail($id);

        if($warranty->ProductId == "1"){
            return view('admin.engineer_warranty_claim.tractor_claim_warranty_show', compact('warranty'));
        }
        if($warranty->ProductId == "2"){
            return view('admin.engineer_warranty_claim.harvester_claim_warranty_show', compact('warranty'));
        }
    }

    public function edit($id)
    {
        $warranty = WarrantyClaimInfo::findOrFail($id);

        if($warranty->ProductId == "1"){
            return view('admin.engineer_warranty_claim.tractor_claim_warranty', compact('warranty'));
        }
        if($warranty->ProductId == "2"){
            return view('admin.engineer_warranty_claim.harvester_claim_warranty', compact('warranty'));
        }

    }

    public function update(Request $request, $id)
    {
        if($request->ProductId == 1){
            $request->validate([
                'CustomerName' => 'required',
                'CustomerCode' => 'required',
                'CustomerNumber' => 'required',
                'ChassisNumber' => 'required',
                'Model' => 'required',
                'PoliceStation' => 'required',
                'EngineNo' => 'required',
                'DistrictName' => 'required',
                'Oparation' => 'required',
                'State' => 'required',
                'Attachment' => 'required',
                'DealerName' => 'required',
                'DateOfSale' => 'required',
                'RunningHour' => 'required',
                'Aggregates' => 'required',
                'DateOfComplaint' => 'required',
                'DateOfRepair' => 'required',
                'CustomerComplaint' => 'required',
                'SEAnalysis' => 'required',
                'ActionToken' => 'required',
            ]);

            $warranty = WarrantyClaimInfo::findOrFail($id);
            $warranty->CustomerName = $request->CustomerName;
            $warranty->CustomerCode = $request->CustomerCode;
            $warranty->CustomerNumber = $request->CustomerNumber;
            $warranty->ChassisNumber = $request->ChassisNumber;
            $warranty->Model = $request->Model;
            $warranty->PoliceStation = $request->PoliceStation;
            $warranty->EngineNo = $request->EngineNo;
            $warranty->DistrictName = $request->DistrictName;
            $warranty->Oparation = $request->Oparation;
            $warranty->State = $request->State;
            $warranty->Attachment = $request->Attachment;
            $warranty->DealerName = $request->DealerName;
            $warranty->DateOfSale = $request->DateOfSale;
            $warranty->RunningHour = $request->RunningHour;
            $warranty->Aggregates = $request->Aggregates;
            $warranty->DateOfComplaint = $request->DateOfComplaint;
            $warranty->DateOfRepair = $request->DateOfRepair;
            $warranty->CustomerComplaint = $request->CustomerComplaint;
            $warranty->SEAnalysis = $request->SEAnalysis;
            $warranty->ActionToken = $request->ActionToken;
            $warranty->UpdatedAt = Carbon::now();
            $warranty->save();
        }
        if($request->ProductId == 2){
            $request->validate([
                'CustomerName' => 'required',
                'CustomerCode' => 'required',
                'CustomerNumber' => 'required',
                'ChassisNumber' => 'required',
                'Model' => 'required',
                'Upazila' => 'required',
                'EngineNo' => 'required',
                'DistrictName' => 'required',
                'DeliveryDate' => 'required',
                'WorkingHour' => 'required',
                'CustomerComplaint' => 'required',
                'SEAnalysis' => 'required',
                'MQRNumber' => 'required',
                'JobCardNo' => 'required',
                'MQRDate' => 'required',
                'JobCardDate' => 'required',
            ]);

            $warranty = WarrantyClaimInfo::findOrFail($id);
            $warranty->CustomerName = $request->CustomerName;
            $warranty->CustomerCode = $request->CustomerCode;
            $warranty->CustomerNumber = $request->CustomerNumber;
            $warranty->ChassisNumber = $request->ChassisNumber;
            $warranty->Model = $request->Model;
            $warranty->Upazila = $request->Upazila;
            $warranty->EngineNo = $request->EngineNo;
            $warranty->DistrictName = $request->DistrictName;
            $warranty->DeliveryDate = $request->DeliveryDate;
            $warranty->WorkingHour = $request->WorkingHour;
            $warranty->CustomerComplaint = $request->CustomerComplaint;
            $warranty->SEAnalysis = $request->SEAnalysis;
            $warranty->MQRNumber = $request->MQRNumber;
            $warranty->JobCardNo = $request->JobCardNo;
            $warranty->MQRDate = $request->MQRDate;
            $warranty->JobCardDate = $request->JobCardDate;
            $warranty->UpdatedAt = Carbon::now();
            $warranty->save();
        }

        return redirect(route('admin-dashboard.index'))->with('success', 'Warranty Claim info Updated successfully');
    }

    public function destroy($id)
    {
        $warranty = WarrantyClaimInfo::findOrFail($id);
        $warranty->parts()->delete();
        $warranty->delete();
        return redirect(route('admin-dashboard.index'))->with('success', 'Warranty Claim Info deleted successfully');
    }

    public function uploadApprovalImage(Request $request)
    {
        $warranty = WarrantyClaimInfo::findOrFail($request->dataId);

        if ($request->hasFile('ApprovalImage')) {
            $file = $request->file('ApprovalImage');
            // foreach ($files as $file) {
                $filename = time() . rand() . '.' . $file->getClientOriginalExtension();
                $file->move(public_path('images/approval_images'), $filename);

                $warranty->ApprovalImage = $filename;
                $warranty->Status = "Approved";
                $warranty->ApprovedTime = Carbon::now();
                $warranty->save();
                
            // }
        }

        // return redirect(route('claim-warranty.index'))->with('success', 'Approval File uploaded successfully');
        return response()->json(['success'=>'Approval uploaded successfully','warrantyId'=>$request->dataId]);
        
    }

    public function downloadApprovalImage(Request $request)
    {
        $warranty = WarrantyClaimInfo::findOrFail($request->downloadId);

        $filepath = public_path('images/approval_images/').$warranty->ApprovalImage;
        return Response::download($filepath);
    }

    public function downloadEngineerFiles(Request $request)
    {

            $filesName = Document::where('WarrantyClaimInfoId', $request->warranty_claim_id)->get();

            foreach($filesName as $key => $value)
            {
                $imgarr[] = public_path('/')."warranty_claim_image". '/' . $value->Name;
            }
            //dd($imgarr);
            if(file_exists(public_path('attachment.zip'))){
                unlink(public_path('attachment.zip'));
            
            }

            $zip      = new ZipArchive;
            $fileName = 'attachment.zip';
            if ($zip->open(public_path($fileName), ZipArchive::CREATE) === TRUE) {
            //   $files = File::files(public_path('/').'/warranty_claim_image');

            foreach ($imgarr as $file) {
                $relativeName = basename($file);
                $zip->addFile($file,$relativeName);
              }
              $zip->close();
            }
            return response()->download(public_path($fileName));
    }

    public function additionalInfoNeed(Request $request)
    {
        $warrantyClaim = WarrantyClaimInfo::findOrFail($request->warranty_claim_info_id);
        $warrantyClaim->AdditionalInfo = $request->AdditionalInfo;
        $warrantyClaim->Status = "Pending";
        $warrantyClaim->save();

        return redirect(route('claim-warranty.index'))->with('success', 'Additional info submitted successfully');
    }


}
