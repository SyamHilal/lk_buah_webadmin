<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Province;
use App\City;
use App\User;
use Illuminate\Support\Facades\Auth;

class PengaturanController extends Controller
{
    public function aturalamat()
    {
        //cek apa alamat toko sudah di set atau belum
        $cek = DB::table('alamat_toko')->count();
        $data['cekalamat'] = $cek;
        //jika belum di setting maka ambil data provinsi untuk di tampilkan di form alamat
        
        //jika sudah di setting maka tidak menampilkan form tapi tampilkan data alamat toko
        $data['alamat'] = DB::table('alamat_toko')->select('*')->first();

        $curl = curl_init();

        curl_setopt_array($curl, array(
            CURLOPT_URL => "https://api.rajaongkir.com/starter/province",
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => "",
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 30,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => "GET",
            CURLOPT_HTTPHEADER => array(
                "key: 663c5b62a43c42c02133cf72d3c6ea26"
            ),
        ));

        $response = curl_exec($curl);

        curl_close($curl);

        $decode = json_decode($response, true);

        $data['provinces'] = $decode['rajaongkir']['results'];
     
        return view('admin.pengaturan.alamat',$data);
    }
    public function getCity($id)
    {

        //kfunction untuk mengambil data kota sesuia id parameter
        $curl = curl_init();

        curl_setopt_array($curl, array(
            CURLOPT_URL => "https://api.rajaongkir.com/starter/city?province=$id",
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => "",
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 30,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => "GET",
            CURLOPT_HTTPHEADER => array(
                "key: 663c5b62a43c42c02133cf72d3c6ea26"
            ),
        ));

        $response = curl_exec($curl);

        curl_close($curl);

        $decode = json_decode($response, true);

        $city = $decode['rajaongkir']['results'];


        //lalu return dengan format json
        return response()->json($city); 
    }

    public function ubahalamat($id)
    {
        //function untuk menampilkan form edit alamat
        $data['id'] = $id;

        $curl = curl_init();

        curl_setopt_array($curl, array(
            CURLOPT_URL => "https://api.rajaongkir.com/starter/province",
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => "",
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 30,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => "GET",
            CURLOPT_HTTPHEADER => array(
                "key: 663c5b62a43c42c02133cf72d3c6ea26"
            ),
        ));

        $response = curl_exec($curl);

        curl_close($curl);

        $decode = json_decode($response, true);

        $data['provinces'] = $decode['rajaongkir']['results'];

        return view('admin.pengaturan.ubahalamat',$data);
    }
    
    public function simpanalamat(Request $request)
    {
        //menyimpan alamat baru pada toko

        DB::table('alamat_toko')->insert([
            'province_id' => $request->province_id,
            'city_id' => $request->cities_id,
            'detail'  => $request->detail,
            'city_name' => $request->city_name,
            'province_name' => $request->province_name,
        ]);

        return redirect()->route('admin.pengaturan.alamat')->with('status','Berhasil Mengatur Alamat');
    }

    public function updatealamat($id,Request $request)
    {

        //mengupdate alamat toko
        DB::table('alamat_toko')
            ->where('id',$id)
            ->update([
                'province_id' => $request->province_id,
                'city_id' => $request->cities_id,
                'detail'  => $request->detail,
                'city_name' => $request->city_name,
                'province_name' => $request->province_name,
        ]);

        return redirect()->route('admin.pengaturan.alamat')->with('status','Berhasil Mengubah Alamat');
    }


    public function get_alamat_toko(){

        $alamat_toko = DB::table('alamat_toko')->select('*')->first();
        return response()->json($alamat_toko);

    }

    public function updateuser()
    {
           
        return view('admin.editprofile');
    }

    public function simpanuser(Request $request)
    {
        User::find(Auth::user()->id)->update([
            "name" => $request->username,
            "email" => $request->email,
            "no_hp" => $request->noHP,
        ]);

        return redirect()->back()->with('status','Berhasil Mengubah Data');
    }

}
