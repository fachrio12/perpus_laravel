<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\siswa;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\DB;
class siswaController extends Controller
{
    public function show(){ 
        $data = DB::table('siswa')
        ->join('kelas', 'siswa.id_kelas', '=' , 'kelas.id_kelas')
        ->select('siswa.id_siswa',  'siswa.nama_siswa', 'siswa.tanggal_lahir','siswa.gender','siswa.alamat','kelas.id_kelas')
        ->get();
    return Response()->json($data);
    }
    public function detail($id){
        if(siswa::where('id_siswa', $id)->exists()){
            $data_order = siswa::where('siswa.id_siswa', '=', $id)
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
       'nama_siswa' => 'required',
       'tanggal_lahir' => 'required',
       'gender' => 'required',
       'alamat' => 'required',
       'id_kelas' => 'required'
      ]
    );
    if($validator->fails()) {
        return Response()->json($validator->errors());
        }
        $simpan = siswa::create([
        'nama_siswa' => $request->nama_siswa,
        'tanggal_lahir' => $request->tanggal_lahir,
        'gender' => $request->gender,
        'alamat' => $request->alamat,
        'id_kelas' => $request->id_kelas
        
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
        'nama_siswa' => 'required',
        'tanggal_lahir' => 'required',
        'gender' => 'required',
        'alamat' => 'required',
        'id_kelas' => 'required'
    
    
    ]
    );
    if($validator->fails()) {
    return Response()->json($validator->errors());
    }
    $ubah = siswa::where('id_siswa', $id)->update([
        'nama_siswa' => $request->nama_siswa,
        'tanggal_lahir' => $request->tanggal_lahir,
        'gender' => $request->gender,
        'alamat' => $request->alamat,
        'id_kelas' => $request->id_kelas
   
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
    $hapus = siswa::where('id_siswa', $id)->delete();
    if($hapus) {
    return Response()->json(['status' => 1]);
    }
    else {
    return Response()->json(['status' => 0]);
    }
    }
}
