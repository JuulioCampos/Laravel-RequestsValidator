<?php

namespace App\Schedules;

use Illuminate\Http\Request;
use App\Models\Url;
use App\Models\VerifyUrl;
use Illuminate\Support\Facades\Log;


class UrlVerifysSchedule
{
    public $timeout = 600;

    public function __invoke()
    {
        $arrayUrls = collect(Url::get()->all());
        //captura urls a serem usadas
        $urls = $arrayUrls->toArray();

        foreach ($urls as $urlToSearch) {
            try {
                $responseUrl = VerifyUrl::Search($urlToSearch->url);
                $this->UpdateCreateDB($responseUrl, $urlToSearch);
            } catch (\Throwable $th) {
               Log::info('ERROR',[ 'URL '=>$urlToSearch, 'message'=>$th->getMessage() ]);
            }
        }
    }

    /**
     * Salva no banco, os dados das URLS pesquisadas
     *
     * @param [type] $urlResponse
     * @param [type] $urlSearch
     * @return void
     */
    public function UpdateCreateDB($urlResponse, $urlSearch)
    {
        $data = [
            'response' => [
                'url'=> $urlSearch,
                'response'=> utf8_encode($urlResponse->body()),
                'http'=> $urlResponse->status(),
            ]
        ];
        try {
            $save =  VerifyUrl::updateOrCreate(['url'=>$urlSearch], $data['response']);
        } catch (\Throwable $th) {
            return 'There a error on save';
        }
    }
}
