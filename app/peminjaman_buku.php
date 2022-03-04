<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class peminjaman_buku extends Model
{
    protected $table ='peminjaman_buku';
    public $timestamps =false;

    protected $fillable =['id_siswa','tanggal_pinjam','tanggal_kembali']; 
}
