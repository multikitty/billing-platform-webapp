<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Response;

class ApiResponseCapsulator
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle(Request $request, Closure $next)
    {
        $response = $next($request);

        try{
            $data = $response->getData();
        } catch(\Exception $e) {
            $data = [];
        }

        $customResponse = new JsonResponse([
            'data' => $data,
            'code' => $response->getStatusCode(),
        ], JsonResponse::HTTP_OK,);

        return $customResponse;
    }
}
