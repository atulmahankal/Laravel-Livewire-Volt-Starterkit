<?php

use function Livewire\Volt\{layout, state, title, mount, computed};
use Illuminate\Http\Request;

layout('layouts.app');

title('Users');

state(['users', 'user']);
state([
  'search' => '',
  'sort' => '',
  'order' => 'asc',
  'limit' => '10',
  'page' => '1',
])->url(history: true, keep: true);

mount(function () {
  $this->users = getAllUsers(
    $this->search,
    $this->sort,
    $this->order,
    $this->limit,
    $this->page
  );
});

function getAllUsers(
  $search = '',
  $sort = '',
  $order = 'asc',
  $limit = '10',
  $page = '1'
)
{
    try {
        $request = new Request([
            'search' => $search,
            'sort' => $sort,
            'order' => $order,
            'limit' => $limit,
            'page' => $page,
        ]);

        $response = app(App\Http\Controllers\UserController::class)->index($request);

        $data = $response->getData(true);
        $status = $response->getStatusCode();

        return $data;
    } catch (\Exception $e) {
        // dd($e->getMessage(), $e->getTrace()); // Inspect the error message and stack trace
        return [];
    }
};

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
                <td class="text-center">
                  <button class="btn btn-primary" @if($user['id'] == auth()->user()->id) disabled @endif>
                    <i class="fa-solid fa-pen-to-square"></i>
                  </button>

                  <button class="btn btn-danger" @if($user['id'] == auth()->user()->id) disabled @endif>
                    <i class="fa-solid fa-trash"></i>
                  </button>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection

@push('scripts')
<script type='module'>

</script>
@endpush
</div>
