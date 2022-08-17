<?php

namespace App\Repositories\Api;

use App\Models\Ayat;
use App\Models\Tafsir;
use Exception;

class TafsirRepository
{
    protected $tafsir;
    protected $ayat;

    public function __construct()
    {
        $this->tafsir = new Tafsir();
        $this->ayat = new Ayat();
    }

    public function index($request)
    {
        try {
            $allTafsir = $this->tafsir->search($request->search)->customPaginate($request);
            return $allTafsir;
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
            $tafsir = $this->tafsir->find($ayat->tafsir->id);
            return $tafsir;
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
