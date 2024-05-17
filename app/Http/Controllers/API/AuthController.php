<?php

namespace App\Http\Controllers\API;

use App\Helpers\ResponseFormatter;
use App\Http\Controllers\Controller;
use App\Services\ApiTokenService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    public function login(Request $request)
    {
        // cek ke tbl hrd_route_id berdasarkan database loginID
        $hrd_route = DB::select("SELECT `hrd_route_id` FROM `user_hrd` WHERE `hrd_id` = '".$request->login_id."' AND `hrd_status` = 'A'");
        $hrd_route = collect($hrd_route)->first();

        // jika hrd_route ada
        if (!empty($hrd_route)) {

            $dbAlias   = "rkk_".$hrd_route->hrd_route_id;

            $app_user  = DB::select("select * from `$dbAlias`.`aps_user` u left join `aps_level` l  on l.level_idx = u.user_level_id where u.user_status = 'A' 
                                    and u.user_name = '".$request->user_name."'");
    
            $app_user = collect($app_user)->first();
    
            if(!empty($app_user)){
    
                // User exists
                if(Hash::check($request->user_pass, $app_user->user_pass)){
                    $app_user->db_name = $dbAlias;
                    $token_ins     = ApiTokenService::registerApiToken($app_user);
                    $access_token  = $token_ins->access_token;
    
                    // Password matched
                    $app_user->acces_token = $access_token;
                    $app_user->db_name     = 'secret';
                    
                    return ResponseFormatter::success([
                        'user' => $app_user
                    ]);
                    
                }else{
                    return ResponseFormatter::error([
                        'message' => 'Username atau password anda tidak ditemukan!'
                    ]);
                }

            }else{
                return ResponseFormatter::error([
                    'message' => 'Username atau password anda tidak ditemukan!'
                ]);
            }

        }else{

            return ResponseFormatter::error([
                'message' => 'Akun HRD anda tidak ditemukan!'
            ]);
        }

    }

    public function profile()
    {
        return 'OK';
    }
}
