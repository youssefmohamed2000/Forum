@extends('layouts.app')

@section('content')

    <div class="card">
        <div class="card-header">Create New Channel</div>

        <div class="card-body">
            <form action="{{ route('channels.store') }}" method="post">
                @csrf
                <div class="form-group">
                    <input type="text" class="form-control" name="title" value="{{ old('title') }}"
                           placeholder="Enter Channel Title" required>
                </div>
                <br>
                <div class="form-group">
                    <div class="text-center">
                        <button class="btn btn-success" type="submit">
                            Create Channel
                        </button>
                    </div>
                </div>

            </form>
        </div>
    </div>

@endsection
