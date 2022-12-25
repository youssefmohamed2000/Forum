@extends('layouts.app')

@section('content')

    <div class="card">
        <div class="card-header text-center">
            <h5><b>Edit Discussion</b></h5>
        </div>

        <div class="card-body">
            <form action="{{ route('discussions.update',$discussion->slug) }}" method="post">
                @csrf
                @method('put')
                <div class="form-group">
                    <label for="title"><b>Title</b></label>
                    <input name="title" id="title" class="form-control" value="{{ $discussion->title }}" disabled/>
                </div>
                <br>
                <div class="form-group">
                    <label for="channel_id"><b>Pick A Channel</b></label>
                    <select name="channel_id" id="channel_id" class="form-control" disabled>
                        <option value="{{ $discussion->channel_id }}">{{ $discussion->channel->title }}</option>
                    </select>
                </div>
                <br>
                <div class="form-group">
                    <label for="content"><b>Ask Question</b></label>
                    <textarea name="content" id="content" cols="30" rows="10" class="form-control"
                              required>{{ $discussion->content }}</textarea>
                </div>
                <br>
                <div class="form-group">
                    <div class="text-center">
                        <button class="btn btn-success" type="submit">
                            Update Discussion
                        </button>
                    </div>
                </div>

            </form>
        </div>
    </div>

@endsection
