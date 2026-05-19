@extends('layouts.app')

@section('title', 'Profile')

@section('content')

{{-- Flash messages --}}
@if(session('success'))
    <div class="alert alert-success alert-dismissible fade show" role="alert">
        {{ session('success') }}
        <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
    </div>
@endif
@if($errors->any())
    <div class="alert alert-danger alert-dismissible fade show" role="alert">
        @foreach($errors->all() as $error)
            <div>{{ $error }}</div>
        @endforeach
        <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
    </div>
@endif

<p class="text-muted small mb-2">profile user</p>

<div class="card shadow-sm mx-auto" style="max-width: 560px; border-radius: 12px; overflow: hidden;">

    {{-- Avatar + About --}}
    <div class="card-body d-flex gap-3 pb-2">

        <div class="position-relative flex-shrink-0">
            @if($user->avatar)
                <img src="{{ Storage::url($user->avatar) }}"
                     alt="Avatar"
                     class="rounded"
                     style="width:120px; height:120px; object-fit:cover;">
            @else
                <div class="rounded d-flex align-items-center justify-content-center fw-bold fs-2 text-primary bg-primary bg-opacity-10"
                     style="width:120px; height:120px;">
                    {{ strtoupper(substr($user->name, 0, 2)) }}
                </div>
            @endif
            <div class="position-absolute bottom-0 start-0 end-0 text-center text-white py-1 small"
                 style="background:rgba(0,0,0,0.5); border-radius:0 0 6px 6px; cursor:pointer;"
                 data-bs-toggle="modal" data-bs-target="#editModal">
                Edit
            </div>
        </div>

        <div>
            <p class="fw-semibold mb-1">About Me</p>
            <p class="text-muted small mb-0">
                {{ $user->about ?? 'No bio yet. Click Edit to add one.' }}
            </p>
        </div>
    </div>

    {{-- Name + Role --}}
    <div class="px-3 pb-2">
        <p class="fw-semibold fs-5 mb-0">{{ $user->name }}</p>
        <p class="text-muted small mb-0">{{ $user->role }}</p>
    </div>

    {{-- Stats --}}
    <div class="px-3 pb-3">
        <div class="row g-2 text-center">
            <div class="col-4">
                <div class="bg-light rounded p-2">
                    <div class="fw-bold fs-5">{{ $completedCount }}</div>
                    <div class="text-muted" style="font-size:11px;">Completed</div>
                </div>
            </div>
            <div class="col-4">
                <div class="bg-light rounded p-2">
                    <div class="fw-bold fs-5">{{ $pendingCount }}</div>
                    <div class="text-muted" style="font-size:11px;">Pending</div>
                </div>
            </div>
            <div class="col-4">
                <div class="bg-light rounded p-2">
                    <div class="fw-bold fs-5">{{ $rate }}%</div>
                    <div class="text-muted" style="font-size:11px;">Rate</div>
                </div>
            </div>
        </div>
    </div>

    {{-- Tabs --}}
    <ul class="nav nav-tabs px-3" id="profileTabs">
        <li class="nav-item">
            <button class="nav-link active" data-bs-toggle="tab" data-bs-target="#tab-contact">
                Contact info
            </button>
        </li>
        <li class="nav-item">
            <button class="nav-link" data-bs-toggle="tab" data-bs-target="#tab-additional">
                Additional info
            </button>
        </li>
    </ul>

    <div class="tab-content px-3 py-3">

        <div class="tab-pane fade show active" id="tab-contact">
            <div class="row g-2 small">
                <div class="col-5 fw-semibold">Employee ID :</div>
                <div class="col-7 text-muted">{{ $user->employee_id ?? '—' }}</div>

                <div class="col-5 fw-semibold">Department :</div>
                <div class="col-7 text-muted">{{ $user->department ?? '—' }}</div>
            </div>
        </div>

        <div class="tab-pane fade" id="tab-additional">
            <div class="row g-2 small">
                <div class="col-5 fw-semibold">Email :</div>
                <div class="col-7 text-muted">{{ $user->email }}</div>
            </div>
        </div>

    </div>

    {{-- Footer buttons --}}
    <div class="card-footer bg-white d-flex gap-2">
        <button class="btn btn-outline-secondary flex-fill"
                data-bs-toggle="modal" data-bs-target="#editModal">
            Edit profile
        </button>
        <a href="{{ route('tasks.index') }}" class="btn btn-dark flex-fill">
            All tasks
        </a>
    </div>

</div>


{{-- Edit Modal --}}
<div class="modal fade" id="editModal" tabindex="-1" aria-labelledby="editModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable">
        <div class="modal-content rounded-3">

            <div class="modal-header">
                <h5 class="modal-title" id="editModalLabel">Edit Profile</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>

            <form method="POST" action="{{ route('profile.update') }}" enctype="multipart/form-data">
                @csrf
                @method('PUT')

                <div class="modal-body">

                    <div class="mb-3">
                        <label class="form-label fw-semibold">Profile photo</label>
                        <input type="file" name="avatar" class="form-control" accept="image/*">
                    </div>

                    <div class="row g-2 mb-3">
                        <div class="col">
                            <label class="form-label fw-semibold">Name</label>
                            <input type="text" name="name" class="form-control"
                                   value="{{ old('name', $user->name) }}" required>
                        </div>
                        <div class="col">
                            <label class="form-label fw-semibold">Role</label>
                            <input type="text" name="role" class="form-control"
                                   value="{{ old('role', $user->role) }}">
                        </div>
                    </div>

                    <div class="mb-3">
                        <label class="form-label fw-semibold">About me</label>
                        <textarea name="about" class="form-control" rows="3">{{ old('about', $user->about) }}</textarea>
                    </div>

                    <div class="row g-2 mb-3">
                        <div class="col">
                            <label class="form-label fw-semibold">Employee ID</label>
                            <input type="text" name="employee_id" class="form-control"
                                   value="{{ old('employee_id', $user->employee_id) }}">
                        </div>
                        <div class="col">
                            <label class="form-label fw-semibold">Department</label>
                            <input type="text" name="department" class="form-control"
                                   value="{{ old('department', $user->department) }}">
                        </div>
                    </div>

                    {{-- Buttons inside body so always visible --}}
                    <div class="d-flex gap-2">
                        <button type="button" class="btn btn-outline-secondary flex-fill"
                                data-bs-dismiss="modal">Cancel</button>
                        <button type="submit" class="btn btn-dark flex-fill">Save</button>
                    </div>

                </div>

            </form>
        </div>
    </div>
</div>

@endsection