<?php

namespace App\Http\Controllers\user;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Product;
use App\Categories;
use Illuminate\Support\Facades\DB;
class ProdukController extends Controller
{
    public function index()
    {
        //menampilkan data produk 
        //kemudian dikasih paginasi 9 data per halaman nya
        $products = DB::table('products')
                    ->select('products.*')
                    ->get();
                
        $data = array(
            Product::all(),
        );

        return response()->json([
            "status" => true,
            "code" => 201,
            "message" => "Success",
            "data" => Product::all()
        ], 201);
    }

    public function detail($id)
    {
        //mengambil detail produk
        $data = array(
            'produk' => Product::findOrFail($id)
        );
        return view('user.produkdetail',$data);
    }

    public function cari(Request $request)
    {
        //mencari produk yang dicari user
        $prod  = Product::where('name','like','%' . $request->cari. '%')->get();
        $total = Product::where('name','like','%' . $request->cari. '%')->count(); 
        $data  = array(
            'product' => $prod,
            'cari' => $request->cari,
            'total' => $total
        );
        
        return response()->json([
            "status" => true,
            "code" => 201,
            "message" => "Success",
            "data" => $prod 
        ], 201);

    }
}
