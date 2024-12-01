<?php

namespace App\Interfaces;

interface ShippingResponseInterface
{
    public function isSuccess(): bool;
    public function getResponse(): array;
    public function getErrorMessage(): string;
}