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

?>
