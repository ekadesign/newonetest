<?php

namespace App\Services;

use App\Contracts\CountryCheckerInterface;
use Illuminate\Support\Collection;

class CountryChecker implements CountryCheckerInterface
{
    public function isEU(Collection $transactions): Collection
    {
        $countries = ['AT', 'BE', 'BG', 'CY', 'CZ', 'DE', 'DK', 'EE', 'ES', 'FI', 'FR', 'GR', 'HR', 'HU', 'IE', 'IT', 'LT', 'LU', 'LV', 'MT', 'NL', 'PO', 'PT', 'RO', 'SE', 'SI', 'SK',];
        return $transactions->map(function ($item) use ($countries) {
            $item->isEU = in_array(mb_strtoupper($item->country), $countries);
            return $item;
        });
    }
}
