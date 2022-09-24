<?php

namespace App\Http\Transformers;

use App\Http\Transformers\ResponseTransformer;
use stdClass;

class AdzanTransformer
{

    public function all($code, $message, $models)
    {
        $collection = $this->data($models);
        return (new ResponseTransformer)->toJson($code, $message, $collection);
    }

    public function detail($code, $message, $model, $request = null)
    {
        $data = $this->data($model);
        $collection = null;
        foreach ($data as $collect) {
            if ($request->day == $collect->date->masehi->day) {
                $collection = $collect;
                break;
            }
        }
        return (new ResponseTransformer)->toJson($code, $message, $collection);
    }

    public function generateItem($model)
    {
        $tmp = new stdClass();
        $tmp->timings = null;
        if ($model->timings) {
            $tmp->timings = new stdClass;
            foreach ($model->timings as $key => $value) {
                $data = explode(' ', $value);
                $tmp->timings->{$key} = $data[0];
            }
        }
        $tmp->prays = null;
        if ($model->timings) {
            $tmp->prays = new stdClass;
            foreach ($model->timings as $key => $value) {
                if (in_array($key, ['Fajr', 'Dhuhr', 'Asr', 'Maghrib', 'Isha'])) {
                    $data = explode(' ', $value);
                    $tmp->prays->{$key} = $data[0];
                }
            }
        }
        $tmp->active = $model->date->gregorian->date === date('d-m-Y') ? true : false;
        $tmp->date = (object) [
            'masehi' => (object) [
                'date' => $model->date->gregorian->date,
                'day' => $model->date->gregorian->day,
                'weekday' => (object) [
                    'en' => $model->date->gregorian->weekday->en,
                ],
                'month' => (object) [
                    'number' => $model->date->gregorian->month->number,
                    'en' => $model->date->gregorian->month->en,
                ],
                'year' => $model->date->gregorian->year,
            ],
            'hijriah' => (object) [
                'date' => $model->date->hijri->date,
                'day' => $model->date->hijri->day,
                'weekday' => (object) [
                    'en' => $model->date->hijri->weekday->en,
                    'ar' => $model->date->hijri->weekday->ar,
                ],
                'month' => (object) [
                    'number' => $model->date->hijri->month->number,
                    'en' => $model->date->hijri->month->en,
                    'ar' => $model->date->hijri->month->ar,
                ],
                'year' => $model->date->hijri->year,
            ],
        ];
        return $tmp;
    }

    public function data($models)
    {
        $collection = [];

        foreach ($models as $model) {
            $collection[] = $this->generateItem($model);
        }

        return $collection;
    }
}
