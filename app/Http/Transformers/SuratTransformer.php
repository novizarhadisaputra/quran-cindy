<?php

namespace App\Http\Transformers;

use App\Http\Transformers\ResponseTransformer;

class SuratTransformer
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
        $tmp->name = $model->name;
        $tmp->text = $model->text;
        $tmp->order = $model->order;
        $tmp->slug = $model->slug;
        $tmp->text_translate = $model->text_translate;
        $tmp->category = (object) [
            'id' => $model->category->id,
            'name' => $model->category->name,
        ];
        $tmp->count_ayat = $model->ayats()->count();
        $tmp->created_at = $model->created_at;
        $tmp->updated_at = $model->updated_at;

        return $tmp;
    }
}
