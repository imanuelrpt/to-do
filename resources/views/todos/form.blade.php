@extends('layouts.app')

@section('content')
<div class="container py-4">
    <div class="row justify-content-center">
        <div class="col-md-6">
            <h2 class="mb-4">{{ $todo->exists ? 'Edit To-Do' : 'Tambah To-Do' }}</h2>
            @if($errors->any())
                <div class="alert alert-danger">
                    <ul class="mb-0">
                        @foreach($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif
            <form method="POST" action="{{ $todo->exists ? route('todos.update', $todo) : route('todos.store') }}">
                @csrf
                @if($todo->exists)
                    @method('PUT')
                @endif
                <div class="mb-3">
                    <label for="title" class="form-label">Judul To-Do</label>
                    <input type="text" name="title" id="title" class="form-control" value="{{ old('title', $todo->title) }}" required maxlength="255">
                </div>
                <button type="submit" class="btn btn-primary">{{ $todo->exists ? 'Update' : 'Tambah' }}</button>
                <a href="{{ route('todos.index') }}" class="btn btn-secondary">Batal</a>
            </form>
        </div>
    </div>
</div>
@endsection
