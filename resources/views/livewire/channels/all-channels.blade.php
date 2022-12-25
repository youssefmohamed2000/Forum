<div class="container">

    <div class="row justify-content-center">

        <div class="col-md-8">

            <div class="card">

                <div class="card-header">

                    <b>Channels</b>

                    <a href="{{ route('channels.create') }}" class="btn btn-secondary btn-sm" style="float: right">
                        Create Channel
                    </a>

                </div>

                <div class="card-body">

                    <div>

                        @if (session()->has('message'))
                            <div class="alert alert-success">
                                {{ session('message') }}
                            </div>
                        @endif

                    </div>

                    <table class="table table-hover">

                        <thead>

                        <th>Name</th>
                        <th colspan="2">Actions</th>

                        </thead>

                        <tbody>

                        @foreach($channels as $channel)

                            <tr>

                                <td>{{ $channel->title }}</td>

                                <td>

                                    <a href="{{ route('channels.edit' , $channel->id) }}"
                                       class="btn btn-sm btn-primary">
                                        Edit
                                    </a>

                                    <button class="btn btn-sm btn-danger" wire:click="delete({{ $channel }})">
                                        Delete
                                    </button>

                                </td>

                            </tr>

                        @endforeach

                        </tbody>

                    </table>

                    <div class="text-center" style="display: flex; justify-content: center">

                        {{ $channels->links() }}

                    </div>

                </div>

            </div>

        </div>

    </div>

</div>
