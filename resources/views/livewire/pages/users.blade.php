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
});
?>

<div>
    @section('content')
    <h1>Posts</h1>
        {{ $response }}
    @endsection
</div>
