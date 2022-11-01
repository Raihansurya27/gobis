<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Terminal extends Model
{
    use HasFactory;
    protected $guarded = [];

    public function provinsi(){
        return $this->belongsTo(Provinsi::class);
    }

    public function kabupaten(){
        return $this->belongsTo(Kabupaten::class);
    }

    public function kecamatan(){
        return $this->belongsTo(Kecamatan::class);
    }

    public function kelurahan(){
        return $this->belongsTo(Kelurahan::class);
    }
}
