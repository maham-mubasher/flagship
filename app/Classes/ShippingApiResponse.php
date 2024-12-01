<?php
namespace App\Classes;

use App\Interfaces\ShippingResponseInterface;

class ShippingApiResponse implements ShippingResponseInterface
{
    protected $success;
    protected $response;
    protected $errorMessage;

    public function __construct(bool $success, array $response = [], string $errorMessage = '')
    {
        $this->success = $success;
        $this->response = $response;
        $this->errorMessage = $errorMessage;
    }

    public function isSuccess(): bool
    {
        return $this->success;
    }

    public function getResponse(): array
    {
        return $this->response;
    }

    public function getErrorMessage(): string
    {
        return $this->errorMessage;
    }
}