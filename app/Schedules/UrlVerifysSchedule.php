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
        if (empty($arrayUrls) || !isset($arrayUrls)) exit;
        foreach ($urls as $urlToSearch) {
            try {
                $responseUrl = VerifyUrl::SearchUrl($urlToSearch['url']);
                $save = $this->UpdateCreateDB($responseUrl, $urlToSearch, $urlToSearch['id']);
            } catch (\Throwable $th) {
                $save =  $this->UpdateCreateDB($responseUrl, $urlToSearch, $urlToSearch['id'], 404, 'not found');
                Log::info('ERROR', ['URL' => $urlToSearch['url'], 'message' => $th->getMessage()]);
            }
        }
    }

    /**
     * function for create or update
     *
     * @param [type] $urlResponse response do guzzle
     * @param [type] $urlSearch onde teremos a url pesquisada
     * @param [type] $id id da URL em urls
     * @return void
     */
    public function UpdateCreateDB(array $urlResponse = [], array $urlSearch, int $id, int $http = null, string $body = null)
    {
        DB::table('urls')
            ->where('id', $id)
            ->update(['tested' => true]);

        isset($urlResponse['response']) ? $urlResponse = $urlResponse['response'] : $urlResponse = [];

        $data = [
            'response' => [
                'url' => $urlSearch['url'],
                'response' => isset($body) ? $body : utf8_encode($urlResponse->body()),
                'http' => isset($http) ? $http : $urlResponse->status(),
                'url_id' => $id
            ]
        ];
        try {
            $save =  VerifyUrl::insert($data['response']);
        } catch (\Throwable $th) {
            Log::info('ERROR', ['URL ' => $data['response'], 'message' => $th->getMessage()]);
        }
    }
}
