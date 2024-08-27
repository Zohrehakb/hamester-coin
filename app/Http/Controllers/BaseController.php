<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class BaseController extends Controller
{
    public function arrayToJson($error,$message,$data='',$subdata='')
    {
        return [
            'error'=>$error,
            'message'=>$message,
            'data'=>$data,
            'subdata'=>$subdata
        ];
    }
}
