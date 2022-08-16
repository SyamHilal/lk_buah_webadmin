<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Order;
use Symfony\Component\Console\Input\Input;

class TransaksiController extends Controller
{
    public function index()
    {
        //ambil data order yang status nya 1 atau masih baru/belum melalukan pembayaran
        $order = DB::table('order')
            ->join('status_order', 'status_order.id', '=', 'order.status_order_id')
            ->join('users', 'users.id', '=', 'order.user_id')
            ->select('order.*', 'status_order.name', 'users.name as nama_pemesan')
            ->where('order.status_order_id', 1)
            ->get();


        $data = array(
            'orderbaru' => $order
        );

        return view('admin.transaksi.index', $data);
    }

    public function detail($id)
    {
        //ambil data detail order sesuai id
        $detail_order = DB::table('detail_order')
            ->join('products', 'products.id', '=', 'detail_order.product_id')
            ->join('order', 'order.id', '=', 'detail_order.order_id')
            ->select('products.name as nama_produk', 'products.image', 'detail_order.*', 'products.price', 'order.*')
            ->where('detail_order.order_id', $id)
            ->get();
        $order = DB::table('order')
            ->join('users', 'users.id', '=', 'order.user_id')
            ->join('status_order', 'status_order.id', '=', 'order.status_order_id')
            ->select('order.*', 'users.name as nama_pelanggan', 'status_order.name as status')
            ->where('order.id', $id)
            ->first();
        $data = array(
            'detail' => $detail_order,
            'order'  => $order
        );
        return view('admin.transaksi.detail', $data);
    }

    public function perludicek()
    {
        //ambil data order yang status nya 2 atau belum di cek / sudah bayar
        $order = DB::table('order')
            ->join('status_order', 'status_order.id', '=', 'order.status_order_id')
            ->join('users', 'users.id', '=', 'order.user_id')
            ->select('order.*', 'status_order.name', 'users.name as nama_pemesan')
            ->where('order.status_order_id', 2)
            ->get();
        $data = array(
            'orderbaru' => $order
        );

        return view('admin.transaksi.perludicek', $data);
    }

    public function perludikirim()
    {
        //ambil data order yang status nya 3 sudah dicek dan perlu dikirim(input no resi)
        $order = DB::table('order')
            ->join('status_order', 'status_order.id', '=', 'order.status_order_id')
            ->join('users', 'users.id', '=', 'order.user_id')
            ->select('order.*', 'status_order.name', 'users.name as nama_pemesan')
            ->where('order.status_order_id', 3)
            ->get();
        $data = array(
            'orderbaru' => $order
        );

        return view('admin.transaksi.perludikirim', $data);
    }

    public function selesai(Request $request)
    {
        $order = DB::table('order')
            ->join('status_order', 'status_order.id', '=', 'order.status_order_id')
            ->join('users', 'users.id', '=', 'order.user_id')
            ->join('detail_order', 'detail_order.order_id', '=', 'order.id')
            ->select('order.*', 'status_order.name', 'detail_order.qty', 'users.name as nama_pemesan',)
            ->where('order.status_order_id', 5)
            ->get();

        //  dd($order);
        $total = 0;
        foreach ($order as $key => $value) {
            $orderDetail = DB::table('order')
                //  ->join('status_order','status_order.id','=','order.status_order_id')
                ->join('detail_order', 'detail_order.order_id', '=', 'order.id')
                ->join('products', 'detail_order.product_id', '=', 'products.id', 'LEFT')
                ->selectRaw('sum(detail_order.qty * products.price_awal) as total')
                //  ->sum('qty * price_awal')
                ->where('order.status_order_id', 5)
                ->get();
            // dd($order);
            foreach ($orderDetail as $key => $item) {
                if (empty($item->subtotal)) {
                    // $total=$item->subtotal - 0;
                } else {
                    // $qty = DB::table('detail_order')->sum('qty');
                    // $total_price = $qty * $item->price_awal;
                }
            }
            $total_harga = DB::table('order')
                ->join('status_order', 'status_order.id', '=', 'order.status_order_id')
                ->join('detail_order', 'detail_order.order_id', '=', 'order.id')
                ->join('products', 'detail_order.product_id', '=', 'products.id', 'LEFT')
                ->selectRaw('sum(detail_order.qty * products.price_awal) as total')
                ->where('order.status_order_id', 5)
                ->get();
            // dd($orderDetail);
            foreach ($total_harga as $key => $item) {
                if (empty($item->subtotal)) {
                    // $total=$item->subtotal - 0;
                } else {
                    // $qty = DB::table('detail_order')->sum('qty');
                    // $total_price = $qty * $item->price_awal;
                }


                $total_awal = $item->total;
                // dd($total_awal);
                $subtotal = $order->sum('subtotal');

                // $subtotal = DB::table('order')->sum('subtotal');
                $total = $subtotal - $total_awal;
                //   dd($subtotal);

            }
        }

        $data = array(
            'orderbaru' => $order,
            // 'total_pendapatan' => $total
        );


        return view('admin.transaksi.selesai', $data);
    }

    public function cetakAll(Request $request)
    {

        $order = DB::table('order')
            ->join('status_order', 'status_order.id', '=', 'order.status_order_id')
            ->join('users', 'users.id', '=', 'order.user_id')
            ->select('order.*', 'users.name as nama_pemesan',)
            ->where('order.status_order_id', 5)
            ->get();

        //  dd($order);
        $total = 0;
        $listProduk = [];
        foreach ($order as $key => $value) {
            $orderDetail = DB::table('order')

                ->join('detail_order', 'detail_order.order_id', '=', 'order.id')
                ->join('products', 'detail_order.product_id', '=', 'products.id', 'LEFT')
                ->select('products.name', 'detail_order.qty', 'order.id')
                //  ->selectRaw('sum(detail_order.qty * products.price_awal) as total')
                ->where('order.status_order_id', 5)
                //  ->where('order.id', $value->id)
                ->get();
            //  dd($orderDetail);

            foreach ($orderDetail as $key => $item) {
                $listProduk[$item->id] = $item->name;

                if (empty($item->subtotal)) {
                    // $total=$item->subtotal - 0;
                } else {
                    // $qty = DB::table('detail_order')->sum('qty');
                    // $total_price = $qty * $item->price_awal;
                }
            }
            $total_harga = DB::table('order')
                ->join('status_order', 'status_order.id', '=', 'order.status_order_id')
                ->join('detail_order', 'detail_order.order_id', '=', 'order.id')
                ->join('products', 'detail_order.product_id', '=', 'products.id', 'LEFT')
                ->selectRaw('sum(detail_order.qty * products.price_awal) as total')
                ->where('order.status_order_id', 5)
                ->get();
            // dd($orderDetail);
            foreach ($total_harga as $key => $item) {
                if (empty($item->subtotal)) {
                    // $total=$item->subtotal - 0;
                } else {
                    // $qty = DB::table('detail_order')->sum('qty');
                    // $total_price = $qty * $item->price_awal;
                }


                $total_awal = $item->total;
                // dd($total_awal);
                $subtotal = $order->sum('subtotal');
                // dd($subtotal);
                // $subtotal = DB::table('order')->sum('subtotal');
                $total = $subtotal - $total_awal;
            }
        }
        $data = array(
            'laporan' => $order,
            'jual' => $subtotal,
            'detail' => $orderDetail,
            'untung' => $total
        );
        // dd($data);
        return view('admin.transaksi.cetak', $data);
    }

    public function cetak(Request $request)
    {
        $month = $request->get('month');
        $year = $request->get('year');

        $order = DB::table('order')
            ->join('status_order', 'status_order.id', '=', 'order.status_order_id')
            ->join('users', 'users.id', '=', 'order.user_id')
            ->select('order.*', 'users.name as nama_pemesan',)
            ->where('order.status_order_id', 5)
            ->whereYear('order.created_at', '=', $year)
            ->whereMonth('order.created_at', '=', $month)
            ->get();

        //  dd($order);
        $total = 0;
        $listProduk = [];

        if (count($order) === 0) {
        //  dd($order);

            $data = array(
                'laporan' => null
            );
        } else {
            foreach ($order as $key => $value) {
                $orderDetail = DB::table('order')

                    ->join('detail_order', 'detail_order.order_id', '=', 'order.id')
                    ->join('products', 'detail_order.product_id', '=', 'products.id', 'LEFT')
                    ->select('products.name', 'detail_order.qty', 'order.id')
                    //  ->selectRaw('sum(detail_order.qty * products.price_awal) as total')
                    ->where('order.status_order_id', 5)
                    ->whereYear('order.created_at', '=', $year)
                    ->whereMonth('order.created_at', '=', $month)
                    ->get();
                //  dd($orderDetail);

                foreach ($orderDetail as $key => $item) {
                    $listProduk[$item->id] = $item->name;

                    if (empty($item->subtotal)) {
                    } else {
                        // $qty = DB::table('detail_order')->sum('qty');
                        // $total_price = $qty * $item->price_awal;
                    }
                }
                $total_harga = DB::table('order')

                    ->join('detail_order', 'detail_order.order_id', '=', 'order.id')
                    ->join('products', 'detail_order.product_id', '=', 'products.id', 'LEFT')
                    ->selectRaw('sum(detail_order.qty * products.price_awal) as total')
                    ->where('order.status_order_id', 5)
                    ->whereYear('order.created_at', '=', $year)
                    ->whereMonth('order.created_at', '=', $month)
                    ->get();
                // dd($orderDetail);
                foreach ($total_harga as $key => $item) {
                    if (empty($item->subtotal)) {
                        // $total=$item->subtotal - 0;
                    } else {
                        // $qty = DB::table('detail_order')->sum('qty');
                        // $total_price = $qty * $item->price_awal;
                    }


                    $total_awal = $item->total;
                    // dd($total_awal);
                    $subtotal = $order->sum('subtotal');
                    // dd($total);
                    $total = $subtotal - $total_awal;
                    // dd($orderDetail);
                }
            }

            $data = array(
                'laporan' => $order,
                'detail' => $orderDetail,
                'jual' => $subtotal,
                'untung' => $total
            );
        }
        // dd($orderDetail);
        return view('admin.transaksi.cetaklaporan', $data);
    }

    public function dibatalkan()
    {
        //ambil data order yang status nya 6 dibatalkan pelanngan
        $order = DB::table('order')
            ->join('status_order', 'status_order.id', '=', 'order.status_order_id')
            ->join('users', 'users.id', '=', 'order.user_id')
            ->select('order.*', 'status_order.name', 'users.name as nama_pemesan')
            ->where('order.status_order_id', 6)
            ->get();
        $data = array(
            'orderbaru' => $order
        );

        return view('admin.transaksi.dibatalkan', $data);
    }

    public function dikirim()
    {
        //ambil data order yang status nya 4 atau sedang dikirim
        $order = DB::table('order')
            ->join('status_order', 'status_order.id', '=', 'order.status_order_id')
            ->join('users', 'users.id', '=', 'order.user_id')
            ->select('order.*', 'status_order.name', 'users.name as nama_pemesan')
            ->where('order.status_order_id', 4)
            ->get();
        $data = array(
            'orderbaru' => $order
        );

        return view('admin.transaksi.dikirim', $data);
    }

    public function konfirmasi($id)
    {
        //function ini untuk mengkonfirmasi bahwa pelanngan sudah melakukan pembayaran
        $order = Order::findOrFail($id);
        $order->status_order_id = 3;
        $order->save();

        $kurangistok = DB::table('detail_order')->where('order_id', $id)->get();
        foreach ($kurangistok as $kurang) {
            $ambilproduk = DB::table('products')->where('id', $kurang->product_id)->first();
            $ubahstok = $ambilproduk->stok - $kurang->qty;

            $update = DB::table('products')
                ->where('id', $kurang->product_id)
                ->update([
                    'stok' => $ubahstok
                ]);
        }
        return redirect()->route('admin.transaksi.perludikirim')->with('status', 'Berhasil Mengonfirmasi Pembayaran Pesanan');
    }

    public function inputresi($id, Request $request)
    {
        //funtion untuk menginput no resi pesanan
        $order = Order::findOrFail($id);
        $order->no_resi = $request->no_resi;
        $order->status_order_id = 4;
        $order->save();
        return redirect()->route('admin.transaksi.perludikirim')->with('status', 'Berhasil Menginput No Resi');
    }
}
