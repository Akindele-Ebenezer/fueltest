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

    public function index(Request $request) 
    {
    	
        $SampleNo = $request->SampleNo;   
        $SampleCollectionDate = $request->SampleCollectionDate; 
        $TruckPlateNo = $request->TruckPlateNo; 
        $TankNo = $request->TankNo; 
        $AppearanceResult = $request->AppearanceResult; 
        $Color = $request->Color; 
        $Density = $request->Density; 
        $FlashPoint = $request->FlashPoint; 
        $Temp = $request->Temp; 
        $WaterSediment = $request->WaterSediment; 
        $Cleanliness = $request->Cleanliness; 
        $DateOfTest = $request->DateOfTest; 
        $uid = $request->uid; 
        $MadeBy = $request->MadeBy; 
        $DeliveredTo = $request->DeliveredTo; 
        $Remarks = $request->Remarks; 
            
        $pdf = new FPDF();
        $pdf->AddPage();
        $pdf->SetLeftMargin(17);  
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
        $pdf->Cell(45, 10,'SAMPLE OF', 1, 0, 'C');
        $pdf->SetFont('Arial','B', 8);
        $pdf->Cell(32, 10, $SampleNo, 1, 0, 'C');
        $pdf->Cell(12.9, 10,'', 0, 0, '');

        $pdf->SetTextColor(9, 33, 81); 
        $pdf->SetFont('Arial','B', 10);
        $pdf->Cell(50, 10,'TRUCK NUMBER/SOURCE', 1, 0, 'C');
        $pdf->SetFont('Arial','B', 8);
        $pdf->Cell(37, 10, $TruckPlateNo, 1, 1, 'C');
        
        $pdf->SetTextColor(9, 33, 81); 
        $pdf->SetFont('Arial','B', 10);
        $pdf->Cell(45, 10,'DATE OF SAMPLING', 1, 0, 'C');
        $pdf->SetFont('Arial','B', 8);
        $pdf->Cell(32, 10, $SampleCollectionDate, 1, 0, 'C');
        $pdf->Cell(12.9, 10,'', 0, 0, '');

        $pdf->SetTextColor(9, 33, 81); 
        $pdf->SetFont('Arial','B', 10);
        $pdf->Cell(50, 10,'SAMPLE DRAWN BY', 1, 0, 'C');
        $pdf->SetFont('Arial','B', 8);
        $pdf->Cell(37, 10, $MadeBy, 1, 1, 'C');
        
        $pdf->SetTextColor(9, 33, 81); 
        $pdf->SetFont('Arial','B', 10);
        $pdf->Cell(45, 10,'DATE OF ANALYSIS', 1, 0, 'C');
        $pdf->SetFont('Arial','B', 8);
        $pdf->Cell(32, 10, $DateOfTest, 1, 0, 'C');
        $pdf->SetFont('Arial','B', 8);
        $pdf->Cell(12.9, 10,'', 0, 0, '');

        $pdf->SetTextColor(9, 33, 81); 
        $pdf->SetFont('Arial','B', 10);
        $pdf->Cell(50, 10,'DELIVERED TO', 1, 0, 'C');
        $pdf->SetFont('Arial','B', 8);
        $pdf->Cell(37, 10, $DeliveredTo, 1, 1, 'C');
        
        $pdf->SetTextColor(9, 33, 81); 
        $pdf->SetFont('Arial','B', 10);
        $pdf->Cell(45, 10,'DATE OF REPORTING', 1, 0, 'C');
        $pdf->SetFont('Arial','B', 8);
        $pdf->Cell(32, 10, $DateOfTest, 1, 0, 'C');
        $pdf->Cell(12.9, 10,'', 0, 0, '');

        $pdf->SetTextColor(9, 33, 81); 
        $pdf->SetFont('Arial','B', 10);
        $pdf->Cell(50, 10,'TANK NUMBER', 1, 0, 'C');
        $pdf->SetFont('Arial','B', 8);
        $pdf->Cell(37, 10, $TankNo, 1, 1, 'C');
        
        $pdf->Ln(); 

        $pdf->SetTextColor(9, 33, 81); 
        $pdf->SetFont('Arial','B', 10);
        $pdf->Cell(10, 10,'S/N', 1, 0, 'C');
        $pdf->Cell(33, 10,'PROPERTIES', 1, 0, 'C');
        $pdf->Cell(33, 10,'UNITS', 1, 0, 'C');
        $pdf->Cell(33, 10,'LIMITS (Min Max)', 1, 0, 'C');
        $pdf->Cell(33, 10,'TEST METHODS', 1, 0, 'C');
        $pdf->Cell(34.9, 10,'RESULT', 1, 1, 'C');
        
        $pdf->SetFont('Arial','', 8);
        $pdf->SetTextColor(89, 74, 74); 
        $pdf->Cell(10, 10,'1', 1, 0, 'C');
        $pdf->Cell(33, 10,'APPERANCE', 1, 0, 'C');
        $pdf->Cell(33, 10,'-', 1, 0, 'C');
        $pdf->Cell(33, 10,'BRIGHT AND CLEAR', 1, 0, 'C');
        $pdf->Cell(33, 10,'VISUAL', 1, 0, 'C');
        $pdf->Cell(34.9, 10, $AppearanceResult, 1, 1, 'C');
            
        $pdf->Cell(10, 10,'2', 1, 0, 'C');
        $pdf->Cell(33, 10,'COLOR', 1, 0, 'C');
        $pdf->Cell(33, 10,'-', 1, 0, 'C');
        $pdf->Cell(33, 10,'   -                 2.5   ', 1, 0, 'C');
        $pdf->Cell(33, 10,'D1500', 1, 0, 'C');
        $pdf->Cell(34.9, 10, $Color, 1, 1, 'C');
            
        $pdf->Cell(10, 10,'3', 1, 0, 'C');
        $pdf->Cell(33, 10,'DENSITY', 1, 0, 'C');
        $pdf->Cell(33, 10,'kg/m3', 1, 0, 'C');
        $pdf->Cell(33, 10,'   0.82                 0855   ', 1, 0, 'C');
        $pdf->Cell(33, 10,'D1298', 1, 0, 'C');
        $pdf->Cell(34.9, 10, $Density, 1, 1, 'C');
        
        $pdf->Cell(10, 10,'4', 1, 0, 'C');
        $pdf->Cell(33, 10,'FLASH POINT', 1, 0, 'C');
        $pdf->Cell(33, 10,'oC', 1, 0, 'C');
        $pdf->Cell(33, 10,'   52                 92   ', 1, 0, 'C');
        $pdf->Cell(33, 10,'D93', 1, 0, 'C');
        $pdf->Cell(34.9, 10, $FlashPoint, 1, 1, 'C');
            
        $pdf->Cell(10, 10,'5', 1, 0, 'C');
        $pdf->Cell(33, 10,'WATER / SEDIMEMT', 1, 0, 'C');
        $pdf->Cell(33, 10,'%', 1, 0, 'C');
        $pdf->Cell(33, 10,'   -                 0.050   ', 1, 0, 'C');
        $pdf->Cell(33, 10,'D2709', 1, 0, 'C');
        $pdf->Cell(34.9, 10, $WaterSediment, 1, 1, 'C');
            
        $pdf->Cell(10, 10,'6', 1, 0, 'C');
        $pdf->Cell(33, 10,'CLEANLINESS', 1, 0, 'C');
        $pdf->Cell(33, 10,'Mins', 1, 0, 'C');
        $pdf->Cell(33, 10,'   12                 15   ', 1, 0, 'C');
        $pdf->Cell(33, 10,'D2068', 1, 0, 'C');
        $pdf->Cell(34.9, 10, $Cleanliness, 1, 1, 'C'); 
            
        $pdf->Cell(0, 10,' ', 0, 1, 'C');  
        $pdf->Cell(0, 10,'REMARKS : ' . $Remarks, 0, 1);   

        $pdf->Cell(0, 10,' ', 0, 1, 'C');  
        $pdf->Cell(0, 2, $MadeBy, 0, 1);  
        
        $pdf->Cell(0, 5,' ', 0, 1, 'C');  
        $pdf->Cell(0, 8, $DateOfTest, 0, 1); 
        
        $pdf->Image('images/depasa-logo.png', 16, 225, 30);
        $pdf->Cell(33, 10,'', 0, 1, 'C');
        $pdf->SetFont('Arial','B', 7);
        $pdf->SetTextColor(9, 33, 81);  
        $pdf->Cell(38, 33,'AN ISO CERTIFIED COMPANY', 0, 0, 'C');
        $pdf->Image('images/iso.png', 20, 245, 30);
        

        $pdf->Output(); 

        exit;
    }

    public function show(Request $request) {
        
        $SampleNo = $request->SampleNo;   
        $SampleCollectionDate = $request->SampleCollectionDate; 
        $TruckPlateNo = $request->TruckPlateNo; 
        $TankNo = $request->TankNo; 
        $AppearanceResult = $request->AppearanceResult; 
        $Color = $request->Color; 
        $Density = $request->Density; 
        $FlashPoint = $request->FlashPoint; 
        $Temp = $request->Temp; 
        $WaterSediment = $request->WaterSediment; 
        $Cleanliness = $request->Cleanliness; 
        $DateOfTest = $request->DateOfTest; 
        $uid = $request->uid; 
        $MadeBy = $request->MadeBy; 
        $DeliveredTo = $request->DeliveredTo; 
        $Remarks = $request->Remarks; 
            
        $pdf = new FPDF();
        $pdf->AddPage();
        $pdf->SetLeftMargin(17);  
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
        $pdf->Cell(45, 10,'SAMPLE OF', 1, 0, 'C');
        $pdf->SetFont('Arial','B', 8);
        $pdf->Cell(22, 10, $SampleNo, 1, 0, 'C');
        $pdf->Cell(22.9, 10,'', 0, 0, '');

        $pdf->SetTextColor(9, 33, 81); 
        $pdf->SetFont('Arial','B', 10);
        $pdf->Cell(50, 10,'TRUCK NUMBER/SOURCE', 1, 0, 'C');
        $pdf->SetFont('Arial','B', 8);
        $pdf->Cell(37, 10, $TruckPlateNo, 1, 1, 'C');
        
        $pdf->SetTextColor(9, 33, 81); 
        $pdf->SetFont('Arial','B', 10);
        $pdf->Cell(45, 10,'DATE OF SAMPLING', 1, 0, 'C');
        $pdf->SetFont('Arial','B', 8);
        $pdf->Cell(22, 10, $SampleCollectionDate, 1, 0, 'C');
        $pdf->Cell(22.9, 10,'', 0, 0, '');

        $pdf->SetTextColor(9, 33, 81); 
        $pdf->SetFont('Arial','B', 10);
        $pdf->Cell(50, 10,'SAMPLE DRAWN BY', 1, 0, 'C');
        $pdf->SetFont('Arial','B', 8);
        $pdf->Cell(37, 10, $MadeBy, 1, 1, 'C');
        
        $pdf->SetTextColor(9, 33, 81); 
        $pdf->SetFont('Arial','B', 10);
        $pdf->Cell(45, 10,'DATE OF ANALYSIS', 1, 0, 'C');
        $pdf->SetFont('Arial','B', 8);
        $pdf->Cell(22, 10, $DateOfTest, 1, 0, 'C');
        $pdf->SetFont('Arial','B', 8);
        $pdf->Cell(22.9, 10,'', 0, 0, '');

        $pdf->SetTextColor(9, 33, 81); 
        $pdf->SetFont('Arial','B', 10);
        $pdf->Cell(50, 10,'DELIVERED TO', 1, 0, 'C');
        $pdf->SetFont('Arial','B', 8);
        $pdf->Cell(37, 10, $DeliveredTo, 1, 1, 'C');
        
        $pdf->SetTextColor(9, 33, 81); 
        $pdf->SetFont('Arial','B', 10);
        $pdf->Cell(45, 10,'DATE OF REPORTING', 1, 0, 'C');
        $pdf->SetFont('Arial','B', 8);
        $pdf->Cell(22, 10, $DateOfTest, 1, 0, 'C');
        $pdf->Cell(22.9, 10,'', 0, 0, '');

        $pdf->SetTextColor(9, 33, 81); 
        $pdf->SetFont('Arial','B', 10);
        $pdf->Cell(50, 10,'TANK NUMBER', 1, 0, 'C');
        $pdf->SetFont('Arial','B', 8);
        $pdf->Cell(37, 10, $TankNo, 1, 1, 'C');
        
        $pdf->Ln(); 

        $pdf->SetTextColor(9, 33, 81); 
        $pdf->SetFont('Arial','B', 10);
        $pdf->Cell(10, 10,'S/N', 1, 0, 'C');
        $pdf->Cell(33, 10,'PROPERTIES', 1, 0, 'C');
        $pdf->Cell(33, 10,'UNITS', 1, 0, 'C');
        $pdf->Cell(33, 10,'LIMITS (Min Max)', 1, 0, 'C');
        $pdf->Cell(33, 10,'TEST METHODS', 1, 0, 'C');
        $pdf->Cell(34.9, 10,'RESULT', 1, 1, 'C');
        
        $pdf->SetFont('Arial','', 8);
        $pdf->SetTextColor(89, 74, 74); 
        $pdf->Cell(10, 10,'1', 1, 0, 'C');
        $pdf->Cell(33, 10,'APPERANCE', 1, 0, 'C');
        $pdf->Cell(33, 10,'-', 1, 0, 'C');
        $pdf->Cell(33, 10,'BRIGHT AND CLEAR', 1, 0, 'C');
        $pdf->Cell(33, 10,'VISUAL', 1, 0, 'C');
        $pdf->Cell(34.9, 10, $AppearanceResult, 1, 1, 'C');
            
        $pdf->Cell(10, 10,'2', 1, 0, 'C');
        $pdf->Cell(33, 10,'COLOR', 1, 0, 'C');
        $pdf->Cell(33, 10,'-', 1, 0, 'C');
        $pdf->Cell(33, 10,'   -                 2.5   ', 1, 0, 'C');
        $pdf->Cell(33, 10,'D1500', 1, 0, 'C');
        $pdf->Cell(34.9, 10, $Color, 1, 1, 'C');
            
        $pdf->Cell(10, 10,'3', 1, 0, 'C');
        $pdf->Cell(33, 10,'DENSITY', 1, 0, 'C');
        $pdf->Cell(33, 10,'kg/m3', 1, 0, 'C');
        $pdf->Cell(33, 10,'   0.82                 0855   ', 1, 0, 'C');
        $pdf->Cell(33, 10,'D1298', 1, 0, 'C');
        $pdf->Cell(34.9, 10, $Density, 1, 1, 'C');
        
        $pdf->Cell(10, 10,'4', 1, 0, 'C');
        $pdf->Cell(33, 10,'FLASH POINT', 1, 0, 'C');
        $pdf->Cell(33, 10,'oC', 1, 0, 'C');
        $pdf->Cell(33, 10,'   52                 92   ', 1, 0, 'C');
        $pdf->Cell(33, 10,'D93', 1, 0, 'C');
        $pdf->Cell(34.9, 10, $FlashPoint, 1, 1, 'C');
            
        $pdf->Cell(10, 10,'5', 1, 0, 'C');
        $pdf->Cell(33, 10,'WATER / SEDIMEMT', 1, 0, 'C');
        $pdf->Cell(33, 10,'%', 1, 0, 'C');
        $pdf->Cell(33, 10,'   -                 0.050   ', 1, 0, 'C');
        $pdf->Cell(33, 10,'D2709', 1, 0, 'C');
        $pdf->Cell(34.9, 10, $WaterSediment, 1, 1, 'C');
            
        $pdf->Cell(10, 10,'6', 1, 0, 'C');
        $pdf->Cell(33, 10,'CLEANLINESS', 1, 0, 'C');
        $pdf->Cell(33, 10,'Mins', 1, 0, 'C');
        $pdf->Cell(33, 10,'   12                 15   ', 1, 0, 'C');
        $pdf->Cell(33, 10,'D2068', 1, 0, 'C');
        $pdf->Cell(34.9, 10, $Cleanliness, 1, 1, 'C'); 
            
        $pdf->Cell(0, 10,' ', 0, 1, 'C');  
        $pdf->Cell(0, 10,'REMARKS : ' . $Remarks, 0, 1);   

        $pdf->Cell(0, 10,' ', 0, 1, 'C');  
        $pdf->Cell(0, 2, $MadeBy, 0, 1);  
        
        $pdf->Cell(0, 5,' ', 0, 1, 'C');  
        $pdf->Cell(0, 8, $DateOfTest, 0, 1); 
        
        $pdf->Image('images/depasa-logo.png', 16, 225, 30);
        $pdf->Cell(33, 10,'', 0, 1, 'C');
        $pdf->SetFont('Arial','B', 7);
        $pdf->SetTextColor(9, 33, 81);  
        $pdf->Cell(38, 33,'AN ISO CERTIFIED COMPANY', 0, 0, 'C');
        $pdf->Image('images/iso.png', 20, 245, 30);
        

        $pdf->Output(); 

        exit;
    }
}
