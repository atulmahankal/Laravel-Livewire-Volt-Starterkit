<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        // return $this->update($request);

        $users = User::select('id','name','email','contact')->get();
        return response()->json($users);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        return $this->update($request);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        return 'show user';
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id = null)
    {
        $rule = [
            'title' => 'required|max:255',
            'body' => 'required',
        ];

        // $request->validate($rule);

        $validator = Validator::make($request->all(), $rule);

        if ($validator->fails()) {
            $this->validationError($validator->messages());
        }

        // Retrieve the validated input...
        $validatedData = $validator->validated();
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
