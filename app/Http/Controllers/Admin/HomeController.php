<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Project;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class HomeController extends Controller
{
    public function index()
    {
        $projects = Project::where('user_id', Auth::id())->orderBy('updated_at', 'DESC')->paginate(10);
        return view('admin.home', compact('projects'));
    }
}
