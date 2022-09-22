<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\GetAddressRequest;
use App\Http\Transformers\AddressTransformer;
use Illuminate\Http\Request;

class TomTomController extends Controller
{
    protected $tomtom;

    public function __construct()
    {
        $this->tomtom = app()->make('repository.api.tomtom');
    }

    public function getAddress(GetAddressRequest $request)
    {
        try {
            $response = $this->tomtom->getAddress($request);
            if ($response instanceof MessageBag == true) {
                return (new ResponseTransformer)->toJson(400, __('messages.400'), $response);
            }
            if (!$response) {
                return (new ResponseTransformer)->toJson(400, __('messages.400'), false);
            }
            return (new AddressTransformer)->detail(200, __('messages.200'), $response);
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
    public function show($id)
    {
        //
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
