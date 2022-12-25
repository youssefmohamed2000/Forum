<div class="container">

    <div class="row justify-content-center">

        <div class="col-md-8">

            <div class="card">
                <div class="card-header">
                    <b>Edit Reply</b>
                    <a href="{{ route('discussions.show' , $reply->discussion_id) }}" class="btn btn-secondary btn-sm"
                       style="float: right">
                        Show discussion
                    </a>
                </div>

                <div class="card-body">
                    <form wire:submit.prevent="update" method="post">
                        <div>
                            @if (session()->has('message'))
                                <div class="alert alert-success">
                                    {{ session('message') }}
                                </div>
                            @endif
                        </div>
                        <div class="form-group">
                            <label for="content"><b>Leave A Reply</b></label>
                            <textarea wire:model="content" name="content" id="content" cols="30" rows="10"
                                      class="form-control"
                                      {{--required--}}>{{ $reply->content }}</textarea>
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
                                    Update Reply
                                </button>
                            </div>
                        </div>

                    </form>
                </div>
            </div>

        </div>
    </div>
</div>
