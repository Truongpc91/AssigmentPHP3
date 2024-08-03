<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Coupon extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'code',
        'type',
        'expired_time',
        'quantity',
        'value'
    ];

    public function users(){
        return $this->belongsToMany(User::class);
    }
}
