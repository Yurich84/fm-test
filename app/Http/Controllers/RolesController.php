<?php

namespace App\Http\Controllers;

use App\Enums\Role;
use Illuminate\Http\JsonResponse;

class RolesController extends Controller
{
    /**
     * Get Roles
     */
    public function __invoke(): JsonResponse
    {
        return response()->json(Role::list());
    }
}
