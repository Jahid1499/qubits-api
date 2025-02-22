<?php

namespace App\Helper;

use Exception;
use Firebase\JWT\JWT;
use Firebase\JWT\Key;

class JWTToken
{
    public static function CreateToken($name, $email='', $role, $userId, $phone=''):string
    {
        $key =env('JWT_KEY');
        $payload=[
            'iss'=>'user-token',
            'iat'=>time(),
            'exp'=>time()+60*60*24*7,
            'name'=>$name,
            'role'=>$role,
            'email'=>$email,
            'phone'=>$phone,
            'userId'=>$userId,
        ];
        return JWT::encode($payload,$key,'HS256');
    }

    public static function VerifyToken($token)
    {
        try {
            if($token==null){
                return "unauthorised";
            }
            else{
                $key =env('JWT_KEY');
                $decode=JWT::decode($token,new Key($key,'HS256'));
                return $decode;
            }
        }
        catch (Exception $e){
            return "unauthorised";
        }
    }
}
