<?php

namespace App\Schedules;

use App\Models\Url;
use App\Models\VerifyUrl;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\DB;

class UrlVerifysSchedule
{
    public $timeout = 600;

    public function __invoke()
    {
        $arrayUrls = collect(Url::get()->where('tested', '=', 0));
        //captura urls a serem usadas
        $urls = $arrayUrls->toArray();
        //caso esteja vazio, já vai parar o schedule
        if(empty($arrayUrls) || !isset($arrayUrls)) exit;
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
 * Undocumented function
 *
 * @param [type] $urlResponse response do guzzle
 * @param [type] $urlSearch onde teremos a url pesquisada
 * @param [type] $id id da URL em urls
 * @return void
 */
    public function UpdateCreateDB($urlResponse, $urlSearch, $id)
    {
        DB::table('urls')
              ->where('id', $id)
              ->update(['tested' => true]);
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
