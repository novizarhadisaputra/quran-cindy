<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\DetailAyatRequest;
use App\Http\Requests\IndexAyatRequest;
use App\Http\Transformers\AyatTransformer;
use App\Http\Transformers\ResponseTransformer;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\MessageBag;

class AyatController extends Controller
{
    protected $ayat;

    public function __construct()
    {
        $this->ayat = app()->make('repository.api.ayat');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(IndexAyatRequest $request)
    {
        try {
            $response = $this->ayat->index($request);
            if ($response instanceof MessageBag == true) {
                return (new ResponseTransformer)->toJson(400, __('messages.400'), $response);
            }
            if (!$response) {
                return (new ResponseTransformer)->toJson(400, __('messages.400'), false);
            }
            return (new AyatTransformer)->all(200, __('messages.200'), $response);
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
    public function show(DetailAyatRequest $request)
    {
        try {
            $response = $this->ayat->show($request);
            if ($response instanceof MessageBag == true) {
                return (new ResponseTransformer)->toJson(400, __('messages.400'), $response);
            }
            if (!$response) {
                return (new ResponseTransformer)->toJson(400, __('messages.400'), false);
            }
            return (new AyatTransformer)->detail(200, __('messages.200'), $response);
        } catch (Exception $e) {
            throw $e;
        }
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
