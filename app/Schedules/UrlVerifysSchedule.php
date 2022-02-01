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
                $responseUrl = VerifyUrl::SearchUrl($urlToSearch['url']);
                $this->UpdateCreateDB($responseUrl, $urlToSearch, $urlToSearch['id']);
            } catch (\Throwable $th) {
               Log::info('ERROR',[ 'URL '=>$urlToSearch['url'], 'message'=>$th->getMessage() ]);
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
    public function UpdateCreateDB($urlResponse, $urlSearch, $id)
    {

        $urlResponse = $urlResponse['response'];
        $data = [
            'response' => [
                'url'=> $urlSearch['url'],
                'response'=> utf8_encode($urlResponse->body()),
                'http'=> $urlResponse->status(),
                'url_id' => $id
            ]
        ];
        try {
            $save =  VerifyUrl::insert($data['response']);

        } catch (\Throwable $th) {
            Log::info('ERROR',[ 'URL '=>$data['response'], 'message'=>$th->getMessage() ]);
        }
    }
}
