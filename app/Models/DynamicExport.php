<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DynamicExport extends Model
{
    protected $fillable = [
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
                        ]; 
 
    use HasFactory;
}
