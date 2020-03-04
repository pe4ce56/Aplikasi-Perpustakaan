<?php

namespace App\model;

use Illuminate\Database\Eloquent\Model;

class Transaction extends Model
{

    public function book()
    {
        return $this->belongsToMany(Book::class)->withPivot('status');
    }

    public function student()
    {
        return $this->belongsTo(Student::class);
    }

    public function operator()
    {
        return $this->belongsTo(Operator::class);
    }
}
