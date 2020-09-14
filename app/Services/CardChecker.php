<?php

namespace App\Services;

use App\Contracts\CardCheckerInterface;
use GuzzleHttp\Client;
use GuzzleHttp\Exception\GuzzleException;
use Illuminate\Support\Collection;


class CardChecker implements CardCheckerInterface
{
    public function getCountryByBin(Collection $transactions): Collection
    {
        foreach ($transactions as $tx) {
            $url = "https://lookup.binlist.net/" . $tx->bin;
            $client = new Client();

            try {
                $response = $client->get($url);
            } catch (GuzzleException $e) {
                throw new \Exception("Bin problems" . ' ' . $e->getMessage());
            }
            $binResults = $response->getBody();
            $tx->country = (json_decode($binResults))->country->alpha2;
        }
        return $transactions;
    }
}
