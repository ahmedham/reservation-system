<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use GuzzleHttp\Psr7\Response;
use App\Services\UsersService;
use App\Http\Controllers\Controller;
use App\Http\Requests\Api\LoginUserRequest;
use App\Http\Requests\Api\CreateUserRequest;
use Illuminate\Http\Response as HttpResponse;
use App\Http\Requests\Api\RegisterUserRequest;
use App\Exceptions\InvalidCredentialsException;

/**
 * @OA\Info(
 *     title="Reservation System",
 *     version="1.0.0",
 *     description="API documentation for reservation System"
 * )
 *
 * @OA\SecurityScheme(
 *     securityScheme="bearerAuth",
 *     type="http",
 *     scheme="bearer",
 *     bearerFormat="JWT"
 * )
 *
 */

class AuthController extends Controller
{

    public function __construct(
        private UsersService $usersService
    ) {

    }

    /**
     * @OA\Post(
     *     path="/api/register",
     *     summary="Register new users",
     *     tags={"Auth"},
     *     @OA\RequestBody(
     *         required=true,
     *         content={
     *             @OA\MediaType(
     *                 mediaType="application/json",
     *                 @OA\Schema(
     *                     type="object",
     *                     required={"name", "email", "password"},
     *                     @OA\Property(
     *                         property="name",
     *                         type="string",
     *                         example="John Doe"
     *                     ),
     *                     @OA\Property(
     *                         property="email",
     *                         type="string",
     *                         format="email",
     *                         example="johndoe@example.com"
     *                     ),
     *                     @OA\Property(
     *                         property="password",
     *                         type="string",
     *                         example="password123"
     *                     )
     *                 )
     *             )
     *         }
     *     ),
     *     @OA\Response(
     *         response=201,
     *         description="User created successfully",
     *         @OA\JsonContent(
     *             @OA\Property(
     *                 property="message",
     *                 type="string",
     *                 example="User Created"
     *             )
     *         )
     *     ),
     *     @OA\Response(
     *         response=400,
     *         description="Invalid request"
     *     )
     * )
     */


    public function register(RegisterUserRequest $request)
    {
        $user = $this->usersService->registerUser($request->validated());

        return response()->json([
            'message' => 'User Created'
        ], HttpResponse::HTTP_CREATED);
    }


    /**
 * @OA\Post(
 *     path="/api/login",
 *     summary="Login users",
 *     tags={"Auth"},
 *     @OA\RequestBody(
 *         required=true,
 *         content={
 *             @OA\MediaType(
 *                 mediaType="application/json",
 *                 @OA\Schema(
 *                     type="object",
 *                     required={"email", "password"},
 *                     @OA\Property(
 *                         property="email",
 *                         type="string",
 *                         format="email",
 *                         example="johndoe@example.com"
 *                     ),
 *                     @OA\Property(
 *                         property="password",
 *                         type="string",
 *                         example="password123"
 *                     )
 *                 )
 *             )
 *         }
 *     ),
 *     @OA\Response(
 *         response=200,
 *         description="User successfully logged in and token generated",
 *         @OA\JsonContent(
 *             @OA\Property(
 *                 property="token",
 *                 type="string",
 *                 example="your-jwt-token-here"
 *             )
 *         )
 *     ),
 *     @OA\Response(
 *         response=400,
 *         description="Invalid credentials",
 *         @OA\JsonContent(
 *             @OA\Property(
 *                 property="message",
 *                 type="string",
 *                 example="Invalid credentials"
 *             )
 *         )
 *     )
 * )
 */

    public function login(LoginUserRequest $request)
    {

        try{
            $token = $this->usersService->loginUser($request->validated());
            return response()->json($token);

        }catch(InvalidCredentialsException $e){
            return response()->json([
                'message' => $e->getMessage()
            ], HttpResponse::HTTP_BAD_REQUEST);
        }

    }

}
