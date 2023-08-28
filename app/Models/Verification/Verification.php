<?php

namespace App\Models\Verification;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Verification extends Model
{
    use HasFactory;
    protected $fillable = ['phone', 'email', 'dial_code', 'verfied', 'otp', 'user_id', 'verified_at'];
}
