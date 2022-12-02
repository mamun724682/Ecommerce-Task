<?php

namespace App\Services;

use App\Models\User;
use Illuminate\Support\Facades\DB;

class AuthService extends BaseService
{
    public function __construct(User $model)
    {
        parent::__construct($model);
    }

    /**
     * @param $data
     * @return array
     * @throws \Exception
     */
    public function register(array $data): array
    {
        try {
            DB::beginTransaction();
            $user = parent::storeOrUpdate($data);

            // Login to get access token
            auth()->login($user);
            $response = $this->createToken(auth()->user());

            DB::commit();
            return $response;
        } catch (\Exception $e) {
            DB::rollBack();
            throw $e;
        }
    }

    /**
     * @param $user
     * @param $remember_me
     * @return array
     * @desc Create a new personal access token for the user
     */
    private function createToken(User $user): array
    {
        // Create token
        $tokenData = $user->createToken('Personal Access Token');
        $accessToken = $tokenData->accessToken;

        $expiration = $tokenData->token->expires_at->diffInSeconds(now());

        return [
            'access_token' => $accessToken,
            'token_type'   => 'Bearer',
            'expires_in'   => $expiration
        ];
    }
}
