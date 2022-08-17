<?php

namespace App\Http\Transformers;

use App\Helpers\GlobalHelper;
use App\Http\Transformers\ResponseTransformer;

class AyatTransformer
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
        $tmp->text = $model->text;
        $tmp->text_translate = $model->text_translate;
        $tmp->surat = (object) [
            'id' => $model->surat->id,
            'name' => $model->surat->name,
            'order' => $model->surat->order,
        ];
        $tmp->tafsir = (object) [
            'id' => $model->tafsir->id,
            'tafsir_wajiz' => $model->tafsir->tafsir_wajiz,
            'tafsir_tahlili' => $model->tafsir->tafsir_tahlili,
        ];
        $tmp->audio = (object) [
            'id' => $model->file->id,
            'file_name' => $model->file->file_name,
            'file_path' => $model->file->file_path,
            'file_url' => (new GlobalHelper)->getFile($model->file->file_path, $model->file->file_name),
        ];
        $tmp->created_at = $model->created_at;
        $tmp->updated_at = $model->updated_at;

        return $tmp;
    }
}
