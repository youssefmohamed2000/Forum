@extends('layouts.app')

@section('content')
    <h4 class="text-center"><b>({{ $channel->title }}) Discussions</b></h4>
    @foreach($discussions as $discussion)

        <div class="card">

            <div class="card-header">
                <img src="{{ asset('assets/users/member-lucia.jpg') }}" alt="{{ $discussion->user->name }}"
                     width="40px" height="40px">&nbsp;&nbsp;&nbsp;
                <span>
                    <b>{{ $discussion->user->name }}</b>, <small>{{ $discussion->created_at->diffForHumans() }}</small>
                </span>
                <a href="{{ route('discussions.show' , $discussion->slug) }}" style="float: right;"
                   class="btn btn-secondary btn-sm">View</a>
                @if($discussion->hasBestAnswer() === true)
                    <span class="btn btn-danger btn-sm" style="float: right; margin-right: 5px">closed</span>
                @else
                    <span class="btn btn-success btn-sm" style="float: right; margin-right: 5px">open</span>
                @endif
            </div>
            <div class="card-body">
                <h5 class="text-center">
                    <b>{{ $discussion->title }}</b>
                </h5>
                <p class="text-center">
                    {{ Str::limit($discussion->content , 150) }}
                </p>
            </div>
            <div class="card-footer">
                <span>{{ $discussion->replies->count() }} Replies</span>
            </div>
        </div>&nbsp;
    @endforeach

    <div class="text-center">
        {{ $discussions->links() }}
    </div>
@endsection
