<div class="container">

    <div class="row justify-content-center">

        <div class="col-md-8">

            <div class="card">

                <div class="card-header">

                    <b>Edit Discussion</b>

                    <a href="{{ route('discussions.show' , $discussion->id) }}" class="btn btn-secondary btn-sm"
                       style="float: right">
                        Show discussion
                    </a>

                </div>

                <div class="card-body">

                    <form wire:submit.prevent="update">

                        <div>
                            @if (session()->has('message'))
                                <div class="alert alert-success">
                                    {{ session('message') }}
                                </div>
                            @endif
                        </div>

                        <div class="form-group">

                            <label for="title"><b>Title</b></label>

                            <input name="title" id="title" class="form-control" value="{{$discussion->title}}"
                                   disabled/>

                        </div>

                        <br>

                        <div class="form-group">

                            <label for="channel_id"><b>Pick A Channel</b></label>

                            <select name="channel_id" id="channel_id" class="form-control" disabled>

                                @foreach($channels as $channel)

                                    <option value="{{ $channel->id }}"
                                        {{ $channel->id === $discussion->channel_id ? 'selected' : '' }} >
                                        {{ $channel->title }}
                                    </option>

                                @endforeach

                            </select>

                        </div>

                        <br>

                        <div class="form-group">

                            <label for="content"><b>Ask Question</b></label>

                            <textarea name="content" id="content" class="form-control"
                                      wire:model.defer="content" required>
                                {{ $content }}
                            </textarea>

                            @error('content')
                            <span class="error" style="color: red; font-weight: bold">
                                {{ $message }}
                            </span>
                            @enderror

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

        </div>

    </div>

</div>
