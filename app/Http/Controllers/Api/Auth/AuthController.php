<?php

namespace App\Http\Controllers\Api\Auth;

use App\Http\Controllers\Controller;
use App\Services\Auth\AuthService;
use Illuminate\Http\Request;

class AuthController extends Controller
{
    protected $authService;
    public function __construct(AuthService $authService)
    {
        $this->authService = $authService;
    }

        // Registers Users
        public function createUser(Request $request)
        {
            return $this->authService->register($request);
        }

        // Login Users
        public function loginUser(Request $request)
        {
            return $this->authService->login($request);
        }

        // Logout Users
        public function logout(Request $request)
        {
            return $this->authService->logout($request);
        }
        public function update(Request $request ,$id)
        {
            return $this->authService->update($request,$id);
        }
        public function allUsers()
        {
            return $this->authService->allUsers();
        }
        public function delete($id)
        {
            return $this->authService->delete($id);
        }
        public function show($id)
        {
            return $this->authService->show($id);
        }
}
