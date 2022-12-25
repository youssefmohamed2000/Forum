@extends('layouts.app')

@section('content')

    <div class="card">
        <div class="card-header"><b>Edit Channel : {{ $channel->title }}</b></div>

        <div class="card-body">
            <form action="{{ route('channels.update' , $channel->slug) }}" method="post">
                @csrf
                @method('PUT')
                <div class="form-group">
                    <input type="text" class="form-control" name="title" value="{{ $channel->title }}"
                           placeholder="Enter Channel Title" required>
                </div>
                <br>
                <div class="form-group">
                    <div class="text-center">
                        <button class="btn btn-success" type="submit">
                            Update Channel
                        </button>
                    </div>
                </div>

            </form>
        </div>
    </div>

@endsection
