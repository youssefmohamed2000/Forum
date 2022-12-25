<div class="container">

    <div class="row justify-content-center">

        <div class="col-md-8">

            <div class="card">

                <div class="card-header">

                    <img src="{{ asset('assets/users/member-lucia.jpg') }}" alt="{{ $discussion->user->name }}"
                         width="40px" height="40px">&nbsp;&nbsp;&nbsp;

                    <span>

                        <b>{{ $discussion->user->name }}</b> , <small>{{ $discussion->created_at->diffForHumans() }}</small>

                    </span>

                    @can('delete',$discussion)

                        <button wire:click="delete" style="float: right; margin-left: 5px"
                                class="btn btn-sm btn-danger">
                            Delete
                        </button>

                    @endcan

                    @can('update' , $discussion)

                        <a href="{{ route('discussions.edit' , $discussion->id) }}" style="float: right;"
                           class="btn btn-primary btn-sm">Edit</a>

                    @endcan

                    @can('follow',$discussion)

                        @if($discussion->isfollowedByAuthUser())

                            <button type="submit" style="float: right;" class="btn btn-secondary btn-sm"
                                    wire:click="unfollow">
                                unfollow
                            </button>

                        @else

                            <button type="submit" style="float: right;" class="btn btn-secondary btn-sm"
                                    wire:click="follow">
                                follow
                            </button>

                        @endif

                    @endcannot

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

                        <span><button class="btn btn-danger btn-sm" style="float: right;"
                                      disabled>closed</button></span>

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

                        @if($reply->best_answer === 0 && $reply->user_id === auth()->user()->id)

                            <button wire:click="deleteReply({{ $reply }})" class="btn btn-danger btn-sm"
                                    style="float: right; margin-left: 3px">
                                delete
                            </button>

                            <a href="{{ route('replies.edit' , $reply->id) }}" class="btn btn-primary btn-sm"
                               style="float: right">Edit</a>

                        @endif

                        @if(!$discussion->hasBestAnswer() && $discussion->user_id === auth()->user()->id)

                            <button wire:click="makeBestAnswer({{$reply->id}})"
                                    class="btn btn-outline-dark btn-sm"
                                    style="float: right; margin-right: 5px">mark as best answer
                            </button>

                        @endif

                        @if($discussion->hasBestAnswer() && $best_answer->id === $reply->id)

                            <b style="float: right; color: #a52834">best answer</b>

                        @endif

                    </div>

                    <div class="card-body">

                        <p>{{ $reply->content }}</p>

                    </div>

                    <div class="card-footer">

                        @if($reply->isLikedByAuthUser())

                            <button wire:click="unlike({{$reply->id}})" class="btn btn-danger btn-sm">
                                Unlike <span class="badge">{{ $reply->likes->count() }}</span>
                            </button>

                        @else

                            <button wire:click="like({{$reply->id}})" class="btn btn-success btn-sm">
                                like <span class="badge">{{ $reply->likes->count() }}</span>

                            </button>

                        @endif

                    </div>

                </div>&nbsp;&nbsp;

            @endforeach

            <div class="card">

                <div class="card-body">

                    <form wire:submit.prevent="addReply">

                        <div>
                            @if (session()->has('message'))
                                <div class="alert alert-success">
                                    {{ session('message') }}
                                </div>
                            @endif
                        </div>

                        @csrf

                        <div class="form-group">

                            <label for="content">Leave A Reply</label>&nbsp;

                            <textarea wire:model="reply_content" name="reply_content" id="reply_content"
                                      rows="5"
                                      cols="10" class="form-control"
                                      {{--required--}}></textarea>

                            @error('reply_content')

                            <span class="error" style="color: red; font-weight: bold">
                                {{ $message }}
                            </span>

                            @enderror

                        </div>&nbsp;

                        <div class="form-group">

                            <button class="btn btn-secondary" style="float: right">Add Reply</button>

                        </div>

                    </form>

                </div>

            </div>&nbsp;&nbsp;

        </div>


    </div>

</div>
