<?php 

namespace App\Services;

use App\Models\City;
use App\Models\TokenManagement;

class CityService {

    public static function getFullCity($dbName)
    {
        $getCities = City::getCities($dbName);
        $results   = [];
        foreach ($getCities as $value) {
            $results[] = [
                'id' => $value->ct_idx.'|'. $value->pr_id,
                'text' => $value->ct_name.' --> '. $value->pr_name
            ];
        }
        
         $data = [
            'total' => count($getCities),
            'results' => $results
         ];

         return $data;
    }
    
}