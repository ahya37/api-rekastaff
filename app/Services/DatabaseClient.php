<?php 

namespace App\Services;
use App\Models\TokenManagement;

class DatabaseClient {

    public static function dbClient($request)
    {
          // buat fungsi untuk membaca database berdasarkan token login nya
          $apiToken = $request->header('Authorization');
          $token = explode(" ", $apiToken)[1];
          return TokenManagement::select('db_name')->where('access_token', $token)->first()->db_name;
         
    }
    
}