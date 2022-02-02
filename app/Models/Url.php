<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Url extends Model
{
    use HasFactory;
    use SoftDeletes;

    protected $table = 'urls';
    protected $fillable=['url', 'tested', 'user_id'];
    protected $dates = ['deleted_at'];

    public function users()
    {
        return $this->hasMany(User::class, 'user_id','id');
    }

    public function verifyUrl()
    {
        return $this->hasMany(VerifyUrl::class, 'url_id','id');
    }

}
