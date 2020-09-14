<?php

namespace App\Services;

use App\Contracts\RateCheckerInterface;
use GuzzleHttp\Client;
use GuzzleHttp\Exception\GuzzleException;
use Illuminate\Support\Collection;

class RateChecker implements RateCheckerInterface
{
    public function getAmountByRate(Collection $transactions): Collection
    {
        $url = 'https://api.exchangeratesapi.io/latest';
        $client = new Client();

        try {
            $response = $client->get($url);
            $ratesRequest = $response->getBody();

        } catch (GuzzleException $e) {
            throw new \Exception("Currency problems" . ' ' . $e->getMessage());
        }
        foreach ($transactions as $tx) {
            $rate = @json_decode($ratesRequest, true);
            if ($tx->currency == $rate['base']) {
                continue;
            }
            $tx->rate = $rate['rates'][mb_strtoupper($tx->currency)];
            $tx->amount = $tx->amount / $tx->rate;
        }
        return $transactions;
    }
}
