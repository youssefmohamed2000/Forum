@extends('layouts.app')

@section('content')

    <div class="card">
        <div class="card-header text-center">
            <h5><b>Edit Reply</b></h5>
        </div>

        <div class="card-body">
            <form action="{{ route('reply.update',$reply->id) }}" method="post">
                @csrf
                @method('put')
                <div class="form-group">
                    <label for="content"><b>Leave A Reply</b></label>
                    <textarea name="content" id="content" cols="30" rows="10" class="form-control"
                              required>{{ $reply->content }}</textarea>
                </div>
                <br>
                <div class="form-group">
                    <div class="text-center">
                        <button class="btn btn-success" type="submit">
                            Update Reply
                        </button>
                    </div>
                </div>

            </form>
        </div>
    </div>

@endsection
