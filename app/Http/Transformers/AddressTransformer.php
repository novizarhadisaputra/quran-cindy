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
        $tmp->country = null;
        $tmp->province = null;
        $tmp->city = null;
        $tmp->postalCode = null;
        $tmp->street = null;
        $tmp->municipalitySubdivision = null;
        $tmp->address = null;

        if (isset($model->address)) {
            $tmp->country = isset($model->address->country) ? $model->address->country : null;
            $tmp->province = isset($model->address->countrySubdivision) ? $model->address->countrySubdivision : null;
            $tmp->city = isset($model->address->municipality) ? $model->address->municipality : null;
            $tmp->postalCode = isset($model->address->postalCode) ? $model->address->postalCode : null;
            $tmp->street = isset($model->address->streetName) ? $model->address->streetName : null;
            $tmp->municipalitySubdivision = isset($model->address->municipalitySubdivision) ? $model->address->municipalitySubdivision : null;
            $tmp->address = isset($model->address->freeformAddress) ? $model->address->freeformAddress : null;
        }

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
