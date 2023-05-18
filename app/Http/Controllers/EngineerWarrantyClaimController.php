<?php

namespace App\Http\Controllers;

use App\Http\Resources\Warenty\ServiceDetailsCollection;
use App\Models\Document;
use App\Models\Parts;
use App\Models\PartsDetail;
use App\Models\Product;
use App\Models\ServiceHistory;
use App\Models\ServiceHistoryDetail;
use App\Models\User;
use App\Models\WarrantyClaimInfo;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Image;

class EngineerWarrantyClaimController extends Controller
{
    public function index()
    {
        $warrantyClaims = WarrantyClaimInfo::paginate(10);
        return view('admin.warranty_claim_info.list', compact('warrantyClaims'));
    }

    public function create()
    {
    }

    public function store(Request $request)
    {
    }

    public function show($id)
    {
        $warranty = WarrantyClaimInfo::with('serviceDetail')->where('id', $id)->first();
        $serviceHisHeadings = ServiceHistory::with(['serviceDetail' => function ($query) use ($warranty) {
            $query->where('WarrantyClaimInfoId', $warranty->Id);
        }])->get();

        $data = new ServiceDetailsCollection($serviceHisHeadings);
        $result = collect($data);
        $result = $result['data'];

        if ($warranty->ProductId == "1") {
            return view('admin.engineer_warranty_claim.tractor_claim_warranty_show', compact('warranty', 'serviceHisHeadings', 'result'));
        }
        if ($warranty->ProductId == "2") {
            return view('admin.engineer_warranty_claim.harvester_claim_warranty_show', compact('warranty'));
        }
        if ($warranty->ProductId == "4") {
            return view('admin.engineer_warranty_claim.harvester_lovol_claim_warranty_show', compact('warranty'));
        }
    }

    public function edit($id)
    {
        $warranty = WarrantyClaimInfo::findOrFail($id);
        $serviceHisHeadings = ServiceHistory::all();
        $serviceHisDetails = ServiceHistoryDetail::all();

        if ($warranty->ProductId == "1") {
            return view('admin.engineer_warranty_claim.tractor_claim_warranty', compact('warranty', 'serviceHisHeadings', 'serviceHisDetails'));
        }
        if ($warranty->ProductId == "2") {
            return view('admin.engineer_warranty_claim.harvester_claim_warranty', compact('warranty'));
        }
        if ($warranty->ProductId == "4") {
            return view('admin.engineer_warranty_claim.harvester_lovol_claim_warranty', compact('warranty'));
        }
    }

    public function update(Request $request, $id)
    {
        
        if ($request->ProductId == 1) {
            DB::beginTransaction();

            try {

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
                    'fileNames' => 'required',
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
                $warranty->Status = "Submitted";
                $warranty->UpdatedAt = Carbon::now();
                $warranty->SubmittedTime = Carbon::now();

                if ($warranty->save()) {
                    $warranty->serviceDetail()->delete();
                    for ($i = 1; $i <= 9; $i++) {
                        $serviceHist = new ServiceHistoryDetail;
                        $serve = 'service' . $i;
                        $hr = 'hour' . $i;
                        if ($request->$serve != null) {
                            $serviceHist->ServiceHistoryId = $i;
                            $serviceHist->WarrantyClaimInfoId = $warranty->Id;
                            $serviceHist->DateOfService = $request->$serve;
                            $serviceHist->Hours = $request->$hr;
                            $serviceHist->CreatedAt = Carbon::now();
                            $serviceHist->save();
                        }
                    }
                    if ($request->hasFile('fileNames')) {
                        $files = $request->file('fileNames');
                        foreach ($files as $file) {
                            $filename = time() . rand() . '.' . $file->getClientOriginalExtension();
                            $file->move(public_path('warranty_claim_image'), $filename);

                            Document::create([
                                'WarrantyClaimInfoId' => $warranty->Id,
                                'Name' => $filename,
                                'CreatedAt' => Carbon::now()
                            ]);
                        }
                        DB::commit();
                    }
                }
            } catch (\Exception $e) {
                DB::rollback();
                return $e;
            }
        }

        if ($request->ProductId == 2) {
            DB::beginTransaction();

            try {
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
                    'fileNames' => 'required',
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
                $warranty->Status = "Submitted";
                $warranty->UpdatedAt = Carbon::now();
                $warranty->SubmittedTime = Carbon::now();

                if ($warranty->save()) {
                    if ($request->hasFile('fileNames')) {
                        $files = $request->file('fileNames');
                        foreach ($files as $file) {
                            $filename = time() . rand() . '.' . $file->getClientOriginalExtension();
                            $file->move(public_path('warranty_claim_image'), $filename);

                            Document::create([
                                'WarrantyClaimInfoId' => $warranty->Id,
                                'Name' => $filename,
                                'CreatedAt' => Carbon::now()
                            ]);
                        }
                        DB::commit();
                    }
                }
            } catch (\Exception $e) {
                DB::rollback();
                return $e;
            }
        }
        
        if ($request->ProductId == 4) {
            // dd($request->all());
            DB::beginTransaction();

            try {
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
                    'FailureDate' => 'required',
                    'FailureArea' => 'required',
                    'RepairDate' => 'required',
                    'WarrantyClaimDate' => 'required',
                    'fileNames' => 'required',
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
                $warranty->FailureDate = $request->FailureDate;
                $warranty->FailureArea = $request->FailureArea;
                $warranty->RepairDate = $request->RepairDate;
                $warranty->WarrantyClaimDate = $request->WarrantyClaimDate;
                $warranty->Status = "Submitted";
                $warranty->UpdatedAt = Carbon::now();
                $warranty->SubmittedTime = Carbon::now();

                if ($warranty->save()) {
                    if ($request->hasFile('fileNames')) {
                        $files = $request->file('fileNames');
                        foreach ($files as $file) {
                            $filename = time() . rand() . '.' . $file->getClientOriginalExtension();
                            $file->move(public_path('warranty_claim_image'), $filename);

                            Document::create([
                                'WarrantyClaimInfoId' => $warranty->Id,
                                'Name' => $filename,
                                'CreatedAt' => Carbon::now()
                            ]);
                        }
                        
                    }

                    // insert supplier codes
                    $partsCodes = $request->partsCode;
                    $supplierCodes = $request->supplierCode;
                    $countPartsCode = count($request->partsCode);
                    // dd($partsCodes);
                    for($i=0; $i < $countPartsCode; $i++){
                        $part = $partsCodes[$i];
                        $supplier = $supplierCodes[$i];
                        DB::statement("UPDATE PartsDetail SET SupplierCode='$supplier' 
                            WHERE PartsNumber='$part' AND WarrantyclaiminfoId='$id'");
                    }
                    DB::commit();
                }
            } catch (\Exception $e) {
                DB::rollback();
                return $e;
            }
        }


        return redirect(route('claim-warranty.index'))->with('success', 'Engineer Warranty Claim submitted successfully');
    }


    public function destroy($id)
    {
        $warranty = WarrantyClaimInfo::findOrFail($id);
        $warranty->parts()->delete();
        $warranty->delete();
        return redirect(route('claim-warranty.index'))->with('success', 'Warranty Claim Info deleted successfully');
    }
}
