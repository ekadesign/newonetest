<?php

namespace App\Http\Controllers;

use App\Models\Transaction;
use App\Contracts\CardCheckerInterface as CardChecker;
use App\Contracts\CountryCheckerInterface as CountryChecker;
use App\Contracts\RateCheckerInterface as RateChecker;
use Illuminate\Http\Request;
use Illuminate\Support\Collection;

class OutputController extends Controller
{
    /**
     * @var CardChecker
     */
    public $cardChecker;
    /**
     * @var RateChecker
     */
    public $rateChecker;
    /**
     * @var CountryChecker
     */
    private $countryChecker;

    public function __construct(CardChecker $cardChecker, CountryChecker $countryChecker, RateChecker $rateChecker)
    {
        $this->cardChecker = $cardChecker;
        $this->countryChecker = $countryChecker;
        $this->rateChecker = $rateChecker;
    }

    public function calculate(Collection $transactions)
    {
        $txWithAmounts = ($this->countryChecker->isEU($this->cardChecker->getCountryByBin($this->rateChecker->getAmountByRate($transactions))))->map(function ($item) {
            if($item->isEU){
                $item->amount = $item->amount * 0.01;
            }else{
                $item->amount = $item->amount * 0.02;
            }
            return $item;
        });
        return view('calculation', ['transactions' => $txWithAmounts]);
    }
}
