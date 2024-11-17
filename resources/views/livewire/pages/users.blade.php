<?php

use function Livewire\Volt\{layout, state, title, mount};

use Illuminate\Support\Facades\Http;

layout('layouts.app');

title('Users');

state([
    'users' => [],
    'user' => null,
    'response' => null,
]);

$increment = fn () => $this->count++;

function __construct(){
    $this->middleware('auth');
}

mount(function () {
    $users = app(App\Http\Controllers\UserController::class)->index();

    // $response = Http::withOptions(['cookies' => true])
    //     ->get(route('users.index'));

    // if ($response->successful()) {
    //     $this->users = $response->json();
    // } else {
    //     $this->addError('api', 'Failed to fetch users.');
    // }
});
?>

<div>
    <h1>Posts</h1>
{{ $response }}
    {{-- @error('api')
        <p style="color: red;">{{ $message }}</p>
    @enderror --}}

</div>
