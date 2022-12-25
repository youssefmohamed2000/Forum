<div class="container">

    <div class="row justify-content-center">

        <div class="col-md-8">

            <div class="card">

                <div class="card-header">

                    <b>Edit Channel </b>

                    <a href="{{ route('channels.index') }}" class="btn btn-secondary btn-sm" style="float: right">
                        All channels
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

                            <input type="text" wire:model="title" class="form-control" name="title"
                                   value="{{ $channel->title }}"
                                   placeholder="Enter Channel Title" required>

                            @error('title')

                            <span class="error" style="color: red; font-weight: bold">
                                {{ $message }}
                            </span>

                            @enderror

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

        </div>

    </div>

</div>
