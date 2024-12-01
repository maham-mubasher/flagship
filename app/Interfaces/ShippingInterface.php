<?php

namespace App\Interfaces;

interface ShippingInterface
{
    public function createPickup(array $payload);
    public function cancelPickup(string $pickupId);
}
