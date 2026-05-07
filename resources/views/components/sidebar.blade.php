<div class="d-flex flex-column p-3 bg-dark text-white" style="width: 240px; min-width: 240px; min-height: 100vh;">

    <!-- Logo -->
    <div class="mb-4 border-bottom border-secondary pb-3">
        <h5 class="text-white mb-0 fw-bold">
            <i class="bi bi-check2-square me-2 text-primary"></i>ToDo List
        </h5>
        <small class="text-secondary ms-4">System Management</small>
    </div>

    <!-- Menu -->
    <ul class="nav nav-pills flex-column mb-auto gap-1">

        <li class="nav-item">
            <a href="{{ route('tasks.index') }}"
               class="nav-link text-white d-flex justify-content-between align-items-center {{ request()->routeIs('tasks.index') ? 'active bg-primary' : '' }}">
                <span><i class="bi bi-list-task me-2"></i>All Tasks</span>
                <span class="badge bg-secondary">{{ $counts['all'] ?? 0 }}</span>
            </a>
        </li>

        <li class="nav-item">
            <a href="{{ route('tasks.today') }}"
               class="nav-link text-white d-flex justify-content-between align-items-center {{ request()->routeIs('tasks.today') ? 'active bg-primary' : '' }}">
                <span><i class="bi bi-calendar-check me-2"></i>Today</span>
                <span class="badge bg-secondary">{{ $counts['today'] ?? 0 }}</span>
            </a>
        </li>

        <li class="nav-item">
            <a href="{{ route('tasks.upcoming') }}"
               class="nav-link text-white d-flex justify-content-between align-items-center {{ request()->routeIs('tasks.upcoming') ? 'active bg-primary' : '' }}">
                <span><i class="bi bi-arrow-right-circle me-2"></i>Upcoming</span>
                <span class="badge bg-secondary">{{ $counts['upcoming'] ?? 0 }}</span>
            </a>
        </li>

        <li class="nav-item">
            <a href="{{ route('tasks.completed') }}"
               class="nav-link text-white d-flex justify-content-between align-items-center {{ request()->routeIs('tasks.completed') ? 'active bg-primary' : '' }}">
                <span><i class="bi bi-check-circle me-2"></i>Completed</span>
                <span class="badge bg-success">{{ $counts['completed'] ?? 0 }}</span>
            </a>
        </li>

        <li class="nav-item">
            <a href="{{ route('tasks.overdue') }}"
               class="nav-link text-white d-flex justify-content-between align-items-center {{ request()->routeIs('tasks.overdue') ? 'active bg-primary' : '' }}">
                <span><i class="bi bi-exclamation-circle me-2"></i>Overdue</span>
                <span class="badge bg-danger">{{ $counts['overdue'] ?? 0 }}</span>
            </a>
        </li>

    </ul>

    <!-- Productivity -->
    <div class="mt-auto pt-3 border-top border-secondary">
        <small class="text-secondary text-uppercase fw-bold">
            <i class="bi bi-graph-up me-1"></i>Productivity
        </small>
        <div class="progress mt-2 bg-secondary" style="height: 6px;">
            <div class="progress-bar bg-primary" style="width: {{ $productivity ?? 0 }}%"></div>
        </div>
        <small class="text-secondary mt-1 d-block">{{ $productivity ?? 0 }}% completion</small>
    </div>

</div>