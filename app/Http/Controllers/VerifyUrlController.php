<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Url as UrlModel;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Artisan;

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
        if(!isset($request->url)) return redirect('/dashboard?failed=checkurl');
        $url = $request->url;
        $data = [
            'url' => $url,
            'tested' => 0,
            'user_id' => $userId
        ];
        try {
            $createData = UrlModel::updateOrCreate($data);
            Artisan::call('schedule:run');
            return redirect('/dashboard?success=true');
        } catch (\Throwable $th) {
            Log::info(['error' => $th->getMessage()]);
            return $th->getMessage();
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        try {
            $id = UrlModel::find($id)->delete();
            return redirect('/dashboard?deleted=true');
        } catch (\Throwable $th) {
            return redirect('/dashboard?deleted=false');

        }

    }
}
