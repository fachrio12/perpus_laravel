<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class buku extends Model
{
    protected $table ='buku';
    public $timestamps =false;

    protected $fillable =['nama_buku','pengarang','deskripsi']; 
}
