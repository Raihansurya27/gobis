<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class FasilitasBus extends Model
{
    use HasFactory;
    protected $guarded = [];

    public function fasilitas(){
        return $this->belongsTo(Fasilitas::class);
    }

    public function bus(){
        return $this->belongsTo(Bus::class);
    }

}
