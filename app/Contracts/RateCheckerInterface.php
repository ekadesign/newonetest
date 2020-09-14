<?php

namespace App\Contracts;

use Illuminate\Support\Collection;

interface RateCheckerInterface {
    public function getAmountByRate(Collection $currencies): Collection;
}
