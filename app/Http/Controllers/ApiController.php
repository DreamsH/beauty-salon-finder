<?php

namespace App\Http\Controllers;

class ApiController extends Controller
{

    /**
     * Api
     * @OA\Get (
     *     path="/api/health",
     *     tags={"API"},
     *     summary="Check health",
     *       security={
     *           {"API key": {}},
     *     },
     *     @OA\Response(
     *         response=200,
     *         description="Health message",
     *         @OA\JsonContent(
     *             @OA\Property(
     *                 property="message",
     *                 type="string"
     *             )
     *         )
     *     )
     * )
     */
    public function index()
    {
        return response()->json(['message' => 'OK'], 200);
    }
}
