<?php

namespace App\Http\Controllers;

use App\Services\EmailService;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

/**
 * Class EmailController
 * @package App\Http\Controllers
 */
class EmailController extends Controller
{
    protected $service;

    /**
     * PostController constructor.
     */
    public function __construct()
    {
        // instead of instantiating it in every method, let's centralize (no DI needed here)
        $this->service = new EmailService();
    }

    /**
     * Retrieve an Email given an $email address
     * @param Request $request
     * @param string $email
     * @return JsonResponse
     * @throws \Illuminate\Validation\ValidationException
     */
    public function show(Request $request, string $email): JsonResponse
    {
        $validator = Validator::make(['email' => $email], ['email' => 'required|email']);

        if ($validator->fails()) {
            abort(422, "Invalid Email");
        }

        $email = $this->service->retrieveByEmail($email);

        if (! $email) {
            abort(404, "Email not found");
        }

        return response()->json($email->toArray(), 200);
    }

    /**
     * Save an Email to the database
     * @param Request $request
     * @throws \Illuminate\Validation\ValidationException
     * @return JsonResponse
     */
    public function store(Request $request): JsonResponse
    {
        $this->validate($request, ['email' => 'required|email']);

        $email = $this->service->retrieveByEmail($request->get('email'));

        if (is_object($email)) {
            abort(409, "Email already exists");
        }

        $post = $this->service->create($request->all());

        return response()->json($post->toArray(), 201, ['toUrl' => 'https://pro.creativemarket.com/sign-up']);
    }
}
