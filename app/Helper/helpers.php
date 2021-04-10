<?php

use Illuminate\Http\JsonResponse;
use Illuminate\Http\Resources\Json\JsonResource;

/**
 * Returns a default error response
 * @param string $message
 * @param int $statusCode
 * @return JsonResponse
 */
function errorResponse(string $message, int $statusCode = 500) : JsonResponse
{
    $response = [
        "message" => $message,
        "data" => [],
    ];

    return response()->json($response, $statusCode);
}

/**
 * @param JsonResource $jsonResource
 * @param int $statusCode
 * @return JsonResponse
 */
function resourceResponse(JsonResource $jsonResource, int $statusCode = 200) : JsonResponse
{
    $response = [
        "data" => $jsonResource,
    ];

    return response()->json($response, $statusCode);
}
