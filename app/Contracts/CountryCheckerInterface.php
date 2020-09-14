<?php

namespace App\Contracts;

use Illuminate\Support\Collection;

interface CountryCheckerInterface {
    public function isEU(Collection $country): Collection;
}
