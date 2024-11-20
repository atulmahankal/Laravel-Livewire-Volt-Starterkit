<?php

use Illuminate\Http\Request;
use Livewire\Attributes\{Layout, Title};
use Livewire\Volt\Component;

new
#[Layout('layouts.app')]
#[Title('Users')]
class extends Component {

    #[Url]
    public ?string $search = null;
    public ?string $sort = null;
    public ?string $order='asc';
    public ?int $page=1;
    public ?int $limit=10;

    public $users = [];
    public $update = 2;

    // Declare the properties that should sync with the query string
    protected $queryString = [
        'search' => ['except' => ''], // Exclude 'search' when empty
        'sort' => ['except' => 'id'],
        'order' => ['except' => 'asc'],
        'limit' => ['except' => 0],
        'page' => ['except' => 0],
    ];

    public function mount()
    {
        $this->getAllUsers();
    }

    // General method to handle any property update
    public function updated($propertyName)
    {
        $this->update = $propertyName;
        // Check if the updated property is page or search, and call getAllUsers
        if (in_array($propertyName, ['page', 'search'])) {
            $this->getAllUsers();
        }
    }

    #[On('post-updated.{post.id}')]
    public function getAllUsers()
    {
        try {
            $request = new Request([
                'search' => $this->search ?? null,
                'sort' => $this->sort ?? null,
                'order' => $this->order ?? 'asc',
                'limit' => $this->limit ?? 10,
                'page' => $this->page ?? 1,
            ]);
            // $request->search = $this->search;
            // $request->sort = $this->sort;
            // $request->order = $this->order;
            // $request->limit = $this->limit;
            // $request->page = $this->page;

            $response = app(App\Http\Controllers\UserController::class)->index($request);

            $data = $response->getData(true);
            $status = $response->getStatusCode();

            $this->users = $data;
        } catch (\Exception $e) {
            // dd($e->getMessage(), $e->getTrace()); // Inspect the error message and stack trace
            $this->users = [];
        }
    }
};
?>

<div>
  @section('content')
  <div class="container">
    {{ $this->update }}
    <div class="">
      <h1 class="float-start">User List</h1>

      <!-- Button trigger modal -->
      <button type="button" class="btn btn-secondary float-end" data-bs-toggle="modal" data-bs-target="#exampleModal">
        <i class="fa-solid fa-plus"></i> Add
      </button>
    </div>

    <input wire:model.live.debounce.150ms='search' type="search">
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
        @foreach($users['data'] as $user)
        <tr>
          <td>{{ $loop->index + 1 }}</td>
          {{-- <td>{{ $user['id'] }}</td> --}}
          <td>{{ $user['name'] }}</td>
          <td>{{ $user['email'] }}</td>
          <td>{{ $user['contact'] }}</td>
          <td class="text-center">
            <button class="btn btn-primary" @if($user['id']==auth()->user()->id) disabled @endif>
              <i class="fa-solid fa-pen-to-square"></i>
            </button>

            <button class="btn btn-danger" @if($user['id']==auth()->user()->id) disabled @endif>
              <i class="fa-solid fa-trash"></i>
            </button>
          </td>
        </tr>
        @endforeach
      </tbody>
    </table>

    <div>
      <button class="btn btn-outline-dark">
        <i class="fa-solid fa-trash"></i>
      </button>
      <button class="btn btn-outline-dark">
        <i class="fa-solid fa-trash"></i>
      </button>
      <select class="btn btn-outline-dark" wire:model="page">
        @if(isset($users['last_page']) && $users['last_page'] > 0)
            @for ($i = 1; $i <= $users['last_page']; $i++)
                <option {{ $i == $this->page ? 'selected' : '' }}>{{ $i }}</option>
            @endfor
        @endif
      </select>
      <button class="btn btn-outline-dark">
        <i class="fa-solid fa-trash"></i>
      </button>
      <button class="btn btn-outline-dark">
        <i class="fa-solid fa-trash"></i>
      </button>
    </div>
    <!-- Pagination links -->
    {{-- <div>
      {{ $users->links() }}
    </div> --}}
  </div>
  @endsection


  @push('modal')
  <!-- Modal -->
  <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <h1 class="modal-title fs-5" id="exampleModalLabel">Modal title</h1>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
          ...
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
          <button type="button" class="btn btn-primary">Save changes</button>
        </div>
      </div>
    </div>
  </div>
  @endpush

  @push('scripts')
  <script type='module'>

  </script>
  @endpush
</div>
