<?php

namespace App\Articles;

use Illuminate\Database\Eloquent\Collection;

interface ArticleRepository
{
    public function search(string $query): Collection;
}
