<?php

namespace App\Contracts;

use Illuminate\Support\Collection;

interface FileParserInterface {
    public function parse($file): Collection;
}
