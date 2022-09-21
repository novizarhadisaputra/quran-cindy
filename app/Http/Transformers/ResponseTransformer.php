<?php

namespace App\Http\Transformers;

use stdClass;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;

class ResponseTransformer
{
    public function toJson($statusCode = null, $message = null, $collection = null, $data = null)
    {
        $result = new stdClass();
        $result->status = $statusCode;
        $result->message = $message;
        $result->data = $collection;

        if ($collection != null && $collection instanceof LengthAwarePaginator) {
            $result->data = $data ?? $collection->items();
            $result->pagination = new stdClass;
            $result->pagination->perPage = $collection->perPage();
            $result->pagination->currentPage = $collection->currentPage();
            $result->pagination->lastPage = $collection->lastPage();
            $result->pagination->previousPageUrl = $collection->previousPageUrl();
            $result->pagination->nextPageUrl = $collection->nextPageUrl();
            $result->pagination->total = $collection->total();
        }

        return response()->json($result, $statusCode);
    }
}
