<?php

namespace App\Core;

class Controller
{
    public static function successWithResponse($message = 'Successfully done', $code = 200)
    {
        echo json_encode([
            'success' => true,
            'message' => $message,
            'status_code' => $code
        ], JSON_PRETTY_PRINT);
        exit;
    }
    public static function errorWithResponse($message = 'Data not found', $code = 404)
    {
        echo json_encode([
            'success' => false,
            'message' => $message,
            'status_code' => $code
        ], JSON_PRETTY_PRINT);
        exit;
    } 
}
