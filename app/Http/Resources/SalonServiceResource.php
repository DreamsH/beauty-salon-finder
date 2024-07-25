<?php

namespace App\Http\Resources;

use App\Models\SalonService;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

/**
 * @OA\Schema(
 *  schema="SalonServiceResource",
 * 	@OA\Property(
 *        property="id",
 *        type="int"
 *    ),
 *  @OA\Property(
 *        property="salon_id",
 *        type="int"
 *    ),
 * 	@OA\Property(
 *        property="name",
 *        type="string"
 *    ),
 *  @OA\Property(
 *        property="price",
 *        type="object",
 *        @OA\Property(
 *           property="currency",
 *           type="string"
 *        ),
 *        @OA\Property(
 *           property="display",
 *           type="string"
 *        )
 *  )
 * )
 * @mixin SalonService
 */
class SalonServiceResource extends JsonResource
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
            'salon_id' => $this->salon_id,
            'name' => $this->name,
            'price' => [
                'currency' => $this->currency,
                'display' => $this->display,
            ],
        ];
    }
}
