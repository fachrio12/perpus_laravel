<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\pengembalian_buku;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\DB;


class pengembalianbukuController extends Controller
{
    public function show(){ 
        $data = DB::table('pengembalian_buku')
        ->join('peminjaman_buku', 'pengembalian_buku.id_peminjaman_buku', '=' , 'peminjaman_buku.id_peminjaman_buku')
        ->select('pengembalian_buku.id_pengembalian_buku','peminjaman_buku.id_peminjaman_buku',  'pengembalian_buku.tanggal_pengembalian', 'pengembalian_buku.denda')
        ->get();
    return Response()->json($data);
    }
    
    public function detail($id){
        if(pengembalian_buku::where('id_pengembalian_buku', $id)->exists()){
            $data_order = pengembalian_buku::where('pengembalian_buku.id_pengembalian_buku', '=', $id)
            ->get();
            return Response()->json($data_order);
        }else{
            return Response()->json(['message' => 'Tidak Ditemukan']);
        }
    }
    public function store(Request $request)
    {
    $validator=Validator::make($request->all(),
      [
       'id_peminjaman_buku' => 'required',
       'tanggal_pengembalian' => 'required',
       'denda' => 'required'
      ]
    );
    if($validator->fails()) {
        return Response()->json($validator->errors());
        }
        $simpan = pengembalian_buku::create([
        'id_peminjaman_buku' => $request->id_peminjaman_buku,
        'tanggal_pengembalian' => $request->tanggal_pengembalian,
        'denda' => $request->denda
        
        
        ]);
        if($simpan)
        {
        return Response()->json(['status' => 1]);
        }
        else
        {
        return Response()->json(['status' => 0]);
        }
        }

        public function update($id, Request $request)
        {
        $validator=Validator::make($request->all(),
        [ 
            'id_peminjaman_buku' => 'required',
            'tanggal_pengembalian' => 'required',
            'denda' => 'required'
        
        
        ]
        );
        if($validator->fails()) {
        return Response()->json($validator->errors());
        }
        $ubah = pengembalian_buku::where('id_pengembalian_buku', $id)->update([
            'id_peminjaman_buku' => $request->id_peminjaman_buku,
            'tanggal_pengembalian' => $request->tanggal_pengembalian,
            'denda' => $request->denda
        ]);
        if($ubah) {
        return Response()->json(['status' => 1]);
        }
        else {
        return Response()->json(['status' => 0]);
        }
        }
       
    
        public function destroy($id)
        {
        $hapus = pengembalian_buku::where('id_pengembalian_buku', $id)->delete();
        if($hapus) {
        return Response()->json(['status' => 1]);
        }
        else {
        return Response()->json(['status' => 0]);
        }
        }
}
