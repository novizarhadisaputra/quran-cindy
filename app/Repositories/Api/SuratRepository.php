<?php

namespace App\Repositories\Api;

use App\Models\Surat;
use Exception;

class SuratRepository
{
    protected $surat;

    public function __construct()
    {
        $this->surat = new Surat();
    }

    public function index($request)
    {
        try {
            $allSurat = $this->surat->search($request->search)->customPaginate($request);
            return $allSurat;
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
            $surat = $this->surat->find($request->id);
            return $surat;
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
