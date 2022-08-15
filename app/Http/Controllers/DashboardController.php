<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
class DashboardController extends Controller
{
    //
    public function index()
    {
        //ambil data data untuk ditampilkan di card pada dashboard
        // $pendapatan = DB::table('order')
        //                 ->select(DB::raw('SUM(subtotal) as penghasilan'))
        //                 ->where('status_order_id',5)
        //                 ->first();
        $transaksi = DB::table('order')
                        ->select(DB::raw('COUNT(id) as total_order'))
                        ->first();
        $pelanggan = DB::table('users')
                        ->select(DB::raw('COUNT(id) as total_user'))
                        ->where('role','=','customer')
                        ->first();
        $order_terbaru = $order = DB::table('order')
                        ->join('status_order','status_order.id','=','order.status_order_id')
                        ->join('users','users.id','=','order.user_id')
                        ->select('order.*','status_order.name','users.name as nama_pemesan')
                        ->orderBy('updated_at','desc')
                        ->limit(10)
                        ->get();

                        $orderHitung = DB::table('order')
                        ->join('status_order','status_order.id','=','order.status_order_id')
                        ->join('users','users.id','=','order.user_id')
                        ->select('order.*','status_order.name','users.name as nama_pemesan')
                        ->where('order.status_order_id',5)
                        ->get();
                        $total=0;
                        foreach ($orderHitung as $key => $value) {
                            $orderDetail = DB::table('order')
                        
                        ->join('detail_order','detail_order.order_id','=','order.id')
                        ->join('products','detail_order.product_id','=','products.id','LEFT')
                        ->select('subtotal','products.price_awal')
                        ->where('order.status_order_id',5)
                        ->where('order.id',$value->id)
                        ->get();
                        // dd($orderDetail);
                        foreach ($orderDetail as $key => $item) {
                            if(empty($item->price_awal)){
                                $total=$item->subtotal - 0;
                            }else{
                                $qty = DB::table('detail_order')->sum('qty');
                                $total_price = $qty * $item->price_awal;
                            }
                            $total_harga = DB::table('order')
                    ->join('status_order','status_order.id','=','order.status_order_id')
                     ->join('detail_order','detail_order.order_id','=','order.id')
                     ->join('products','detail_order.product_id','=','products.id','LEFT')
                     ->selectRaw('sum(detail_order.qty * products.price_awal) as total')
                     ->where('order.status_order_id',5)
                     ->get();
                    // dd($orderDetail);
                    foreach ($total_harga as $key => $item) {
                        if(empty($item->subtotal)){
                            // $total=$item->subtotal - 0;
                        }else{
                            // $qty = DB::table('detail_order')->sum('qty');
                            // $total_price = $qty * $item->price_awal;
                        }
                        
                    
                        $total_awal = $item->total;
                        // dd($total_awal);
                        $subtotal = $order->sum('subtotal');
                        // dd($total);
                        $subtotal = DB::table('order')->sum('subtotal');
                        $total=$subtotal - $total_awal;
                        }
                    }
                }
            
                        
                        
        $data = array(
            'penjualan' => $subtotal,
            'pendapatan' => $total,
            'transaksi'  => $transaksi,
            'pelanggan'  => $pelanggan,
            'order_baru' => $order_terbaru
        );
        
        return view('admin/dashboard',$data);
    }
}
