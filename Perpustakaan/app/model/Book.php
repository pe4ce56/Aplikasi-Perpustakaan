<?php

namespace App\model;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Book extends Model
{
    protected $fillable = ['code', 'title', 'publisher', 'author', 'image'];

    public function transaction()
    {
        return $this->belongsToMany(Transaction::class);
    }
}
