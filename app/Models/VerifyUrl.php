<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class VerifyUrl extends Model
{
    use HasFactory;

    protected $table = 'url_verifies';
    protected $fillable=['url', 'response','http'];
}
