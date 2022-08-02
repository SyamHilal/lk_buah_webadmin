<?php

namespace App\Http\Controllers\user;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Keranjang;
use Illuminate\Support\Facades\DB;
class KeranjangController extends Controller
{

    public function index(Request $request)
    {
        
        $keranjangs = DB::table('keranjang')
                            ->join('users','users.id','=','keranjang.user_id')
                            ->join('products','products.id','=','keranjang.products_id')
                            ->select('products.name as nama_produk','products.image','users.name','keranjang.*','products.price','products.weigth')
                            ->where('keranjang.user_id','=',$request->user_id)
                            ->get();
        //$cekalamat = DB::table('alamat')->where('user_id',$id_user)->count();
        $data = [
            $keranjangs,
            //'cekalamat'  => $cekalamat
        ];
        
        return response()->json([
            "status" => true,
            "code" => 201,
            "message" => "Success",
            "data" => $keranjangs
        ], 201);

    }

    public function simpan(Request $request)
    {

        $cek=Keranjang::where('user_id',$request->user_id)->where('products_id',$request->products_id)->first();
        if($cek){
            return response()->json([
                "status" => false,
                "code" => 600,
                "message" => "Produk Sudah dikeranjang",
                
            ], 200);
        }
        $add = Keranjang::create([
            'user_id' => $request->user_id,
            'products_id' => $request->products_id,
            'qty' => $request->qty
        ]);

        return response()->json([
            "status" => true,
            "code" => 201,
            "message" => "Success",
            "data" => $add
        ], 201);
    }

    public function update(Request $request)
    {

        Keranjang::where(
            'products_id',$request->product_id)->update([
                'qty' => $request->qty
            ]);
        
        return response()->json([
            "status" => true,
            "code" => 201,
            "message" => "Success"
        ], 201);
    }

    public function delete(Request $request)
    {

        $delete = Keranjang::destroy($request->id);

        if($delete){
            return response()->json([
                "status" => true,
                "code" => 201,
                "message" => "Delete Success"
            ], 201);
        } else {

            return response()->json([
                "status" => false,
                "code" => 401,
                "message" => "Delete Failed"
            ], 401);

        }

    }
}
