<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Client\Response;
use Illuminate\Support\Facades\Http;
use App\Models\VerifyUrl;
class VerifyUrlController extends Controller
{
    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $url = $request->url;
        try {
            $response = Http::get($url);

        } catch (\Throwable $th) {
            return ['failed'=>'invalid URL'];
        }
        $data = [
            'response' => [
                'url'=> $url,
                'response'=> utf8_encode($response->body()),
                'http'=> $response->status(),
            ]
        ];
        $user = '';
        try {
            $save =  VerifyUrl::updateOrCreate(['url'=>$url, 'user_id'=> $user], $data['response']);
        } catch (\Throwable $th) {
            return 'There a error on save';
        }

        return $data;
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $id =  VerifyUrl::findOrFail($id);


    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
