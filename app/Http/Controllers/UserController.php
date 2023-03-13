<?php

namespace App\Http\Controllers;

use App\Enums\UserStatus;
use App\Http\Controllers\Traits\GetUserFormRequest;
use App\Http\Requests\User\UserRegister;
use App\Http\Requests\User\UserSetStatus;
use App\Http\Resources\UserResource;
use App\Models\User;
use App\Services\UserService;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class UserController extends Controller
{

    use GetUserFormRequest;

    public function index(): JsonResource
    {
        return UserResource::collection(User::with('balance')->paginate(10));
    }

    public function register(UserRegister $request): void
    {
        app(UserService::class)->register($request->toDTO());
    }

    public function setStatus(UserSetStatus $request): void
    {
        $user = $this->getUser($request);
        $status = UserStatus::tryFrom($request->validated('status'));

        app(UserService::class)->setStatus($user, $status);
    }
}
