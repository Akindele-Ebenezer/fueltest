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
use Maatwebsite\Excel\Facades\Excel;
use Maatwebsite\Excel\Concerns\WithColumnWidths;
use Maatwebsite\Excel\Concerns\WithColumnFormatting;
use Maatwebsite\Excel\Concerns\WithCustomValueBinder;
use PhpOffice\PhpSpreadsheet\Cell\DefaultValueBinder;
use PhpOffice\PhpSpreadsheet\Cell\Cell;

class FuelTestsExport extends DefaultValueBinder implements FromCollection, ShouldAutoSize, WithEvents, WithHeadings, WithColumnWidths,  WithCustomValueBinder
{
    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {
        return DynamicExport::orderBy('SampleNo', 'desc')->get(); 
        // return FuelTestRecord::orderBy('SampleNo', 'desc')->get(); 
    }
//////////////////
    public function bindValue(Cell $cell, $value)
    { 
        dd($cell->getValue());
        // $spreadsheet->getActiveSheet()->setCellValue('A1', 'PhpSpreadsheet');
        if ($value === 65) {
            $cell->setValueExplicit($value, 2);

            return true;
        }

        // else return default behavior
        return parent::bindValue($cell, $value);
    }
///////////////
    public function columnWidths(): array
    {
        return [
            'A' => 6,
        ];
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
                    'fill' => [
                        'fillType' => \PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID,
                        'color' => ['argb' => '835f5f']
                    ],
                    'font' => [
                        'bold' => true,
                        'color' => ['argb' => 'ffffff'],
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

                $styleArray3 = [
                    'font' => [
                        'bold' => true,
                        'name' => 'Britannic Bold',
                        'size' => 48,
                    ],
                ];

                $Heading = 'A3:V3';
                $event->sheet->getDelegate()->getStyle($Heading)->applyFromArray($styleArray);

                $Title = 'A2:F2';
                $event->sheet->getDelegate()->getStyle($Title)->applyFromArray($styleArray3);

                $NumberOfFuelTestRecords = DynamicExport::all()->count();
                $cellRange = 'A4:V' . $NumberOfFuelTestRecords + 3; 
                $event->sheet->getDelegate()->getStyle($cellRange)->applyFromArray($styleArray2);
                $event->sheet
                    ->getPageSetup()
                    ->setOrientation(\PhpOffice\PhpSpreadsheet\Worksheet\PageSetup::ORIENTATION_LANDSCAPE);
            },
        ];
    }
    
    public function headings(): array
    {
        return [
            [' '],
            [
                'Diesel Test Analysis', 
            ],
            [
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
            ]
        ];
    }
}
