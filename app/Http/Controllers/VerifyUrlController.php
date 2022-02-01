<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Url as UrlModel;
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
        //tratado, pois utilizando postman, terei menos trabalho para autentica-lo por lá
        auth()->check() ? $userId = auth()->user()->id : $userId = 1;

        $urls = $request->url;
        foreach($urls as $key => $url) {
            $data = [
                'url' => $url,
                'tested'=> 0,
                'user_id'=> $userId
            ];
            try {
                $createData = UrlModel::create($data);
                return ['success' => 'database updated'];
            } catch (\Throwable $th) {
                return ['error'=> $th->getMessage()];
            }
        }

    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {


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
