@extends('layouts.app')

@section('content')
<div class="container py-4">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="d-flex align-items-center mb-4">
                <i class="bi bi-list-check display-5 text-primary me-2"></i>
                <h2 class="mb-0 fw-bold">To-Do List</h2>
            </div>
            @if(session('success'))
                <div class="alert alert-success alert-dismissible fade show" role="alert">
                    {{ session('success') }}
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
            @endif
            <form class="row g-2 mb-3" method="GET" action="{{ route('todos.index') }}">
                <div class="col-md-5">
                    <input type="text" name="search" class="form-control shadow-sm" placeholder="Cari to-do..." value="{{ $search }}">
                </div>
                <div class="col-md-4">
                    <select name="filter" class="form-select shadow-sm">
                        <option value="" {{ !$filter ? 'selected' : '' }}>Semua</option>
                        <option value="pending" {{ $filter==='pending' ? 'selected' : '' }}>Belum Selesai</option>
                        <option value="completed" {{ $filter==='completed' ? 'selected' : '' }}>Selesai</option>
                    </select>
                </div>
                <div class="col-md-3">
                    <button class="btn btn-primary w-100 shadow-sm" type="submit"><i class="bi bi-search"></i> Cari</button>
                </div>
            </form>
            <a href="{{ route('todos.create') }}" class="btn btn-success mb-3 shadow-sm"><i class="bi bi-plus-circle"></i> Tambah To-Do</a>
            <a href="{{ route('todos.export', ['search' => request('search'), 'filter' => request('filter')]) }}" class="btn btn-outline-primary mb-3 ms-2 shadow-sm"><i class="bi bi-file-earmark-excel"></i> Export Excel</a>
            <div class="card border-0 shadow-sm">
                <ul class="list-group list-group-flush">
                    @forelse($todos as $todo)
                        <li class="list-group-item d-flex align-items-center justify-content-between py-3 list-hover">
                            <div class="d-flex align-items-center">
                                <form method="POST" action="{{ route('todos.toggle', $todo) }}" class="me-3">
                                    @csrf
                                    @method('PATCH')
                                    <button type="submit" class="btn btn-sm p-0 border-0 bg-transparent" title="Tandai selesai">
                                        <i class="bi {{ $todo->is_completed ? 'bi-check-circle-fill text-success' : 'bi-circle text-secondary' }} fs-4"></i>
                                    </button>
                                </form>
                                <span class="fs-5 {{ $todo->is_completed ? 'text-decoration-line-through text-muted' : '' }}">{{ $todo->title }}</span>
                                @if($todo->is_completed)
                                    <span class="badge bg-success ms-2">Selesai</span>
                                @else
                                    <span class="badge bg-warning text-dark ms-2">Belum</span>
                                @endif
                            </div>
                            <div>
                                <a href="{{ route('todos.edit', $todo) }}" class="btn btn-sm btn-outline-warning me-1"><i class="bi bi-pencil"></i></a>
                                <form action="{{ route('todos.destroy', $todo) }}" method="POST" class="d-inline">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-sm btn-outline-danger" onclick="return confirm('Hapus to-do ini?')"><i class="bi bi-trash"></i></button>
                                </form>
                            </div>
                        </li>
                    @empty
                        <li class="list-group-item text-center py-4 text-muted">
                            <i class="bi bi-emoji-frown fs-2"></i><br> Tidak ada to-do.
                        </li>
                    @endforelse
                </ul>
            </div>
        </div>
    </div>
</div>
<style>
.list-hover:hover {
    background: #f1f3f6;
    transition: background 0.2s;
}
</style>
@endsection
