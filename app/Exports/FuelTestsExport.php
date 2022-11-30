<?php

namespace App\Exports;

use App\Models\FuelTest;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;  
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithEvents;
use Maatwebsite\Excel\Events\AfterSheet;
use App\Models\FuelTestRecord;
use App\Models\DynamicExport;
use Illuminate\Support\Facades\DB;

class FuelTestsExport implements FromCollection, ShouldAutoSize, WithEvents, WithHeadings
{
    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {
        return DynamicExport::orderBy('SampleNo', 'desc')->get(); 
        // return FuelTestRecord::orderBy('SampleNo', 'desc')->get(); 
    }

    public function registerEvents(): array
    { 
        return [
            AfterSheet::class => function(AfterSheet $event) {
            //   dd($event);

                $styleArray = [
                    'alignment' => [
                        'horizontal' => \PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_LEFT,
                    ],
                    'borders' => [
                        'allBorders' => [
                            'borderStyle' => \PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN,
                            'color' => ['argb' => '000'],
                        ],
                    ],
                    'font' => [
                        'bold' => true,
                    ],
                ];

                $styleArray2 = [
                    'borders' => [
                        'allBorders' => [
                            'borderStyle' => \PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN,
                            'color' => ['argb' => '000'],
                        ],
                    ], 
                ];

                $Heading = 'A1:V1';
                $event->sheet->getDelegate()->getStyle($Heading)->applyFromArray($styleArray);

                $NumberOfFuelTestRecords = DynamicExport::all()->count();
                $cellRange = 'A2:V' . $NumberOfFuelTestRecords + 1; 
                $event->sheet->getDelegate()->getStyle($cellRange)->applyFromArray($styleArray2);
                
            },
        ];
    }
    
    public function headings(): array
    {
        return [
            '#',
            'SampleNo',
            'SampleCollectionDate',
            'TruckPlateNo',
            'TankNo',
            'AppearanceResult',
            'Color',
            'Density',
            'FlashPoint',
            'Temp',
            'WaterSediment',
            'Cleanliness',
            'DateOfTest',
            'uid',
            'MadeBy',
            'DeliveredTo',
            'Remarks',
            'VendorName',
            'VendorNo',
            'ApprovalForUse',
            'Created At',
            'Updated At',
        ];
    }
}
