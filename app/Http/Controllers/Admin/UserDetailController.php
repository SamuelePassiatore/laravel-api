<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Models\UserDetail;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class UserDetailController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $query = UserDetail::orderBy('updated_at', 'DESC');
        $user_details = $query->paginate(10);
        return view('admin.user_details.index', compact('user_details'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.user_details.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'first_name' => 'nullable|string',
            'last_name' => 'nullable|string',
            'address' => 'nullable|string',
            'phone' => 'nullable|string',
            'date_of_birth' => 'nullable|date',
            'user_id' => 'exists:users,id'
        ]);

        $data = $request->all();

        $user_details = new UserDetail();
        $user_details->fill($data);
        $user_details->save();

        return to_route('admin.user_details.index')
            ->with('message', "Details of user '$user_details->first_name $user_details->last_name' has been successfully created")
            ->with('type', 'success');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        return to_route('admin.user_details.index');
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(UserDetail $user_detail)
    {
        if ($user_detail->user_id !== Auth::id()) {
            return to_route('admin.user_details.index', $user_detail->id)
                ->with('type', 'danger')
                ->with('message', "You are not authorized to edit this user");
        }
        return view('admin.user_details.edit', compact('user_detail'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, UserDetail $user_detail)
    {
        $request->validate([
            'first_name' => 'nullable|string',
            'last_name' => 'nullable|string',
            'address' => 'nullable|string',
            'phone' => 'nullable|string',
            'date_of_birth' => 'nullable|date',
            'user_id' => 'exists:users,id'
        ]);

        $data = $request->all();

        $user_detail->fill($data);
        $user_detail->save();

        return to_route('admin.user_details.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
