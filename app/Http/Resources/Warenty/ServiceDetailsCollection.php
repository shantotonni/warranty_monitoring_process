<?php

namespace App\Http\Resources\Warenty;

use Illuminate\Http\Resources\Json\ResourceCollection;

class ServiceDetailsCollection extends ResourceCollection
{
    /**
     * Transform the resource collection into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    public function toArray($request)
    {
        return [
            'data'=>$this->collection->transform(function ($details){
                return [
                    'ServiceHistoryId' => $details->Id,
                    'Name' => $details->Name,
                    'DateOfService' => isset($details->serviceDetail) ? date('Y-m-d',strtotime($details->serviceDetail->DateOfService)) : '',
                    'Hours' => isset($details->serviceDetail) ? $details->serviceDetail->Hours : '',
                    'WarrantyClaimInfoId' => isset($details->serviceDetail) ? $details->serviceDetail->WarrantyClaimInfoId : '',
                    'ServiceHistoryDetail' => isset($details->serviceDetail) ? $details->serviceDetail->Id : '',
                ];
            })
        ];
    }
}
