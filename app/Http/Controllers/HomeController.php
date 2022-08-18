<?php

namespace App\Http\Controllers;

use App\Http\Requests\IndexSuratRequest;
use Exception;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    protected $home;

    public function __construct()
    {
        $this->home = app()->make('repository.home');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        try {
            $response = $this->home->index($request);
            return $response;
        } catch (Exception $e) {
            throw $e;
        }
    }
}
