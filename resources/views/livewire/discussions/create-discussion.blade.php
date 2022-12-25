<div class="container">

    <div class="row justify-content-center">

        <div class="col-md-8">

            <div class="card">

                <div class="card-header text-center">

                    <h4 style="font-weight: bold">Create New Discussion</h4>

                </div>

                <div class="card-body">

                    <form wire:submit.prevent="createDiscussion" method="post">

                        <div>
                            @if (session()->has('message'))
                                <div class="alert alert-success">
                                    {{ session('message') }}
                                </div>
                            @endif
                        </div>

                        <div class="form-group">

                            <label for="title"><b>Title</b></label>

                            <input name="title" id="title" class="form-control"
                                   wire:model="title"
                                   placeholder="Enter Title For Your Discussion" required/>
                            @error('title')
                            <span class="error" style="color: red; font-weight: bold">
                                {{ $message }}
                            </span>
                            @enderror

                        </div>

                        <br>

                        <div class="form-group">

                            <label for="channel_id"><b>Pick A Channel</b></label>

                            <select name="channel_id" id="channel_id" class="form-control"
                                    wire:model="channel_id" required>

                                <option value="" selected>Choose One</option>

                                @foreach($channels as $channel)

                                    <option value="{{ $channel->id }}">{{ $channel->title }}</option>

                                @endforeach

                            </select>

                            @error('channel_id')
                            <span class="error" style="color: red; font-weight: bold">
                                {{ $message }}
                            </span>
                            @enderror

                        </div>

                        <br>

                        <div class="form-group">

                            <label for="content"><b>Ask Question</b></label>

                            <textarea name="content" id="content" cols="30" rows="10" class="form-control"
                                      wire:model="content" required>
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
                                    Add Discussion
                                </button>

                            </div>

                        </div>

                    </form>

                </div>

            </div>

        </div>

    </div>

</div>
