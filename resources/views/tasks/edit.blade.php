@extends('layouts.app')

@section('title', 'Edit Task')

@section('content')

<div class="modal fade" id="editTaskModal" tabindex="-1" data-bs-backdrop="static">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content border-0 shadow">

            {{-- Header --}}
            <div class="modal-header border-0 pb-0">
                <h5 class="modal-title fw-bold">Edit Task</h5>
                <a href="{{ route('tasks.index') }}" class="btn-close"></a>
            </div>

            {{-- Body --}}
            <div class="modal-body px-4 py-3">
                <form action="{{ route('tasks.update', $task->id) }}" method="POST">
                    @csrf
                    @method('PUT')

                    {{-- Title --}}
                    <div class="mb-3">
                        <label class="form-label fw-semibold">
                            Task Title <span class="text-danger">*</span>
                        </label>
                        <input type="text"
                               name="title"
                               class="form-control @error('title') is-invalid @enderror"
                               placeholder="Enter task title..."
                               value="{{ old('title', $task->title) }}"
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
                                  placeholder="Add details about this task...">{{ old('description', $task->description) }}</textarea>
                    </div>

                    {{-- Due Date + Priority --}}
                    <div class="row g-3 mb-3">
                        <div class="col-6">
                            <label class="form-label fw-semibold">Due Date</label>
                            <input type="date"
                                   name="due_date"
                                   class="form-control"
                                   value="{{ old('due_date', $task->due_date?->format('Y-m-d')) }}">
                        </div>
                        <div class="col-6">
                            <label class="form-label fw-semibold">
                                Priority <span class="text-danger">*</span>
                            </label>
                            <select name="priority_id"
                                    class="form-select @error('priority_id') is-invalid @enderror">
                                <option value="1" {{ old('priority_id', $task->priority_id) == 1 ? 'selected' : '' }}>Low</option>
                                <option value="2" {{ old('priority_id', $task->priority_id) == 2 ? 'selected' : '' }}>Medium</option>
                                <option value="3" {{ old('priority_id', $task->priority_id) == 3 ? 'selected' : '' }}>High</option>
                            </select>
                            @error('priority_id')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>


                    {{-- Buttons --}}
                    <div class="d-flex gap-2 mt-4">
                        <a href="{{ route('tasks.index') }}"
                           class="btn btn-outline-secondary flex-fill">
                            Cancel
                        </a>
                        <button type="submit" class="btn btn-primary flex-fill fw-semibold">
                            <i class="bi bi-check-lg me-1"></i> Update Task
                        </button>
                    </div>

                </form>
            </div>

        </div>
    </div>
</div>

<script>
    document.addEventListener('DOMContentLoaded', function () {
        new bootstrap.Modal(document.getElementById('editTaskModal')).show();
    });
</script>

@endsection