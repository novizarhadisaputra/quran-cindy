<?php

namespace App\Http\Transformers;

use App\Helpers\GlobalHelper;
use App\Http\Transformers\ResponseTransformer;
use stdClass;

class AddressTransformer
{

    public function all($code, $message, $models)
    {
        $data = [];

        foreach ($models as $model) {
            $customeData[] = $this->generateItem($model);
        }
        return (new ResponseTransformer)->toJson($code, $message, $customeData);
    }

    public function detail($code, $message, $model)
    {
        $customeData = $this->generateItem($model);
        return (new ResponseTransformer)->toJson($code, $message, $model, $customeData);
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
}
