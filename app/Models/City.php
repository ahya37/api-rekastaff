<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class City extends Model
{
    use HasFactory;

    public static function getCities($dbName)
    {
        return DB::select("SELECT
                    `city`.`ct_idx`,
                    `city`.`ct_provid`,
                    `city`.`ct_name`,
                    `provinsi`.`pr_id`,
                    `provinsi`.`pr_name`
                    FROM  $dbName.`tb_city` city, $dbName.`tb_provinsi` provinsi
                    WHERE `city`.`ct_provid` = `provinsi`.`pr_id` AND 
                    `city`.`ct_status` != 'X' AND `provinsi`.`pr_status` != 'X' ORDER BY `city`.`ct_name` ASC");

    }
}
