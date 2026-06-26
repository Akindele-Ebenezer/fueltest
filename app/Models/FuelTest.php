<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class FuelTest extends Model
{
    
    protected $fillable = ['SampleNo',
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
                            'Remarks'
                        ];
    use HasFactory;
}
