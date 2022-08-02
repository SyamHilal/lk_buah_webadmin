<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Product;
use App\Categories;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use File;
class ApiProductController extends Controller
{
    private $isSuccess;
    private $exception;

    public function __construct()
    {
        $this->isSuccess = true;
        $this->exception = "";

    }
    public function index(Request $request)
    {

        $result=[];
       if($request->has('keyword')){
        $result=Product::where('name','LIKE',"%$request->keyword%")->orderBy('created_at','desc')->get();
       }else{
            $result=Product::orderBy('created_at','desc')->get();
       }
       $isAvalable = count($result) > 0 ? true : false;

       return response()->json([
           "status"    => $isAvalable ?? false,
           "code"      => $isAvalable ? 200 : 600,
           "message"   => $isAvalable ? "Get data success!" : "No Data Found!",
           "total_data"=> $isAvalable ? $result->count() : 0,
           "base_url_photo" => url(),
           "data"      => $isAvalable ? $result : []
       ], 201);

       
    }
}
