<?php

namespace App\Http\Transformers;

use App\Http\Transformers\ResponseTransformer;

class TafsirTransformer
{

    public function all($code, $message, $models)
    {
        $customeData = [];

        foreach ($models as $model) {
            $customeData[] = $this->generateItem($model);
        }
        return (new ResponseTransformer)->toJson($code, $message, $models, $customeData);
    }

    public function detail($code, $message, $model)
    {
        $customeData = $this->generateItem($model);
        return (new ResponseTransformer)->toJson($code, $message, $model, $customeData);
    }

    public function generateItem($model)
    {
        $tmp = new \stdClass();
        $tmp->id = $model->id;
        $tmp->ayat = (object) [
            'id' => $model->ayat->id,
            'name' => $model->ayat->name,
        ];
        $tmp->tafsir_wajiz = $model->tafsir_wajiz;
        $tmp->tafsir_tahlili = $model->tafsir_tahlili;
        $tmp->created_at = $model->created_at;
        $tmp->updated_at = $model->updated_at;

        return $tmp;
    }
}
