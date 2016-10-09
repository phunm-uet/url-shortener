<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Hash;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

use App\Http\Requests;
use App\URL;
class UrlController extends Controller
{
	/**
	 * function to create URL Object and store link into DB
	 */
    function create(Request $request){
    	$link = $request->link;
    	$urlModel = new URL();
    	$hashUrl = str_random(15);
    	while($urlModel->where('hash',$hashUrl)->first() != null){
    		$hashUrl = str_random(15);
    	}
    	$urlModel->link = $link;
    	$urlModel->hash = $hashUrl;
    	$urlModel->count = "0";
    	if($urlModel->save()){
    		$array = [
    		"status" => "1",
    		"hash" => $request->root()."/".$hashUrl
    		];
    		return response()->json($array);
    	}

	}


	function fetchURL($hash){
		$urlModel = new URL();
		$link = $urlModel->where("hash",$hash)->first();
		return redirect($link->link);

	}
}
