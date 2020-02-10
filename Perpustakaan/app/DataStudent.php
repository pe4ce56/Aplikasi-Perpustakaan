<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class DataStudent extends Model
{
    protected $table = 'tbl_siswa';
    protected $primaryKey = 'NIS';

    public function class()
    {
        return $this->hasMany('App\DataClass', 'kode_kelas', 'kelas_kode_kelas');
    }
    public function class()
    {
        return $this->hasMany('App\DataClass', 'kode_kelas', 'kelas_kode_kelas');
    }
}
