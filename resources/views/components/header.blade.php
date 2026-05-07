@props(['title' => 'Tasks'])

<nav class="navbar bg-white border-bottom px-4 py-2 d-flex align-items-center justify-content-between">
    <div>
        <h5 class="fw-bold mb-0">{{ $title }}</h5>
        <small class="text-muted">{{ now()->format('l, F j, Y') }}</small>
    </div>
    {{-- Left: Page Title --}}

    {{-- Right: Search + New Task + Avatar --}}
    <div class="d-flex align-items-center gap-3">

        {{-- Search --}}
        <form action="{{ route('tasks.index') }}" method="GET" class="d-flex">
            <div class="input-group">
                <span class="input-group-text bg-light border-end-0">
                    <i class="bi bi-search text-muted"></i>
                </span>
                <input type="text"
                       name="search"
                       value="{{ request('search') }}"
                       class="form-control bg-light border-start-0"
                       placeholder="Search tasks..."
                       style="width: 220px;">
            </div>
        </form>

        {{-- New Task Button --}}
        <button type="button" class="btn btn-primary d-flex align-items-center gap-2"
            data-bs-toggle="modal" data-bs-target="#createTaskModal">
            <i class="bi bi-plus-lg"></i> New Task
        </button>

        {{-- Avatar Dropdown --}}
        <div class="dropdown">
            <button class="btn btn-primary rounded-circle fw-bold d-flex align-items-center justify-content-center p-0"
                    style="width: 38px; height: 38px;"
                    data-bs-toggle="dropdown">
                CR
            </button>
            <ul class="dropdown-menu dropdown-menu-end shadow border-0 mt-2">
                <li>
                    <a class="dropdown-item d-flex align-items-center gap-2" href="#">
                        <i class="bi bi-person"></i> Profile
                    </a>
                </li>
                <li>
                    <a class="dropdown-item d-flex align-items-center gap-2" href="#">
                        <i class="bi bi-gear"></i> Settings
                    </a>
                </li>
                <li><hr class="dropdown-divider"></li>
                <form method="POST" action="{{ route('logout') }}">
                    @csrf

                <button type="submit"
                    class="dropdown-item d-flex align-items-center gap-2 text-danger">
                    <i class="bi bi-box-arrow-right"></i>Logout
                </button>
                </form>
                <!-- <li>
                    <a class="" href="#">
                         Logout
                    </a>
                </li> -->
            </ul>
        </div>

    </div>
</nav>

