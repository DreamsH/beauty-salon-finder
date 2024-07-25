<?php

namespace App\Sorts;

use App\Models\SalonService;
use Illuminate\Database\Eloquent\Builder;
use Spatie\QueryBuilder\Sorts\Sort;

class SalonServiceDisplaySort implements Sort
{
    public function __invoke(Builder $query, bool $descending, string $property)
    {
        $query->orderby(
            SalonService::select('display')->whereColumn('salons.id', 'salon_services.salon_id')->orderBy('display', $descending ? 'desc' : 'asc')->limit(1),
            $descending ?'desc':'asc'
        );
    }
}