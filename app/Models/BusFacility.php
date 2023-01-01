<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BusFacility extends Model
{
    use HasFactory;
    protected $guarded = [];

    public function facility(){
        return $this->belongsTo(Facility::class);
    }
}
