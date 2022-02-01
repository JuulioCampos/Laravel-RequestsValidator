<?php

namespace App\Models;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Http;
use Illuminate\Http\Client\Pool;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class VerifyUrl extends Model
{
    use HasFactory;

    protected $table = 'url_verifies';
    protected $fillable=['url', 'response','http'];

    public function Url()
    {
        return $this->hasMany(Url::class, 'id','url_id');
    }

    public function SearchUrl(string $url)
    {
        try {
            $response = Http::get($url);
        } catch (\Throwable $th) {
            return [
                'success'=> false,
                'message'=> $th->getMessage()
            ];
        }

        return [
            'success' => true,
            'response' => $response
        ];
    }
}
