<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class siswa extends Model
{
    protected $table ='siswa';
    public $timestamps =false;

    protected $fillable =['nama_siswa','tanggal_lahir','gender','alamat','id_kelas']; 
}
