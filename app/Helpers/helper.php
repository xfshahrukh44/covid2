<?php

use Carbon\Carbon;

function return_date($date){
    return Carbon::parse($date)->format('M d Y');
}

function api_not_found(){
    return response()->json([
        'success' => false,
        'message' => 'not found'
    ]);
}

function api_not_allowed(){
    return response()->json([
        'success' => false,
        'message' => 'not allowed'
    ]);
}

function generate_otp($length = 4) {
    $characters = '0123456789';
    $charactersLength = strlen($characters);
    $randomString = '';
    for ($i = 0; $i < $length; $i++) {
        $randomString .= $characters[rand(0, $charactersLength - 1)];
    }
    return $randomString;
}

?>
