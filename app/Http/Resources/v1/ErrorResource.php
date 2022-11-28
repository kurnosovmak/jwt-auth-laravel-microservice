<?php

namespace App\Http\Resources\v1;

use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class ErrorResource extends JsonResource
{

    public function __construct(protected string $message, protected int $status_code = 401)
    {
    }

    /**
     * Transform the resource into an array.
     *
     * @param Request $request
     * @return array
     */
    public function toArray($request)
    {
        return [
            'status' => $this->status_code,
            'message' => $this->message,
        ];
    }

    public function toResponse($request): JsonResponse
    {
        return parent::toResponse($request)->setStatusCode($this->status_code);
    }
}
