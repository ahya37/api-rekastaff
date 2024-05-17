<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class HrdPosition extends Model
{
    use HasFactory;

    public static function getPosision($dbName)
    {
        $sql = "SELECT
                            `posisi`.`pos_idx`,
                            `posisi`.`pos_pom_idx`,
                            `posisi`.`pos_level`,
                            `posisi`.`pos_div_idx`
                        FROM  $dbName.`hrd_position` `posisi`, $dbName.`hrd_position_master` `posisiMaster`
                        WHERE 
                        `posisi`.`pos_pom_idx` = `posisiMaster`.`pom_idx`
                        and `posisi`.`pos_status` != 'X'";
                        
        return DB::select($sql);
    }
}
