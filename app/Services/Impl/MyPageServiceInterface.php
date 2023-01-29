<?php

namespace App\Services\Impl;

use Illuminate\Support\Collection;

interface MyPageServiceInterface
{
    public function getAllReservedEvents(): Collection;
}
