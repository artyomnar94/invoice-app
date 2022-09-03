<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Merchant extends Model
{
    use HasFactory;

    protected $table = 'merchant';
    protected $fillable = ['login', 'state'];
    public $timestamps = false;

    public function invoices()
    {
        return $this->hasMany(Invoice::class);
    }
}
