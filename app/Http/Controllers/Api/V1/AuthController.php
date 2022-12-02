<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Controller;
use App\Http\Requests\LoginRequest;
use App\Http\Requests\RegisterRequest;
use App\Http\Resources\AccessTokenResource;
use App\Http\Resources\UserResource;
use App\Services\AuthService;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class AuthController extends Controller
{
    public function __construct(private AuthService $authService)
    {
    }

    /**
     * @route /api/v1/register
     * @param RegisterRequest $request
     * @return JsonResponse
     * @throws \Exception
     */
    public function register(RegisterRequest $request): JsonResponse
    {
        $response = $this->authService->register($request->validated());

        return response()->success(
            'User registered successfully.',
            new AccessTokenResource($response),
            Response::HTTP_CREATED
        );
    }

    /**
     * @route /api/v1/login
     * @param LoginRequest $request
     * @return mixed
     * @throws \Illuminate\Auth\AuthenticationException
     */
    public function login(LoginRequest $request): JsonResponse
    {
        $response = $this->authService->login($request->validated());

        return response()->success(
            'Login successful.',
            new AccessTokenResource($response)
        );
    }

    /**
     * @route /api/v1/auth-user
     * @return JsonResponse
     * @desc Authenticated user
     */
    public function authUser(): JsonResponse
    {
        return response()->success(
            'Logged in user.',
            new UserResource(auth()->user())
        );
    }
}
