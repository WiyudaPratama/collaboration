<?php

namespace App\Http\Controllers\Api\Admin;

use App\Models\User;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class DashboardController extends Controller
{
    public function index()
    {
        $users = User::role('user')->get();
        return response()->json([
            'success' => true,
            'user' => $users,
        ], 200);
    }


}
