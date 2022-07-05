<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\detail_peminjaman_buku;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\DB;
//use andalan


class detailpeminjamanbukuController extends Controller
{
    public function show(){ 
        $data = DB::table('detail_peminjaman_buku')
        ->join('peminjaman_buku', 'detail_peminjaman_buku.id_peminjaman_buku', '=' , 'peminjaman_buku.id_peminjaman_buku')
        ->join('buku', 'detail_peminjaman_buku.id_buku', '=' , 'buku.id_buku')
        ->select('detail_peminjaman_buku.id_detail_peminjaman_buku','peminjaman_buku.id_peminjaman_buku',  'buku.id_buku', 'detail_peminjaman_buku.qty')
        ->get();
    return Response()->json($data);
    }
    
    public function detail($id){
        if(detail_peminjaman_buku::where('id_detail_peminjaman_buku', $id)->exists()){
            $data_order = detail_peminjaman_buku::where('detail_peminjaman_buku.id_detail_peminjaman_buku', '=', $id)
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
       'id_buku' => 'required',
       'qty' => 'required'
      ]
    );
    if($validator->fails()) {
        return Response()->json($validator->errors());
        }
        $simpan = detail_peminjaman_buku::create([
        'id_peminjaman_buku' => $request->id_peminjaman_buku,
        'id_buku' => $request->id_buku,
        'qty' => $request->qty
        
        
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
            'id_buku' => 'required',
            'qty' => 'required'
        
        
        ]
        );
        if($validator->fails()) {
        return Response()->json($validator->errors());
        }
        $ubah = detail_peminjaman_buku::where('id_detail_peminjaman_buku', $id)->update([
            'id_peminjaman_buku' => $request->id_peminjaman_buku,
            'id_buku' => $request->id_buku,
            'qty' => $request->qty
        
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
        $hapus = detail_peminjaman_buku::where('id_detail_peminjaman_buku', $id)->delete();
        if($hapus) {
        return Response()->json(['status' => 1]);
        }
        else {
        return Response()->json(['status' => 0]);
        }
        }
}
