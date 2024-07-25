<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

/**
 * @OA\Schema(
 *      schema="PaginationLinkResponse",
 *      @OA\Property(
 *            property="url",
 *            type="string",
 *            nullable=true
 *       ),
 *       @OA\Property(
 *            property="label",
 *            type="string"
 *       ),
 *       @OA\Property(
 *            property="active",
 *            type="boolean",
 *       )
 * )
 * 
 * @OA\Schema(
 *      schema="PaginationLinksResponse",
 *      @OA\Property(
 *            property="first",
 *            type="string"
 *       ),
 *       @OA\Property(
 *            property="last",
 *            type="string"
 *       ),
 *       @OA\Property(
 *            property="prev",
 *            type="string",
 *            nullable=true
 *       ),
 *      @OA\Property(
 *            property="next",
 *            type="string",
 *            nullable=true
 *       ),
 * )
 * 
 * @OA\Schema(
 *      schema="PaginationMetaResponse",
 *      @OA\Property(
 *            property="current_page",
 *            type="int"
 *       ),
 *       @OA\Property(
 *            property="from",
 *            type="int"
 *       ),
 *       @OA\Property(
 *            property="last_page",
 *            type="int"
 *       ),
 *       @OA\Property(
 *            property="path",
 *            type="int"
 *       ),
 *       @OA\Property(
 *            property="per_page",
 *            type="int"
 *       ),
 *       @OA\Property(
 *            property="to",
 *            type="int"
 *       ),
 *       @OA\Property(
 *            property="total",
 *            type="int"
 *       ),
 *      @OA\Property(
 *            property="links",
 *            type="array",
 *            @OA\Items(ref="#/components/schemas/PaginationLinkResponse")
 *       ),
 * )
 * 
 * @OA\Schema(
 *      schema="PaginationResponse",
 *      @OA\Property(
 *            property="links",
 *            ref="#/components/schemas/PaginationLinksResponse"
 *       ),
 *      @OA\Property(
 *            property="meta",
 *            ref="#/components/schemas/PaginationMetaResponse"
 *       )
 * )
 * 
 * @OA\Parameter(
 *      parameter="pagination-page",
 *      in="query",
 *      name="page",
 *      description="The current page for the result set, defaults to *1*",
 *      @OA\Schema(
 *          type="integer",
 *          default=1,
 *      )
 * )
 * @OA\Parameter(
 *      parameter="pagination-perPage",
 *      in="query",
 *      name="perPage",
 *      description="Limit of results returned by endpoint. If set 0 then endpoint will return all entries.",
 *      @OA\Schema(
 *          type="integer",
 *          default=50,
 *      )
 * )
 * 
 * @property int $page
 * @property int $perPage
 */
class PaginationRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            //
        ];
    }
}
