<?php

use function Livewire\Volt\{layout, state, title, mount};
use Illuminate\Http\Request;

layout('layouts.app');

title('Users');

state(['users', 'user']);

mount(function () {
    $this->users = getAllUsers();
});

function getAllUsers()
{
    try {
        $request = new Request();
        $response = app(App\Http\Controllers\UserController::class)->index($request);

        $data = $response->getData(true);
        $status = $response->getStatusCode();

        return $data;
    } catch (\Exception $e) {
        // dd($e->getMessage(), $e->getTrace()); // Inspect the error message and stack trace
        return [];
    }
}
?>

<div>
@section('content')
<div class="container">
    <h1>User List</h1>

    <table class="table table-bordered">
        <thead>
            <tr>
                <th>#</th>
                <th>Name</th>
                <th>Email</th>
                <th>Contact</th>
                <th>Action</th>
            </tr>
        </thead>
        <tbody>
            @foreach($users as $user)
            <tr>
                <td>{{ $loop->index + 1 }}</td>
                <td>{{ $user['name'] }}</td>
                <td>{{ $user['email'] }}</td>
                <td>{{ $user['contact'] }}</td>
                <td>
                  <button class="btn btn-primary">
                    <i class="fa-solid fa-pen-to-square"></i>
                  </button>

                  <button class="btn btn-danger">
                    <i class="fa-solid fa-trash"></i>
                  </button>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection
</div>
