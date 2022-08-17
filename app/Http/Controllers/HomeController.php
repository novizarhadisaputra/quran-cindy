<?php

namespace App\Http\Controllers;

use App\Http\Requests\IndexSuratRequest;
use Exception;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    protected $surat;
    protected $ayat;

    public function __construct()
    {
        $this->surat = app()->make('repository.surat');
        $this->ayat = app()->make('repository.ayat');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(IndexSuratRequest $request)
    {
        try {
            $response = $this->surat->index($request);
            return $response;
        } catch (Exception $e) {
            throw $e;
        }
    }

    public function detail(Request $request, $slug)
    {
        try {
            $response = $this->ayat->index($request, $slug);
            return $response;
        } catch (Exception $e) {
            throw $e;
        }
    }
}
