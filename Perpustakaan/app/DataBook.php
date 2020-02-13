<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class DataBook extends Model
{
    protected $table = 'tbl_buku';
    protected $primaryKey = 'kode_buku';
}
