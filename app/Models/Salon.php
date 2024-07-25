<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Query\Builder as QueryBuilder;

class Salon extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'external_id',
        'name',
        'city'
    ];

    public function services(): HasMany
    {
        return $this->hasMany(SalonService::class);
    }

    public function scopeId(Builder $query, $term): Builder
    {
        return $query->where('external_id', $term);
    }

    public function scopeName(Builder $query, $term): Builder
    {
        return $query->whereLike('name', $term.'%');
    }

    public function scopeCity(Builder $query, $term): Builder
    {
        return $query->whereLike('city', $term.'%');
    }

    public function scopeServiceId(Builder $query, string $term)
    {
        $query->where(function (Builder $query) use ($term) {
            $query->whereExists(function (QueryBuilder $query) use ($term) {
                $query->select(DB::raw(1))
                    ->from('salon_services')
                    ->where(function (QueryBuilder $query) use ($term) {
                        $query->where('salon_services.external_id', $term);
                    })
                    ->whereColumn('salon_services.salon_id', '=', 'salons.id');
            });
        });
    }

    public function scopeServiceName(Builder $query, string $term)
    {
        $query->where(function (Builder $query) use ($term) {
            $query->whereExists(function (QueryBuilder $query) use ($term) {
                $query->select(DB::raw(1))
                    ->from('salon_services')
                    ->where(function (QueryBuilder $query) use ($term) {
                        $query->whereLike('salon_services.name', $term.'%');
                    })
                    ->whereColumn('salon_services.salon_id', '=', 'salons.id');
            });
        });
    }

    public function scopeServiceDisplay(Builder $query, string $term)
    {
        $query->where(function (Builder $query) use ($term) {
            $query->whereExists(function (QueryBuilder $query) use ($term) {
                $query->select(DB::raw(1))
                    ->from('salon_services')
                    ->where(function (QueryBuilder $query) use ($term) {
                        $query->whereLike('salon_services.display', '%'.$term.'%');
                    })
                    ->whereColumn('salon_services.salon_id', '=', 'salons.id');
            });
        });
    }
}
