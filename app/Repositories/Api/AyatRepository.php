<?php

namespace App\Repositories\Api;

use App\Models\Ayat;
use Exception;

class AyatRepository
{
    protected $ayat;

    public function __construct()
    {
        $this->ayat = new Ayat();
    }

    public function index($request)
    {
        try {
            $allAyat = $this->ayat
                ->where('surat_id', $request->surat_id)
                ->search($request->search)
                ->customPaginate($request);
            return $allAyat;
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
