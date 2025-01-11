<?php

namespace App\Http\Controllers;

use App\Http\Requests\AdminRegisterRequest;
use App\Http\Resources\AdminResource;
use App\Models\Admin;
use Illuminate\Http\Request;
use App\Helpers\ResponseHelper;
use App\Http\Requests\AdminLoginRequest;
use App\Http\Requests\AdminUpdateRequest;
use App\Http\Resources\ResponseHelper as ResponseHelperType;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Js;

class AdminController extends Controller
{
    public function register(AdminRegisterRequest $request)
    {
        $data = $request->validated();

        // advanced validation here, example check if email already exists
        // if(Admin::where('email', $data['email'])->exists()) {
        //     return ResponseHelper::buildResponse('error', 'error');
        // }
        
        $admin = new Admin($data);
        $admin->password = Hash::make($data['password']);

        $admin->save();

        return ResponseHelper::buildResponse(201, "success", 'register success', new AdminResource($admin));
    }

    public function login(AdminLoginRequest $request)
    {
        $data = $request->validated();

        $admin = Admin::where('email', $data['email'])->first();

        if (!$admin || !Hash::check($data['password'], $admin->password)) {
            return ResponseHelper::buildResponse(401, 'error', 'login failed');
        }

        // dummy token with uuid
        $admin->token = Str::uuid()->toString();
        $admin->save();

        return ResponseHelper::buildResponse(200, 'success', 'login success', new AdminResource($admin));
    }

    public function get()
    {
        $admin = Auth::user();

        return ResponseHelper::buildResponse(200, 'success', 'get data success', new AdminResource($admin));
    }

    public function logout()
    {
        /** @var \App\Models\Admin $admin **/
        $admin = Auth::guard('admin')->user();
        $admin->token = null;
        $admin->save();

        return ResponseHelper::buildResponse(200, 'success', 'logout success');
    }
    
}
