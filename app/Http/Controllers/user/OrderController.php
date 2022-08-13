<?php

namespace App\Http\Controllers\user;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Order;
use App\Detailorder;
use App\Rekening;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Midtrans\Config;
use App\Http\Controllers\Midtrans\Snap;
use App\Product;
use Illuminate\Support\Facades\Auth;

class OrderController extends Controller
{

    public function index()
    {
        //menampilkan semua data pesanan
        $user_id = Auth::user()->id;

        $order = DB::table('order')
                    ->join('status_order','status_order.id','=','order.status_order_id')
                    ->select('order.*','status_order.name')
                    ->where('order.status_order_id',1)
                    ->where('order.user_id',$user_id)->get();
        $dicek = DB::table('order')
                    ->join('status_order','status_order.id','=','order.status_order_id')
                    ->select('order.*','status_order.name')
                    ->where('order.status_order_id','!=',1)
                    ->Where('order.status_order_id','!=',5)
                    ->Where('order.status_order_id','!=',6)
                    ->where('order.user_id',$user_id)->get();
        $histori = DB::table('order')
        ->join('status_order','status_order.id','=','order.status_order_id')
        ->select('order.*','status_order.name')
        ->where('order.status_order_id','!=',1)
        ->Where('order.status_order_id','!=',2)
        ->Where('order.status_order_id','!=',3)
        ->Where('order.status_order_id','!=',4)
        ->where('order.user_id',$user_id)->get();
        $data = array(
            'order' => $order,
            'dicek' => $dicek,
            'histori'=> $histori
        );
        return view('user.order.order',$data);
    }

    public function detail($id)
    {
        //function menampilkan detail order
        $detail_order = DB::table('detail_order')
        ->join('products','products.id','=','detail_order.product_id')
        ->join('order','order.id','=','detail_order.order_id')
        ->select('products.name as nama_produk','products.image','detail_order.*','products.price','order.*')
        ->where('detail_order.order_id',$id)
        ->get();
        $order = DB::table('order')
        ->join('users','users.id','=','order.user_id')
        ->join('status_order','status_order.id','=','order.status_order_id')
        ->select('order.*','users.name as nama_pelanggan','status_order.name as status')
        ->where('order.id',$id)
        ->first();
        $data = array(
        'detail' => $detail_order,
        'order'  => $order
        );
        return view('user.order.detail',$data);
    }

    public function sukses(Request $request)
    {
        //menampilkan view terimakasih jika order berhasil dibuat
//        return view('user.terimakasih');

        $order = DB::table('order')->where('invoice',$request->order_id)->first();

        return  response()->json([
            'status' => true,
            'code' => 201,
            'message' => 'Transaksi Berhasil',
            'data'  => $order
        ], 201);
    }

    public function kirimbukti($id,Request $request)
    {
        //mengupload bukti pembayaran
        $order = Order::findOrFail($id);
        if($request->file('bukti_pembayaran')){
            $file = $request->file('bukti_pembayaran')->store('buktibayar','public');

            $order->bukti_pembayaran = $file;
            $order->status_order_id  = 2;

            $order->save();

        }
        return redirect()->route('user.order');
    }
    
    public function pembayaran($id)
    {
        //menampilkan view pembayaran
        $data = array(
            'rekening' => Rekening::all(),
            'order' => Order::findOrFail($id)
        );
        return view('user.order.pembayaran',$data);
    }

    public function pesananditerima($id)
    {
        //function untuk menerima pesanan
        $order = Order::findOrFail($id);
        $order->status_order_id = 5;
        $order->save();

        return redirect()->route('user.order');

    }

    public function pesanandibatalkan($id)
    {
        //function untuk membatalkan pesanan
        $order = Order::findOrFail($id);
        $order->status_order_id = 6;
        $order->save();

        return redirect()->route('user.order');

    }
    public function confirmation(Request $request)
    {
        //function untuk membatalkan pesanan
        $order = Order::findOrFail($request->id);
        $order->status_order_id = 5;
        $order->save();

        return response()->json([
            'status' => false,
            'code' => 600,
            'message' => 'Terima kasih sudah belanja dikami',
            'data'  => []
        ],
            201
        );

    }
    public function cancelOrder(Request $request)
    {
        //function untuk membatalkan pesanan
        $order = Order::findOrFail($request->id);
        $order->status_order_id = 6;
        $order->save();

        return response()->json([
            'status' => false,
            'code' => 600,
            'message' => 'Pesanan Berahasil dibatalkan',
            'data'  => []
        ],
            201
        );

    }
    public function notificationMidtrans(Request $request)
    {
        //function untuk membatalkan pesanan
        $order = Order::findOrFail($request->id);
        $order->status_order_id = 3;
        $order->save();

        return response()->json([
            'status' => false,
            'code' => 600,
            'message' => 'Pesanan Berahasil Dibayar',
            'data'  => []
        ],
            201
        );

    }

    public function get_transaksi($id, Request $request)
    {
        $data['transaksi'] = Order::with(['detailTransaksi.product','statusOrder'])->where('user_id', $id)->orderBy('created_at','desc')->get();

        if (empty($data['transaksi'])) {
            return response()->json([
                'status' => false,
                'code' => 600,
                'message' => 'Transaksi tidak ditemukan',
                'data'  => []
            ],
                201
            );
        }

        return response()->json([
            'status' => true,
            'code' => 200,
            'message' => 'Transaksi ditemukan',
            'data' => $data['transaksi']
        ],
            201
        );
    }

    public function simpan(Request $request)
    {
        //untuk menyimpan pesanan ke table order
        try {
            DB::beginTransaction();
            // $cek_invoice = DB::table('order')->where('invoice',$request->invoice)->count();
            // if($cek_invoice < 1){
                $userid = $request->user_id;
                //jika pelanggan memilih metode cod maka insert data yang ini
                if($request->metode_pembayaran == 'cod'){
                    Order::create([
                        'invoice' => $request->invoice,
                        'user_id' => $userid,
                        'subtotal'=> $request->subtotal,
                        'status_order_id' => 1,
                        'metode_pembayaran' => $request->metode_pembayaran,
                        'ongkir' => $request->ongkir,
                        'biaya_cod' => 10000,
                        'no_hp' => $request->no_hp,
                        'pesan' => $request->pesan,
                        
                    ]);
                }else{
                    //jika memilih transfer maka data yang ini
                    Order::create([
                        'invoice' => $request->invoice,
                        'user_id' => $userid,
                        'subtotal'=> $request->subtotal,
                        'status_order_id' => 1,
                        "city_id" => $request->city_id,
                        "city_name" => $request->city_name,
                        "province_name" => $request->province_name,
                        "province_id" => $request->province_id,
                        "detail_alamat" => $request->detail_alamat,
                        "type" => $request->type,
                        'metode_pembayaran' => $request->metode_pembayaran,
                        'ongkir' => $request->ongkir,
                        'no_hp' => $request->no_hp,
                        'pesan' => $request->pesan
                    ]);
                }

                $order = DB::table('order')->where('invoice',$request->invoice)->first();
                $user = DB::table('users')->where('id', $request->user_id)->first();
                $barang = DB::table('keranjang')->where('user_id',$userid)->get();
                //lalu masukan barang2 yang dibeli ke table detail order
                foreach($barang as $brg){
                    Detailorder::create([
                        'order_id' => $order->id,
                        'product_id' => $brg->products_id,
                        'qty' => $brg->qty,
                    ]);
                    $product=Product::where('id',$brg->products_id)->first();
                    Product::where('id',$brg->products_id)->update([
                        "stok" => ($product->stok - $brg->qty)
                    ]);
                }

                // Konfigurasi Midtrans
                Config::$serverKey = env('MIDTRANS_SERVER_KEY');
                Config::$isProduction = env('MIDTRANS_IS_PRODUCTION');
                Config::$isSanitized = env('MIDTRANS_IS_SANITIZED');
                Config::$is3ds = env('MIDTRANS_IS_3DS');

                if (empty($order)) {
                    return response()->json([
                        'status' => false,
                        'code' => 600,
                        'message' => 'Transaksi tidak ditemukan'
                    ],
                        201
                    );
                }

                // Membuat Transaksi Midtrans
                $transaction_details = [
                    'order_id' => $order->invoice,
                    'gross_amount' => $order->subtotal + $order->ongkir, // no decimal allowed for creditcard
                ];

                $customer_details = [
                    'first_name'    => $user->name,
                    'email'         => $user->email,
                    'phone'         => $order->no_hp,
                ];

                $enable_payments = [
                    "bca_va", "bni_va", "bri_va",
                   ];

                $transactionMidtrans = [
                    'enabled_payments' => $enable_payments,
                    'transaction_details' => $transaction_details,
                    'customer_details' => $customer_details,
                ];


                // Memanggil Midtrans
                try {
                    $url_transaction = Snap::createTransaction($transactionMidtrans)->redirect_url;

                    $order = tap(DB::table('order')->where('invoice',$request->invoice))->update([
                        'url_midtrans' => $url_transaction
                    ]);

                    //lalu hapus data produk pada keranjang pembeli
                    DB::table('keranjang')->where('user_id',$userid)->delete();
                    DB::commit();
                    return  response()->json([
                        'status' => true,
                        'code' => 201,
                        'message' => 'transaksi Berhasil',
                        'data'  => $order->first()
                    ], 201);

                } catch (\Exception $e) {
                    DB::rollBack();
                    dd($e->getMessage());
                    return  response()->json([
                        'status' => false,
                        'code' => 201,
                        'message' => 'transaksi Gagal => ' . $e->getMessage(),
                        'data'  => []
                    ], 201);
                }
            // }else{
            //     DB::rollBack();
            //     return  response()->json([
            //         'status' => false,
            //         'code' => 401,
            //         'message' => 'transaksi Gagal => Nomor Invoice telah digunakan',
            //         'data'  => []
            //     ], 201);
            // }
        } catch (\Exception $e) {
            DB::rollBack();
            return  response()->json([
                'status' => false,
                'code' => 401,
                'message' => $e->getMessage(),
                'data'  => []
            ], 201);
        }

    }

    public function notification(Request $request)
    {
        // Set Konfigurasi Midtrans
        Config::$serverKey = env('MIDTRANS_SERVER_KEY');
        Config::$isProduction = env('MIDTRANS_IS_PRODUCTION');
        Config::$isSanitized = env('MIDTRANS_IS_SANITIZED');
        Config::$is3ds = env('MIDTRANS_IS_3DS');

        // Instance midtrans notification
        $notification = $request;

        // Assign ke variabel untuk mempermudah code
        $status = $notification->transaction_status;
        $type = $notification->payment_type;
        $fraud = $notification->fraud_status;
        $order_id = $notification->order_id;
        $payment_type = $notification->payment_type;
        $gross_amount = (int)$notification->gross_amount;

        // Cari transaksi berdasarkan ID
        $transaction = DB::table('order')->where('invoice',$order_id)->first();

        if (empty($transaction)) {
            return response()->json([
                "status" => false,
                "message" => "Update Data Failed",
                "code" => 600
            ], 201);
        }

        // Handle notifikasi status midtrans
        if ($status == 'capture') {
            if ($type == 'credit_card') {
                if ($fraud == 'challenge') {
                    $payment_status = 1;
                }else{
                    $payment_status = 3;
                }
            }
        }else if ($status == 'settlement') {
            $payment_status = 3;
        }else if ($status == 'pending') {
            $payment_status = 1;
        }else if ($status == 'deny') {
            $payment_status = 6;
        }else if ($status == 'expire') {
            $payment_status = 6;
        }else if ($status == 'cancel') {
            $payment_status = 6;
        }

        if (!empty($transaction)) {
            $transaction = DB::table('order')->where('invoice',$order_id)->update([
                'status_order_id'   => $payment_status
            ]);

            return response()->json([
                "status" => true,
                "message" => "Update Data Success",
                "code" => 201,
            ], 201);
        } else {
            return response()->json([
                "status" => false,
                "message" => "Update Data Failed",
                "code" => 600
            ], 201);
        }
    }
}
