<?php

namespace App\Exports;

use App\Models\PartsDetail;
use Maatwebsite\Excel\Concerns\Exportable;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithStyles;
use PhpOffice\PhpSpreadsheet\Worksheet\Worksheet;

class PartsDetailExport implements FromCollection, WithHeadings, ShouldAutoSize, WithStyles
{
    use Exportable;

    public function __construct($request)
    {
        $this->fromDate = date($request->date_from);
        $this->toDate = date($request->date_to);
    }

    public function collection()
    {
        $result = [];
        $from_date = $this->fromDate;
        $to_date = $this->toDate;
        
        $partsDetails = PartsDetail::whereHas('warranty_claim', function ($query) use ($from_date, $to_date) {
            $query->whereDate('CreatedAt', '>=', $from_date);
            $query->whereDate('CreatedAt', '<=', $to_date);
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
 
        $partsDetails = collect($result);
        return $partsDetails;
    }

    public function headings(): array
    {
        return [
            'Id',
            'Product',
            'Engineer',
            'SPO',
            'Purpose',
            'Delivery Date',
            'Customer Code',
            'Customer Name',
            'Customer Number',
            'Chassis Number',
            'Parts Code',
            'Parts Name',
            'Quantity',
            'Price',
            'Status',
            'Pending Date',
            'Submitted Date',
            'Approved Date'
        ];
    }

    public function styles(Worksheet $sheet)
    {
        return [
            1    => ['font' => ['bold' => true]],
        ];
    }
}
