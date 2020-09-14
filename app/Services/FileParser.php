<?php

namespace App\Services;

use App\Contracts\CardCheckerInterface;
use App\Contracts\FileParserInterface;
use GuzzleHttp\Client;
use GuzzleHttp\Exception\GuzzleException;
use Illuminate\Support\Collection;

class FileParser implements FileParserInterface
{
    public function parse($file): Collection
    {
        $rows = [];
        if (!@file_get_contents($file)) {
            throw new \Exception('File not found');
        }
        $fileData = explode("\n", file_get_contents($file));

        foreach ($fileData as $rawRow) {
            if (empty($rawRow)) continue;
            $field = json_decode($rawRow);
            $rows [] = $field;
        }
        return Collection::make($rows);
    }
}
