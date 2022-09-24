<?php

namespace App\Http\Controllers\Api;

use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\MessageBag;
use App\Http\Controllers\Controller;
use App\Http\Requests\DetailAdzanRequest;
use App\Http\Requests\IndexAdzanRequest;
use App\Http\Transformers\AdzanTransformer;
use App\Http\Transformers\ResponseTransformer;

class AdzanController extends Controller
{
    protected $adzan;

    public function __construct()
    {
        $this->adzan = app()->make('repository.api.adzan');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(IndexAdzanRequest $request)
    {
        try {
            $response = $this->adzan->index($request);
            if ($response instanceof MessageBag == true) {
                return (new ResponseTransformer)->toJson(400, __('messages.400'), $response);
            }
            if (!$response) {
                return (new ResponseTransformer)->toJson(400, __('messages.400'), false);
            }
            return (new AdzanTransformer)->all(200, __('messages.200'), $response);
        } catch (Exception $e) {
            throw $e;
        }
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(DetailAdzanRequest $request)
    {
        try {
            $response = $this->adzan->show($request);
            if ($response instanceof MessageBag == true) {
                return (new ResponseTransformer)->toJson(400, __('messages.400'), $response);
            }
            if (!$response) {
                return (new ResponseTransformer)->toJson(400, __('messages.400'), false);
            }
            return (new AdzanTransformer)->detail(200, __('messages.200'), $response, $request);
        } catch (Exception $e) {
            throw $e;
        }
    }
}
