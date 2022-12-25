<div class="container">

    <div class="row justify-content-center">

        {{--sidebar--}}

        <div class="col-md-4">

            <a href="{{ route('discussions.create') }}" class="form-control btn btn-primary">
                Create A New Discussion
            </a>&nbsp;&nbsp;

            <div class="card">

                <div class="card-body">

                    <ul class="list-group">

                        <li class="list-group-item">

                            <a style="text-decoration: none"
                               @if(request()->is('*home*'))
                                   href="#"
                               @else
                                   href="{{ route('home') }}"
                               @endif
                               wire:click="discussionType">
                                Home
                            </a>

                        </li>

                        <li class="list-group-item">

                            <a style="text-decoration: none"
                               @if(request()->is('*home*'))
                                   href="#"
                               @else
                                   href="{{ route('home') }}"
                               @endif
                               wire:click="discussionType('my_discussions')"
                            >
                                My Discussions
                            </a>

                        </li>

                        <li class="list-group-item">

                            <a style="text-decoration: none"
                               @if(request()->is('*home*'))
                                   href="#"
                               @else
                                   href="{{ route('home') }}"
                               @endif
                               wire:click="discussionType('my_following')">
                                My Followig
                            </a>

                        </li>

                        <li class="list-group-item">

                            <a style="text-decoration: none"
                               @if(request()->is('*home*'))
                                   href="#"
                               @else
                                   href="{{ route('home') }}"
                               @endif
                               wire:click="discussionType('answered_discussions')">
                                Answered Discussions
                            </a>

                        </li>

                    </ul>

                </div>

            </div>&nbsp;&nbsp;

            <div class="card">

                <div class="card-header">

                    <a href="{{ route('channels.index') }}" class="btn btn-toolbar">
                        <b>Channels</b>
                    </a>

                </div>

                <div class="card-body">

                    <ul class="list-group">

                        @foreach(\App\Models\Channel::all() as $channel)

                            <li class="list-group-item">

                                <a style="text-decoration: none"
                                   @if(request()->is('*home*'))
                                       href="#" wire:click="discussionChannel('{{$channel->id}}')"
                                   @else
                                       href="{{ route('home') }}" wire:click="discussionChannel('{{$channel->id}}')"
                                    @endif
                                >
                                    {{ $channel->title }}
                                </a>

                            </li>

                        @endforeach

                    </ul>

                </div>

            </div>

        </div>{{--end of sidebar--}}

        {{--content--}}
        <div class="col-md-8">

            @if($channel_name === null)
                <h2 style="text-align: center;"><b>{{$discussion_type}}</b></h2>
            @else
                <h2 style="text-align: center;"><b>{{$channel_name}} : Discussions</b></h2>
            @endif

            @forelse($discussions as $discussion)

                <div class="card">

                    <div class="card-header">
                        <img src="{{ asset('assets/users/member-lucia.jpg') }}" alt="{{ $discussion->user->name }}"
                             width="40px" height="40px">&nbsp;&nbsp;&nbsp;
                        <span>
                    <b>{{ $discussion->user->name }}</b>, <small>{{ $discussion->created_at->diffForHumans() }}</small>
                </span>
                        <a href="{{ route('discussions.show' , $discussion->id) }}" style="float: right;"
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
                        <span style="float: right; text-decoration: none">{{ $discussion->channel->title }}</span>
                    </div>
                </div>
                <br>
                <br>
            @empty
                <div class="card">
                    <div class="card-body">
                        <p>There are no Discussions here</p>
                    </div>
                </div>
            @endforelse
            <div class="text-center">
                {{ $discussions->links() }}
            </div>
        </div>

    </div>

</div>
