<?php

namespace App\Http\Transformers;

use App\Http\Transformers\ResponseTransformer;
use stdClass;

class SuratTransformer
{

    public function all($code, $message, $models)
    {
        $data = [];

        foreach ($models as $model) {
            $data[] = $this->generateItem($model);
        }

        return (new ResponseTransformer)->toJson($code, $message, $models, $data);
    }

    public function detail($code, $message, $model)
    {
        $data = $this->generateItem($model);
        return (new ResponseTransformer)->toJson($code, $message, $data);
    }

    public function generateItem($model)
    {
        $tmp = new stdClass();
        $tmp->id = $model->id;
        $tmp->name = $model->name;
        $tmp->text = $model->text;
        $tmp->order = $model->order;
        $tmp->slug = $model->slug;
        $tmp->text_translate = $model->text_translate;
        $tmp->category = null;

        if ($model->category) {
            $tmp->category = new stdClass();
            $tmp->category->id = $model->category ? $model->category->id : null;
            $tmp->category->name = $model->category ? $model->category->name : null;
        }

        $tmp->count_ayat = $model->ayats()->count();
        $tmp->created_at = $model->created_at;
        $tmp->updated_at = $model->updated_at;

        return $tmp;
    }
}
