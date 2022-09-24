<?php

namespace App\Repositories\Api;

use Exception;
use Illuminate\Support\Facades\Http;
use stdClass;

class TomTomRepository
{
    public function __construct()
    {
    }

    public function getAddress($request)
    {
        $dataAddress = [];
        try {
            $lat = $request->latitude;
            $long = $request->longitude;
            $urlAddress = env('APP_TOMTOM_URL') . "/search/2/reverseGeocode/$lat,$long.json?key=" . env('TOMTOM_API_KEY');
            $requestAddress = Http::get($urlAddress);
            $dataAddress = new stdClass;
            if ($requestAddress->successful()) {
                $responseAddress = (object) $requestAddress->json();
                $dataAddress = json_decode(json_encode($responseAddress->addresses));
            }
            return $dataAddress;
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
