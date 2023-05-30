<?php

namespace App\Traits;

trait ResponseCreator
{
    public function createResponse(int $statusCode, string $message = null, $data = [], $errors = [])
    {
        return response()->json(
            [
                "status-code" => $statusCode,
                "message" => $message,
                "data" => $data,
                "errors" => $errors
            ],
            $statusCode
        );
    }

    public function createResponseSuccess($data = [], $codeSuccess = 200, $message = null)
    {
        return $this->createResponse($codeSuccess, $message ?? "success", $data);
    }

    public function createResponseNotFound($message = null, $errors = null)
    {
        return $this->createResponse(404, $message ?? "Not Found", [], $errors);
    }

    public function createResponseBadRequest($message = null, $errors = null, int $statusCode = 400)
    {
        return $this->createResponse($statusCode, $message ?? "fail", [], $errors);
    }

    public function createResponseInternalError($errors = null,)
    {
        return $this->createResponse(500, "fail", [], $errors->getMessage());
    }

    public function createResponseForbbiden()
    {
        return $this->createResponse(403, "fail", [], "Forbbiden");
    }
}
