<?php

namespace App\Repositories;

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
            $surats = $this->surat->search($request->search)->get();
            return view('surat.index', compact('surats'));
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
            return view('surat.detail', compact('surat'));
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
