<?php

namespace App\Trait;

use App\Enums\ApiCode;
use Illuminate\Support\Facades\Response;

trait ApiResponseTrait
{
    protected int $statusCode = ApiCode::HTTP_OK;

    public function getStatusCode(): int
    {
        return $this->statusCode;
    }

    /**
     * @return $this
     */
    public function setStatusCode($statusCode): static
    {
        $this->statusCode = $statusCode;

        return $this;
    }

    public function respond($data, array $header = []): \Illuminate\Http\JsonResponse
    {
        return Response::json($data, $this->getStatusCode(), $header);
    }

    /**
     * @param  null  $code
     */
    public function status($status, array $data, $code = null): \Illuminate\Http\JsonResponse
    {
        if ($code) {
            $this->setStatusCode($code);
        }

        $status = [
            'status' => $status,
            'code' => $this->statusCode,
        ];

        $data = array_merge($status, $data);

        return $this->respond($data);

    }

    public function failed($message, int $code = ApiCode::BAD_REQUEST): \Illuminate\Http\JsonResponse
    {
        return $this->status('error', [
            'message' => $message,
            'code' => $code,
        ]);
    }

    public function message($message, string $status = 'success'): \Illuminate\Http\JsonResponse
    {
        return $this->status($status, [
            'message' => $message,
        ]);
    }

    public function success($data, string $status = 'success'): \Illuminate\Http\JsonResponse
    {
        return $this->status($status, compact('data'));
    }
}
