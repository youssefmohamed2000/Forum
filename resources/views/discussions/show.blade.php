@extends('layouts.app')

@section('content')

    <div class="card">
        <div class="card-header">
            <img src="{{ asset('assets/users/member-lucia.jpg') }}" alt="{{ $discussion->user->name }}"
                 width="40px" height="40px">&nbsp;&nbsp;&nbsp;
            <span>
                    <b>{{ $discussion->user->name }}</b> , <small>{{ $discussion->created_at->diffForHumans() }}</small>
            </span>
            @auth
                @can('delete',$discussion)
                    <button type="submit" style="float: right; margin-left: 5px" class="btn btn-sm btn-danger"
                            form="unfollow">
                        Delete
                    </button>
                    <form action="{{route('discussions.destroy', $discussion->id)}}" method="post" id="unfollow"
                          hidden>
                        @csrf
                        @method('delete')
                    </form>
                @endcan
                @can('update' , $discussion)
                    <a href="{{ route('discussions.edit' , $discussion->slug) }}" style="float: right;"
                       class="btn btn-primary btn-sm">Edit</a>
                @endcan
                @can('follow',$discussion)
                    @if($discussion->isfollowedByAuthUser())
                        <button type="submit" style="float: right;" class="btn btn-secondary btn-sm" form="unfollow">
                            unfollow
                        </button>
                        <form action="{{route('discussion.unfollow', $discussion->id)}}" method="post" id="unfollow"
                              hidden>
                            @csrf
                        </form>
                    @else
                        <button type="submit" style="float: right;" class="btn btn-secondary btn-sm"
                                form="follow">follow
                        </button>
                        <form action="{{route('discussion.follow', $discussion->id)}}" method="post" id="follow" hidden>
                            @csrf
                        </form>
                    @endif
                @endcannot
            @endauth
        </div>
        <div class="card-body">
            <h5 class="text-center">
                <b>{{ $discussion->title }}</b>
            </h5>
            <hr>
            <p class="text-center">
                {{ $discussion->content }}
            </p>
            <hr>
        </div>
        <div class="card-footer">
            <span>{{ $discussion->replies->count() }} Replies</span>
            @if($discussion->hasBestAnswer() === true)
                <span><button class="btn btn-danger btn-sm" style="float: right;" disabled>closed</button></span>
            @else
                <span><button class="btn btn-success btn-sm" style="float: right;" disabled>open</button></span>
            @endif
        </div>
    </div>&nbsp;&nbsp;&nbsp;

    <h4 class="text-center"><b>Replies</b></h4>&nbsp;

    @foreach($discussion->replies()->orderBy('best_answer', 'desc')->get() as $reply)
        <div class="card">
            <div class="card-header">
                <img src="{{ asset('assets/users/member-lucia.jpg') }}" alt="{{ $reply->user->name }}"
                     width="40px" height="40px">&nbsp;&nbsp;&nbsp;
                <span>
                    <b>{{ $reply->user->name }}</b>, <small>{{ $reply->created_at->diffForHumans() }}</small>
                </span>
                @auth
                    @if($reply->best_answer === 0 && $reply->user_id === auth()->user()->id)
                        <a href="{{ route('reply.edit' , $reply->id) }}" class="btn btn-primary btn-sm"
                           style="float: right">Edit</a>
                    @endif
                    @if(!$best_answer && $discussion->user_id === auth()->user()->id)
                        <a href="{{ route('reply.bestAnswer' , $reply->id) }}" class="btn btn-outline-dark btn-sm"
                           style="float: right; margin-right: 5px">mark as best answer</a>
                    @endif
                @endauth
                @if($best_answer && $best_answer->id === $reply->id)
                    <b style="float: right; color: #a52834">best answer</b>
                @endif
            </div>
            <div class="card-body">
                <p>{{ $reply->content }}</p>
            </div>
            <div class="card-footer">
                @auth
                    @if($reply->isLikedByAuthUser())
                        <form action="{{ route('reply.unlike' , $reply->id) }}" method="post">
                            @csrf
                            @method('delete')
                            <button type="submit" class="btn btn-danger btn-sm">
                                Unlike <span class="badge">{{ $reply->likes->count() }}</span>
                            </button>
                        </form>
                    @else
                        <form action="{{ route('reply.like' , $reply->id) }}" method="post">
                            @csrf
                            <button type="submit" class="btn btn-success btn-sm">
                                like <span class="badge">{{ $reply->likes->count() }}</span>
                            </button>
                        </form>
                    @endif
                @endauth
            </div>
        </div>&nbsp;&nbsp;
    @endforeach

    <div class="card">
        <div class="card-body">
            @auth
                <form action="{{ route('reply.store',$discussion->id) }}" method="POST">
                    @csrf
                    <div class="form-group">
                        <label for="content">Leave A Reply</label>&nbsp;
                        <textarea name="content" id="content" rows="5" cols="10" class="form-control"
                                  required></textarea>
                    </div>&nbsp;
                    <div class="form-group">
                        <button class="btn btn-secondary" style="float: right">Add Reply</button>
                    </div>
                </form>
            @else
                <h3 class="text-center"> Sign in to leave a reply</h3>
            @endauth
        </div>
    </div>&nbsp;&nbsp;
@endsection
