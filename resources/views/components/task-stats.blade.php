@props(['tasks'])

<div class="row g-3 mb-4">
    <div class="col-6 col-md-3">
        <div class="card border-0 shadow-sm text-center p-3">
            <div class="text-primary fs-4 fw-bold">{{ $tasks->count() }}</div>
            <small class="text-muted"><i class="bi bi-list-task me-1"></i>Total</small>
        </div>
    </div>
    <div class="col-6 col-md-3">
        <div class="card border-0 shadow-sm text-center p-3">
            <div class="text-warning fs-4 fw-bold">{{ $tasks->where('status', 'pending')->count() }}</div>
            <small class="text-muted"><i class="bi bi-hourglass-split me-1"></i>Pending</small>
        </div>
    </div>
    <div class="col-6 col-md-3">
        <div class="card border-0 shadow-sm text-center p-3">
            <div class="text-success fs-4 fw-bold">{{ $tasks->where('status', 'completed')->count() }}</div>
            <small class="text-muted"><i class="bi bi-check-circle me-1"></i>Completed</small>
        </div>
    </div>
    <div class="col-6 col-md-3">
        <div class="card border-0 shadow-sm text-center p-3">
            <div class="text-danger fs-4 fw-bold">
                {{ $tasks->filter(fn($t) => $t->due_date && $t->due_date < now() && $t->status !== 'completed')->count() }}
            </div>
            <small class="text-muted"><i class="bi bi-exclamation-circle me-1"></i>Overdue</small>
        </div>
    </div>
</div>