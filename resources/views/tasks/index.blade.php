@extends('layouts.app')

@section('title', 'All Tasks')

@section('content')


{{-- Stats --}}
<x-task-stats :tasks="$tasks" />

{{-- Task List --}}
<div class="card border-0 shadow-sm">
    <div class="card-body p-0">
        @forelse($tasks as $task)
            <x-task-item :task="$task" />
        @empty
            <div class="text-center py-5 text-muted">
                <i class="bi bi-inbox fs-1 d-block mb-2"></i>
                No tasks yet.
                <a href="#" data-bs-toggle="modal" data-bs-target="#createTaskModal">Create your first task</a>
            </div>
        @endforelse
    </div>
</div>

{{-- Create Task Modal --}}
<div class="modal fade" id="createTaskModal" tabindex="-1" data-bs-backdrop="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content border-0 shadow">

            <div class="modal-header border-0 pb-0">
                <h5 class="modal-title fw-bold">New Task</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>

            <div class="modal-body px-4 py-3">
                <form action="{{ route('tasks.store') }}" method="POST">
                    @csrf

                    {{-- Title --}}
                    <div class="mb-3">
                        <label class="form-label fw-semibold">
                            Task Title <span class="text-danger">*</span>
                        </label>
                        <input type="text"
                               name="title"
                               class="form-control @error('title') is-invalid @enderror"
                               placeholder="Enter task title..."
                               value="{{ old('title') }}"
                               required>
                        @error('title')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    {{-- Description --}}
                    <div class="mb-3">
                        <label class="form-label fw-semibold">Description</label>
                        <textarea name="description"
                                  class="form-control"
                                  rows="4"
                                  placeholder="Add details about this task...">{{ old('description') }}</textarea>
                    </div>

                    {{-- Due Date + Priority --}}
                    <div class="row g-3 mb-3">
                        <div class="col-6">
                            <label class="form-label fw-semibold">Due Date</label>
                            <input type="date"
                                   name="due_date"
                                   class="form-control"
                                   value="{{ old('due_date', now()->format('Y-m-d')) }}">
                        </div>
                        <div class="col-6">
                            <label class="form-label fw-semibold">
                                Priority <span class="text-danger">*</span>
                            </label>
                            <select name="priority_id" class="form-select @error('priority_id') is-invalid @enderror">
                                <optionnull value="1" {{ old('priority_id') == 1 ? 'selected' : '' }}>Low</optionnull>
                                <option value="2" {{ old('priority_id', 2) == 2 ? 'selected' : '' }}>Medium</option>
                                <option value="3" {{ old('priority_id') == 3 ? 'selected' : '' }}>High</option>
                            </select>
                            @error('priority_id')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>

                    {{-- Buttons --}}
                    <div class="d-flex gap-2 mt-4">
                        <button type="button"
                                class="btn btn-outline-secondary flex-fill"
                                data-bs-dismiss="modal">
                            Cancel
                        </button>
                        <button type="submit" class="btn btn-primary flex-fill fw-semibold">
                            <i class="bi bi-check-lg me-1"></i> Save Task
                        </button>
                    </div>

                </form>
            </div>

        </div>
    </div>
</div>

{{-- Auto reopen modal if validation fails --}}
@if($errors->any())
<script>
    document.addEventListener('DOMContentLoaded', function () {
        new bootstrap.Modal(document.getElementById('createTaskModal')).show();
    });
</script>
@endif

@endsection