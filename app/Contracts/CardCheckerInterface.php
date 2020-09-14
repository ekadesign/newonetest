<?php

namespace App\Contracts;


use Illuminate\Support\Collection;

interface CardCheckerInterface {
    public function getCountryByBin(Collection $transactions): Collection;
}
