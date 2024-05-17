<?php 

namespace App\Services;
use Illuminate\Support\Facades\DB;
use App\Models\HrdPosition;

class HrdPositionService {

    public static function getFullPositions($dbName)
    {
         // get data posisi
         $getPositions = HrdPosition::getPosision($dbName);
         $positions = [];
         foreach ($getPositions as $key => $value) {
             $positonName = DB::table("$dbName.hrd_position_master")->select('pom_name')->where('pom_idx', $value->pos_pom_idx)->first();
             $divisiName  = collect(DB::select("SELECT a.div_idx, b.dim_name, a.div_br_idx  from $dbName.hrd_division as a join $dbName.hrd_division_master as b on a.div_dim_idx = b.dim_idx  WHERE a.div_idx = '$value->pos_div_idx'"))->first();
             $branchName  = collect(DB::select("SELECT br_name  from $dbName.aps_branch WHERE br_idx = '$divisiName->div_br_idx'"))->first();
 
             $positions[] = [
                 'id' => $value->pos_idx,
                 'div_idx' => $divisiName->div_idx,
                 'text' => $positonName->pom_name.' --> '.$divisiName->dim_name. ' --> '.$branchName->br_name.' --> '.$value->pos_level
             ];
         }

         $data = [
            'total' =>count($getPositions),
            'results' => $positions
         ];
 
         return $data;
    }

}