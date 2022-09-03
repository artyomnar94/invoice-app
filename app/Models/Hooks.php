<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Hooks extends Model
{
    use HasFactory;

    protected $fillable = ['success', 'fail', 'expired'];
    public $timestamps = false;
}
