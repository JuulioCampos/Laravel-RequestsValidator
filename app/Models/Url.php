<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Url extends Model
{
    use HasFactory;

    protected $table = 'urls';
    protected $fillable=['url', 'tested', 'user_id'];

    public function users()
    {
        return $this->hasMany(User::class, 'user_id','id');
    }

    public function verifyUrl()
    {
        return $this->hasMany(VerifyUrl::class, 'url_id','id');
    }

}
