<?php

namespace App\Helpers;

class ApiResponse{

    public static function success($data, $message ='', $code=200){
        return response()->json([
            'status' => true,
            'message' => $message,
            'data' => $data
        ], $code);
    }

    public static function error($data, $message, $code=400){
        return response()->json([
            'status' => false,
            'message' => $message,
            'data' => $data
        ], $code); 
    }

}
