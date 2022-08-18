<?php

namespace App\Repositories\Api;

use Exception;
use Illuminate\Support\Facades\Http;

class AdzanRepository
{
    public function __construct()
    {
    }

    public function index($request)
    {
        $dataAdzan = [];
        try {
            $lat = $request->latitude;
            $long = $request->longitude;
            $month = $request->input('month', date('m'));
            $year = $request->input('year', date('Y'));
            $urlAdzan = "https://api.aladhan.com/v1/calendar?latitude=$lat&longitude=$long&method=2&month=$month&year=$year";
            $requestAdzan = Http::get($urlAdzan);
            if ($requestAdzan->successful()) {
                $responseAyat = (object) $requestAdzan->json();
                $dataAdzan = json_decode(json_encode($responseAyat->data));
            }
            return $dataAdzan;
        } catch (Exception $e) {
            throw $e;
        }
    }

    public function create()
    {

    }

    public function store($request)
    {

    }

    public function show($request)
    {
        try {
            $ayat = $this->ayat->find($request->id);
            return $ayat;
        } catch (Exception $e) {
            throw $e;
        }
    }

    public function edit($request)
    {

    }

    public function update($request)
    {

    }

    public function destroy($id)
    {

    }
}
