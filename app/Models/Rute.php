<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Rute extends Model
{
    use HasFactory;
    protected $guarded = [];

    public function awal(){
        return $this->belongsTo(Terminal::class);
    }

    public function tujuan(){
        return $this->belongsTo(Terminal::class);
    }
}
