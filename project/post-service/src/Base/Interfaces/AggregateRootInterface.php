<?php

namespace App\Base\Interfaces;

interface AggregateRootInterface
{
    public function toArray(): array;
}