<?php
namespace App\Traits;

use Symfony\Component\HttpFoundation\Response;

trait HasHttpResponse
{
    public function getSuccessJsonResponse($data = [], $message = 'Done !', $status = null)
    {
        return response()->json([
            'message' => __($message),
            'data' => $data,
            'status' => $status??Response::HTTP_OK
        ]);
    }

    public function getErrorJsonResponse($data = [], $message = 'Failed !', $status = null)
    {
        return response()->json([
            'message' => __($message),
            'data' => $data,
            'status' => $status??Response::HTTP_BAD_REQUEST
        ]);
    }
}
