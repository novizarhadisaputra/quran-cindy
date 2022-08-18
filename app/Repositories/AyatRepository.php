<?php

namespace App\Repositories;

use App\Models\Ayat;
use App\Models\Surat;
use Exception;

class AyatRepository
{
    protected $ayat;
    protected $surat;

    public function __construct()
    {
        $this->ayat = new Ayat();
        $this->surat = new Surat();
    }

    public function index($request, $slug)
    {
        if (!$surat = $this->surat->where('slug', $slug)->first()) {
            abort(404);
        }

        try {
            $id = $surat->id;
            $prev = $this->surat->where('order', $surat->order - 1)->first();
            $next = $this->surat->where('order', $surat->order + 1)->first();
            $ayats = $this->ayat->where('surat_id', $id)->search($request->search)->get();
            return view('ayat.index', compact('ayats', 'id', 'prev', 'next'));
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
