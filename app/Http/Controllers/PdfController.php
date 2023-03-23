<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Codedge\Fpdf\Fpdf\Fpdf;

class PdfController extends Controller
{
    protected $fpdf;
 
    public function __construct()
    {
        $this->fpdf = new Fpdf;
    }

    public function index($SampleNo_, Request $request) 
    { 
        $Record = \App\Models\FuelTestRecord::where('SampleNo', $SampleNo_)->first();
        
        $SampleNo = $SampleNo_;   
        $SampleCollectionDate = $Record->SampleCollectionDate; 
        $TruckPlateNo = $Record->TruckPlateNo; 
        $TankNo = $Record->TankNo; 
        $AppearanceResult = $Record->AppearanceResult; 
        $Color = $Record->Color; 
        $Density = $Record->Density; 
        $FlashPoint = $Record->FlashPoint; 
        $Temp = $Record->Temp; 
        $WaterSediment = str_replace('<', '', $Record->WaterSediment); 
        $Cleanliness = $Record->Cleanliness; 
        $DateOfTest = $Record->DateOfTest; 
        $uid = $Record->uid; 
        $MadeBy = strtoupper($Record->MadeBy); 
        $DeliveredTo = $Record->DeliveredTo; 
        $Remarks = $Record->Remarks; 
        $VendorName = $Record->VendorName; 
        $VendorNo = $Record->VendorNo; 
        
        $ApprovalForUse = $Record->ApprovalForUse; 
               
        $pdf = new FPDF();
        $pdf->AddPage();
        $pdf->SetLeftMargin(9);  
        $pdf->SetFont('Arial','B',16); 
        $pdf->SetTextColor(9, 33, 81); 
        $pdf->SetDrawColor(89, 74, 74); 
        $pdf->SetTitle('Certificate for ' . $SampleNo);  
        $pdf->Cell( 40, 40, $pdf->Image('images/depasa-logo.png', 157, 21, 40));
        $pdf->Cell( 40, 40, $pdf->Image('images/certificate.png', 16.5, 10, 20));
        $pdf->Cell(0, 10,' ', 0, 1, 'C');  
        $pdf->Cell(0, 10,'DIESEL FUEL TEST', 2, 1, 'C');  
        $pdf->SetFont('Arial','',13); 
        $pdf->Cell(0, 10,'CERTIFICATE OF QUALITY', 0, 1, 'C'); 
        $pdf->Cell(0, 10,' ', 0, 1, 'C');  
         
        $pdf->SetTextColor(9, 33, 81); 
        $pdf->SetFont('Arial','B', 10);
        $pdf->Cell(45, 10,'SAMPLE NO', 1, 0, 'L');
        $pdf->SetFont('Arial','B', 8);
        $pdf->Cell(32, 10, $SampleNo, 1, 0, 'L');
        $pdf->Cell(30, 10,'', 0, 0, '');

        $pdf->SetTextColor(9, 33, 81); 
        $pdf->SetFont('Arial','B', 10);
        $pdf->Cell(50, 10,'TRUCK NUMBER/SOURCE', 1, 0, 'L');
        $pdf->SetFont('Arial','B', 8);
        $pdf->Cell(37, 10, $TruckPlateNo, 1, 1, 'L');
        
        $pdf->SetTextColor(9, 33, 81); 
        $pdf->SetFont('Arial','B', 10);
        $pdf->Cell(45, 10,'DATE OF SAMPLING', 1, 0, 'L');
        $pdf->SetFont('Arial','B', 8);
        $pdf->Cell(32, 10, $SampleCollectionDate, 1, 0, 'L');
        $pdf->Cell(30, 10,'', 0, 0, '');

        $pdf->SetTextColor(9, 33, 81); 
        $pdf->SetFont('Arial','B', 10);
        $pdf->Cell(50, 10,'SAMPLE DRAWN BY', 1, 0, 'L');
        $pdf->SetFont('Arial','B', 7);
        $pdf->Cell(37, 10, strlen($MadeBy) > 22 ? substr($MadeBy, 0, 22) . '..' : $MadeBy, 1, 1, 'L');
        
        $pdf->SetTextColor(9, 33, 81); 
        $pdf->SetFont('Arial','B', 10);
        $pdf->Cell(45, 10,'DATE OF ANALYSIS', 1, 0, 'L');
        $pdf->SetFont('Arial','B', 8);
        $pdf->Cell(32, 10, $DateOfTest, 1, 0, 'L');
        $pdf->SetFont('Arial','B', 8);
        $pdf->Cell(30, 10,'', 0, 0, '');

        $pdf->SetTextColor(9, 33, 81); 
        $pdf->SetFont('Arial','B', 10);
        $pdf->Cell(50, 10,'DELIVERED TO', 1, 0, 'L');
        $pdf->SetFont('Arial','B', 8);
        $pdf->Cell(37, 10, $DeliveredTo, 1, 1, 'L');
        
        $pdf->SetTextColor(9, 33, 81); 
        $pdf->SetFont('Arial','B', 10);
        $pdf->Cell(45, 10,'DATE OF REPORTING', 1, 0, 'L');
        $pdf->SetFont('Arial','B', 8);
        $pdf->Cell(32, 10, $DateOfTest, 1, 0, 'L');
        $pdf->Cell(30, 10,'', 0, 0, '');

        $pdf->SetTextColor(9, 33, 81); 
        $pdf->SetFont('Arial','B', 10);
        $pdf->Cell(50, 10,'TANK NUMBER', 1, 0, 'L');
        $pdf->SetFont('Arial','B', 8);
        $pdf->Cell(37, 10, $TankNo, 1, 1, 'L');
        
        $pdf->SetTextColor(9, 33, 81); 
        $pdf->SetFont('Arial','B', 10);
        $pdf->Cell(45, 10,'VENDOR NAME', 1, 0, 'L');
        $pdf->SetFont('Arial','B', 6);
        $pdf->Cell(32, 10, strlen($VendorName) > 22 ? substr($VendorName, 0, 22) . '..' : $VendorName, 1, 0, 'L');
        $pdf->Cell(30, 10,'', 0, 0, '');

        $pdf->SetTextColor(9, 33, 81); 
        $pdf->SetFont('Arial','B', 10);
        $pdf->Cell(50, 10,'VENDOR NUMBER', 1, 0, 'L');
        $pdf->SetFont('Arial','B', 8);
        $pdf->Cell(37, 10, $VendorNo, 1, 1, 'L');
        
        $pdf->Ln(); 

        $pdf->SetTextColor(9, 33, 81); 
        $pdf->SetFont('Arial','B', 10);
        $pdf->Cell(10, 10,'S/N', 1, 0, 'C');
        $pdf->Cell(33, 10,'PROPERTIES', 1, 0, 'L');
        $pdf->Cell(25, 10,'UNITS', 1, 0, 'L');
        $pdf->Cell(33, 10,'LIMITS (Min Max)', 1, 0, 'L');
        $pdf->Cell(33, 10,'TEST METHODS', 1, 0, 'L');
        $pdf->Cell(59.9, 10,'RESULT', 1, 1, 'C');
        
        $pdf->SetFont('Arial','', 8);
        $pdf->SetTextColor(89, 74, 74); 
        $pdf->Cell(10, 10,'1', 1, 0, 'L');
        $pdf->Cell(33, 10,'APPEARANCE', 1, 0, 'L');
        $pdf->Cell(25, 10,'-', 1, 0, 'L');
        $pdf->Cell(33, 10,'  BRIGHT AND CLEAR', 1, 0, 'L');
        $pdf->Cell(33, 10,'VISUAL', 1, 0, 'L');

        switch ($AppearanceResult) { 
            case 'Bright':
                $AppearanceResult_ = 'PASSED';
                break;

            case 'BRIGHT':
                $AppearanceResult_ = 'PASSED';
                break;                          

            case 'bright':
                $AppearanceResult_ = 'PASSED';
                break;                          

            case 'Clear':
                $AppearanceResult_ = 'PASSED';
                break;                          
            
            case 'CLEAR':
                $AppearanceResult_ = 'PASSED';
                break;                          
            
            
            case 'clear':
                $AppearanceResult_ = 'PASSED';
                break;                          
            
            default:
                $AppearanceResult_ = 'FAILED'; 
                break;
        } 

        $pdf->Cell(34.9, 10, $AppearanceResult, 1, 0, 'L');
        $pdf->Cell(24.9, 10, $AppearanceResult_, 1, 1, 'L');
        $pdf->SetTextColor(89, 74, 74); 
            
        $pdf->Cell(10, 10,'2', 1, 0, 'L');
        $pdf->Cell(33, 10,'COLOR', 1, 0, 'L');
        $pdf->Cell(25, 10,'-', 1, 0, 'L');
        $pdf->Cell(33, 10,'   -                       2.5   ', 1, 0, 'L');
        $pdf->Cell(33, 10,'D1500', 1, 0, 'L');

        switch ($Color) {
            case $Color <= 2.5:
                 $ColorResult = 'PASSED';
                break;                          
                 
            default:
                 $ColorResult = 'FAILED';                                
                 break;
        }  

        $pdf->Cell(34.9, 10, $Color, 1, 0, 'L');
        $pdf->Cell(24.9, 10, $ColorResult, 1, 1, 'L');
        $pdf->SetTextColor(89, 74, 74); 
            
        $pdf->Cell(10, 10,'3', 1, 0, 'L');
        $pdf->Cell(33, 10,'DENSITY', 1, 0, 'L');
        $pdf->Cell(25, 10,'kg/m3', 1, 0, 'L');
        $pdf->Cell(33, 10,'   0.82                 0.855   ', 1, 0, 'L');
        $pdf->Cell(33, 10,'D1298', 1, 0, 'L');
 
        switch ($Density) {
            case $Density <= 0.856 && $Density >= 0.82:
                $DensityResult = 'PASSED';
                break;                          
                
            default:
                $DensityResult = 'FAILED'; 
                break;
        }  

        $pdf->Cell(34.9, 10, $Density, 1, 0, 'L');
        $pdf->Cell(24.9, 10, $DensityResult, 1, 1, 'L');
        $pdf->SetTextColor(89, 74, 74); 
        
        $pdf->Cell(10, 10,'4', 1, 0, 'L');
        $pdf->Cell(33, 10,'FLASH POINT', 1, 0, 'L');
        $pdf->Cell(25, 10,'oC', 1, 0, 'L');
        $pdf->Cell(33, 10,'   52                    92   ', 1, 0, 'L');
        $pdf->Cell(33, 10,'D93', 1, 0, 'L');
 
        switch ($FlashPoint) {
            case $FlashPoint <= 92 && $FlashPoint >= 52:
                $DensityResult = 'PASSED';
                break;                          
                
            default:
                $DensityResult = 'FAILED';
                break;
        } 

        $pdf->Cell(34.9, 10, $FlashPoint, 1, 0, 'L');
        $pdf->Cell(24.9, 10, $DensityResult, 1, 1, 'L');
        $pdf->SetTextColor(89, 74, 74); 
            
        $pdf->Cell(10, 10,'5', 1, 0, 'L');
        $pdf->Cell(33, 10,'WATER / SEDIMEMT', 1, 0, 'L');
        $pdf->Cell(25, 10,'%', 1, 0, 'L');
        $pdf->Cell(33, 10,'   -                       0.050   ', 1, 0, 'L');
        $pdf->Cell(33, 10,'D2709', 1, 0, 'L');

        switch ($WaterSediment) {
            case $WaterSediment <= 0.050:
                $WaterSedimentResult = 'PASSED';
                break;                          
            
            default:
                $WaterSedimentResult = 'FAILED';
                break;
        } 

        $pdf->Cell(34.9, 10, $WaterSediment, 1, 0, 'L');
        $pdf->Cell(24.9, 10, $WaterSedimentResult, 1, 1, 'L');
        $pdf->SetTextColor(89, 74, 74); 
            
        $pdf->Cell(10, 10,'6', 1, 0, 'L');
        $pdf->Cell(33, 10,'CLEANLINESS', 1, 0, 'L');
        $pdf->Cell(25, 10,'Mins', 1, 0, 'L');
        $pdf->Cell(33, 10,'   -                       15   ', 1, 0, 'L');
        $pdf->Cell(33, 10,'D2068', 1, 0, 'L');
 
        switch ($Cleanliness) {
            case $Cleanliness <= 15:
                $CleanlinessResult = 'PASSED';
                break;      
                
            case $Cleanliness === 'OK':
                $CleanlinessResult = 'PASSED';
                break;         

            default:
                $CleanlinessResult = 'FAILED';
                break;   
        } 
        
        $pdf->Cell(34.9, 10, $Cleanliness, 1, 0, 'L'); 
        $pdf->Cell(24.9, 10, $CleanlinessResult, 1, 1, 'L');
        $pdf->SetTextColor(89, 74, 74);  
        $pdf->Cell(0, 10,' ', 0, 1, 'C');  
        $pdf->MultiCell(130, 5, 'REMARKS : ' . $Remarks, 0, 1);   

        $pdf->Ln(); 
        $pdf->Cell(65, 10, ' ', 0, 0, 'C'); 
        $pdf->Cell(35, 5, 'APPROVAL FOR USE = ', 0, 0, 'C');

        switch ($ApprovalForUse) {
            case 'REJECTED':
                $pdf->SetFillColor(255, 110, 110);
                break;
            
            case 'APPROVED':
                $pdf->SetFillColor(185, 255, 155);
                break;

            default:
                $pdf->SetFillColor(255, 245, 211);
                break;
        }
 
        $pdf->Cell(17, 5, "[  " . $ApprovalForUse . "  ]", 0, 1, 'C', 1); 

        $pdf->Cell(0, 10,' ', 0, 1, 'C');  
        $pdf->Cell(0, 2, $MadeBy, 0, 1);  
        
        $pdf->Cell(0, 2,' ', 0, 1, 'C');  
        $pdf->Cell(0, 8, $DateOfTest, 0, 1); 
        
        $pdf->Image('images/user-signature.png', 72.5, 209, 65); 
        $pdf->Cell(230, 8, $DateOfTest, 0, 1, 'C'); 
        $pdf->Image('images/depasa-signature.png', 10, 250, 30); 
         
        $pdf->Output(); 

        exit;
    }
}
