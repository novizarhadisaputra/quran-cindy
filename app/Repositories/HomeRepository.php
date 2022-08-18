<?php

namespace App\Repositories;

use App\Models\Surat;
use Exception;

class HomeRepository
{
    protected $surat;

    public function __construct()
    {
        $this->surat = new Surat();
    }

    public function index($request)
    {
        try {
            return view('home.index');
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
