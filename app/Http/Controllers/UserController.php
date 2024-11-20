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
      //?search=3210&sort=name&order=desc&perPage=5&page=3

        // Filter query
        $filteredQuery = User::query()
            ->when($request->has('search'), function ($query) use ($request) {
                $query->where('name', 'like', "%{$request->search}%")
                  ->orWhere('email', 'LIKE', "%{$request->search}%")
                  ->orWhere('contact', 'LIKE', "%{$request->search}%");
            })
            ->when($request->has('name'), function ($query) use ($request) {
                $query->where('name', 'like', "%{$request->name}%");
            })
            ->when($request->has('email'), function ($query) use ($request) {
                $query->where('email', 'LIKE', "%{$request->email}%");
            })
            ->when($request->has('contact'), function ($query) use ($request) {
                $query->where('contact', 'LIKE', "%{$request->contact}%");
            })
            ->when($request->has('sort') && $request->has('order'), function ($query) use ($request) {
                $sortColumn = $request->sort;
                $sortOrder = $request->order;

                // Validate the 'order' value to ensure it's either 'asc' or 'desc'
                if (!in_array(strtolower($sortOrder), ['asc', 'desc'])) {
                  $sortOrder = 'asc';
                }
                $query->orderBy($sortColumn, $sortOrder);
            })
            ->select('id','name','email','contact');

        return $this->customePagination(
            User::count(),
            $filteredQuery
        );
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
