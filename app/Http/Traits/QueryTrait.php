<?php

namespace App\Http\Traits;

trait QueryTrait
{
    public function scopeSearch($query, $search = null)
    {
        $sql = $query;
        $columns = array_filter($this->fillable, function ($val) {
            return strpos($val, '_id') === false;
        });
        if ($search) {
            foreach ($columns as $value) {
                $sql = $sql->orWhere($value, 'like', '%' . $search . '%');
            }
        }

        return $sql;
    }

    public function scopeOrder($query, $request)
    {
        $sql = $query->orderBy($request->input('column', 'created_at'), $request->input('order_by', 'asc'));
        return $sql;
    }

    public function scopeCustomPaginate($query, $request)
    {
        $sql = $query->paginate($request->input('per_page', 10));
        return $sql;
    }

    public function scopeFilter($query, $fields = null)
    {
        $sql = $query;
        if ($fields) {
            foreach ($fields as $key => $value) {
                $sql = $sql->where($key, 'like', '%' . $value . '%');
            }
        }

        return $sql;
    }

    public function getCreatedAtAttribute($value)
    {
        $dateCreated = strtotime($value);
        return date("d M Y H:i:s", $dateCreated);
    }

    public function getUpdatedAtAttribute($value)
    {
        $dateUpdated = strtotime($value);
        return date("d M Y H:i:s", $dateUpdated);
    }
}
