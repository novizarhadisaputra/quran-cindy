<?php

namespace App\Http\Transformers;

use App\Http\Transformers\ResponseTransformer;
use stdClass;

class AddressTransformer
{

    public function all($code, $message, $models)
    {
        $data = $this->data($models);
        return (new ResponseTransformer)->toJson($code, $message, $data);
    }

    public function detail($code, $message, $model)
    {
        $data = $this->data($model)[0];
        return (new ResponseTransformer)->toJson($code, $message, $data);
    }

    public function generateItem($model)
    {
        $tmp = new stdClass();
        $tmp->country = $model->address->country;
        $tmp->province = $model->address->countrySubdivision;
        $tmp->city = $model->address->municipality;
        $tmp->postalCode = $model->address->postalCode;
        $tmp->street = $model->address->streetName;
        $tmp->municipalitySubdivision = $model->address->municipalitySubdivision;
        $tmp->address = $model->address->freeformAddress;

        return $tmp;
    }

    public function data($models)
    {
        $data = [];
        foreach ($models as $model) {
            $data[] = $this->generateItem($model);
        }
        return $data;
    }
}
