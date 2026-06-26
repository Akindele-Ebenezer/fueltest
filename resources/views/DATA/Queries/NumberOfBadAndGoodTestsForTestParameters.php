<?php 

    $NumberOfGoodTestsForAppearanceResult = App\Models\FuelTestRecord::whereIn('AppearanceResult', ['BRIGHT', 'CLEAR'])  
                                                            ->count();
    $NumberOfBadTestsForAppearanceResult = App\Models\FuelTestRecord::whereNotIn('AppearanceResult', ['BRIGHT', 'CLEAR'])  
                                                            ->count();
                     
    $AggregateForAppearanceResult = $NumberOfGoodTestsForAppearanceResult + $NumberOfBadTestsForAppearanceResult;                                                                
    
    $PercentageForGoodTestsForAppearanceResult = $AggregateForAppearanceResult === 0 ? 0 : ($NumberOfGoodTestsForAppearanceResult / $AggregateForAppearanceResult * 100);
    $PercentageForBadTestsForAppearanceResult = $AggregateForAppearanceResult === 0 ? 0 : ($NumberOfBadTestsForAppearanceResult / $AggregateForAppearanceResult * 100);

    $NumberOfGoodTestsForColor = App\Models\FuelTestRecord::where('Color', '<=', 2.5)  
                                                                ->count();
    $NumberOfBadTestsForColor = App\Models\FuelTestRecord::where('Color', '>', 2.5)  
                                                                ->count();

    $AggregateForColor = $NumberOfGoodTestsForColor + $NumberOfBadTestsForColor;    
    // dd($NumberOfGoodTestsForColor);
    $PercentageForGoodTestsForColor = $AggregateForColor === 0 ? 0 : ($NumberOfGoodTestsForColor / $AggregateForColor * 100);
    $PercentageForBadTestsForColor = $AggregateForColor === 0 ? 0 : ($NumberOfBadTestsForColor / $AggregateForColor * 100);

    $NumberOfGoodTestsForDensity = App\Models\FuelTestRecord::whereBetween('Density', [0.82, 0.855]) 
                                                            ->count();
    $NumberOfBadTestsForDensity = App\Models\FuelTestRecord::whereNotBetween('Density', [0.82, 0.855]) 
                                                            ->count();

    $AggregateForDensity = $NumberOfGoodTestsForDensity + $NumberOfBadTestsForDensity;    
    
    $PercentageForGoodTestsForDensity = $AggregateForDensity === 0 ? 0 : ($NumberOfGoodTestsForDensity / $AggregateForDensity * 100);
    $PercentageForBadTestsForDensity = $AggregateForDensity === 0 ? 0 : ($NumberOfBadTestsForDensity / $AggregateForDensity * 100);

    $NumberOfGoodTestsForFlashPoint = App\Models\FuelTestRecord::whereBetween('FlashPoint', [52, 92]) 
                                                                ->count();
    $NumberOfBadTestsForFlashPoint = App\Models\FuelTestRecord::whereNotBetween('FlashPoint', [52, 92]) 
                                                                ->count();
                
    $AggregateForFlashPoint = $NumberOfGoodTestsForFlashPoint + $NumberOfBadTestsForFlashPoint;    
    
    $PercentageForGoodTestsForFlashPoint = $AggregateForFlashPoint === 0 ? 0 : ($NumberOfGoodTestsForFlashPoint / $AggregateForFlashPoint * 100);
    $PercentageForBadTestsForFlashPoint = $AggregateForFlashPoint === 0 ? 0 : ($NumberOfBadTestsForFlashPoint / $AggregateForFlashPoint * 100);

    $NumberOfGoodTestsForWaterSediment = App\Models\FuelTestRecord::whereBetween('WaterSediment', [0, 0.050]) 
                                                                    ->count();
    $NumberOfBadTestsForWaterSediment = App\Models\FuelTestRecord::where('WaterSediment', '>', 0.050)
                                                                    ->count();

    $AggregateForWaterSediment = $NumberOfGoodTestsForWaterSediment + $NumberOfBadTestsForWaterSediment;    
    
    $PercentageForGoodTestsForWaterSediment = $AggregateForWaterSediment === 0 ? 0 : ($NumberOfGoodTestsForWaterSediment / $AggregateForWaterSediment * 100);
    $PercentageForBadTestsForWaterSediment = $AggregateForWaterSediment === 0 ? 0 : ($NumberOfBadTestsForWaterSediment / $AggregateForWaterSediment * 100);

    $NumberOfGoodTestsForCleanliness = App\Models\FuelTestRecord::whereBetween('Cleanliness', [12, 15]) 
                                                                ->count();
    $NumberOfBadTestsForCleanliness = App\Models\FuelTestRecord::whereNotBetween('Cleanliness', [12, 15]) 
                                                                ->count();
                    
    $AggregateForCleanliness = $NumberOfGoodTestsForCleanliness + $NumberOfBadTestsForCleanliness;    
    
    $PercentageForGoodTestsForCleanliness = $AggregateForCleanliness === 0 ? 0 : ($NumberOfGoodTestsForCleanliness / $AggregateForCleanliness * 100);
    $PercentageForBadTestsForCleanliness = $AggregateForCleanliness === 0 ? 0 : ($NumberOfBadTestsForCleanliness / $AggregateForCleanliness * 100);
