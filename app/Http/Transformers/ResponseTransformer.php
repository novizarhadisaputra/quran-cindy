<?php

namespace App\Http\Transformers;

use Illuminate\Http\JsonResponse;

class ResponseTransformer
{
    public function toJson($code = null, $message = null, $data = null, $custom_data = null)
    {
        $site_setting = app('request')->get('site_setting');

        $response = [
            'status' => $code,
            'message' => $message,
        ];

        if ($data) {
            if (method_exists($data, 'perPage')) {
                $prevUrl = $data->previousPageUrl();
                $nextUrl = $data->nextPageUrl();
                $perPage = '&per_page=' . $data->perPage();

                $response['data'] = $data->toArray()['data'];
                $response['pagination'] = [
                    'current_page' => $data->currentPage(),
                    'total' => $data->total(),
                    'per_page' => (int) $data->perPage(),
                    'last_page' => $data->lastPage(),
                    'next_page_url' => $nextUrl != null ? $nextUrl . $perPage : $nextUrl,
                    'prev_page_url' => $prevUrl != null ? $prevUrl . $perPage : $prevUrl,
                    'from' => $data->firstItem(),
                    'to' => $data->lastItem(),
                ];

                $data = $response['data'];
            }
        }

        $response['data'] = $custom_data === null ? $data : $custom_data;

        return new JsonResponse($response, $code, []);
    }
}
