@props(['task'])

<div class="d-flex align-items-center justify-content-between px-4 py-3 border-bottom">

    {{-- Left: Checkbox + Title --}}
    <div class="d-flex align-items-center gap-3">

        {{-- Checkbox --}}
        <form action="{{ route('tasks.toggle', $task) }}" method="POST">
            @csrf
            @method('PATCH')
            <button type="submit" class="btn p-0 border-0 bg-transparent">
                @if($task->status === 'completed')
                    <i class="bi bi-check-circle-fill text-success fs-5"></i>
                @elseif($task->status === 'pending' && $task->due_date && $task->due_date->lt(now()->startOfDay()))
                    <i class="bi bi-exclamation-circle-fill text-danger fs-5"></i>
                @else
                    <i class="bi bi-circle text-secondary fs-5"></i>  {{-- ← normal circle --}}
                @endif
            </button>
        </form>

        <div>
            <div class="fw-semibold {{ $task->status === 'completed' ? 'text-decoration-line-through text-muted' : '' }}">
                {{ $task->title }}
            </div>
            <small class="text-muted">
                <i class="bi bi-calendar3 me-1"></i>
                {{ $task->due_date ? $task->due_date->format('M d, Y') : 'No due date' }}
            </small>
        </div>

    </div>

    {{-- Right: Badges + Actions --}}
    <div class="d-flex align-items-center gap-2">

        {{-- Priority Badge --}}
        @if($task->priority)
            <span class="badge rounded-pill
                @if($task->priority->name === 'High') bg-danger
                @elseif($task->priority->name === 'Medium') bg-warning text-dark
                @else bg-secondary
                @endif">
                {{ $task->priority->name }}
            </span>
        @endif

        {{-- Status Badge --}}
        <span class="badge rounded-pill
            @if($task->status === 'completed') bg-success
            @elseif($task->status === 'in progress') bg-info text-dark
            @elseif($task->status === 'pending') bg-warning text-dark
            @else bg-secondary
            @endif">
            {{ ucfirst($task->status) }}
        </span>

        {{-- Edit --}}
        <a href="{{ route('tasks.edit', $task) }}" class="btn btn-sm btn-outline-secondary">
            <i class="bi bi-pencil"></i>
        </a>

        {{-- Delete --}}
        <form action="{{ route('tasks.destroy', $task) }}" method="POST"
              onsubmit="return confirm('Delete this task?')">
            @csrf
            @method('DELETE')
            <button class="btn btn-sm btn-outline-danger">
                <i class="bi bi-trash"></i>
            </button>
        </form>

    </div>
</div>