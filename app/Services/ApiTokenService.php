<?php 

namespace App\Services;
use App\Models\TokenManagement;

class ApiTokenService {

    public static function registerApiToken($user)
    {
        // generate custom hash sebagai auth token
        $generateToken = base64_encode(sha1(rand(1, 1000). uniqid(). time()));
        // manage expire token
        $expired = date('Y-m-d H:i:s', strtotime('+1 day'));

        $tokenModel = new TokenManagement();

        // $cek = $tokenModel->where('useridx', $userMember->useridx)->count();

        // if ($cek > 0) {
        //     $updateToken = $tokenModel->where('useridx', $userMember->useridx)->first();
        //      $updateToken->update([
        //         'access_token' => $generateToken,
        //         'expired_at' => $expired,
        //         'is_active' => 1
        //     ]);

        //     $token_ins = $updateToken;

        // }else{
        // }
        // simpan token ke database
       $token_ins = $tokenModel->create([
            'user_id' => $user->user_id,
            'access_token' => $generateToken,
            'db_name' => $user->db_name,
            'expired_at' => $expired,
            'is_active' => 1
        ]);


        return $token_ins;
    }
}