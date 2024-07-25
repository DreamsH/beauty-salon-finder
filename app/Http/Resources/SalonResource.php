<?php

namespace App\Http\Resources;

use App\Models\Salon;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

/**
 * @OA\Schema(
 *  schema="SalonResource",
 * 	@OA\Property(
 *        property="id",
 *        type="int"
 *    ),
 * 	@OA\Property(
 *        property="name",
 *        type="string"
 *    ),
 * 	@OA\Property(
 *        property="city",
 *        type="string"
 *    ),
 * 	@OA\Property(
 *        property="services",
 *        nullable=true,
 *        ref="#/components/schemas/SalonServiceResource"
 *    )
 * )
 * @mixin Salon
 */
class SalonResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->external_id,
            'name' => $this->name,
            'city' => $this->city,
            'services' => SalonServiceResource::collection($this->whenLoaded('services')),
        ];
    }
}
