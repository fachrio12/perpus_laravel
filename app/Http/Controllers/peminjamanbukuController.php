<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\peminjaman_buku;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\DB;


class peminjamanbukuController extends Controller
{
     public function show(){ 
        $data = DB::table('peminjaman_buku')
        ->join('siswa', 'peminjaman_buku.id_siswa', '=' , 'siswa.id_siswa')
        ->select('peminjaman_buku.id_peminjaman_buku','siswa.id_siswa',  'peminjaman_buku.tanggal_pinjam', 'peminjaman_buku.tanggal_kembali')
        ->get();
    return Response()->json($data);
    }
    public function detail($id){
        if(peminjaman_buku::where('id_peminjaman_buku', $id)->exists()){
            $data_order = peminjaman_buku::where('peminjaman_buku.id_peminjaman_buku', '=', $id)
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
       'id_siswa' => 'required',
       'tanggal_pinjam' => 'required',
       'tanggal_kembali' => 'required'
      ]
    );
    if($validator->fails()) {
        return Response()->json($validator->errors());
        }
        $simpan = peminjaman_buku::create([
        'id_siswa' => $request->id_siswa,
        'tanggal_pinjam' => $request->tanggal_pinjam,
        'tanggal_kembali' => $request->tanggal_kembali
        
        
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
            'id_siswa' => 'required',
            'tanggal_pinjam' => 'required',
            'tanggal_kembali' => 'required'
        
        
        ]
        );
        if($validator->fails()) {
        return Response()->json($validator->errors());
        }
        $ubah = peminjaman_buku::where('id_peminjaman_buku', $id)->update([
            'id_siswa' => $request->id_siswa,
        'tanggal_pinjam' => $request->tanggal_pinjam,
        'tanggal_kembali' => $request->tanggal_kembali
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
        $hapus = peminjaman_buku::where('id_peminjaman_buku', $id)->delete();
        if($hapus) {
        return Response()->json(['status' => 1]);
        }
        else {
        return Response()->json(['status' => 0]);
        }
        }

}
