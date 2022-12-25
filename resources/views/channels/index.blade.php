@extends('layouts.app')

@section('content')

    <div class="card">
        <div class="card-header"><b>Channels</b></div>
        <div class="card-body">
            <table class="table table-hover">
                <thead>
                <th>Name</th>
                <th>Edit</th>
                <th>Delete</th>
                </thead>
                <tbody>
                @foreach($channels as $channel)
                    <tr>
                        <td>{{ $channel->title }}</td>
                        <td>
                            <a href="{{ route('channels.edit' , $channel->slug) }}"
                               class="btn btn-xs btn-primary">Edit</a>
                        </td>
                        <td>
                            <form action="{{ route('channels.destroy' ,$channel->slug) }}" method="post">
                                @csrf
                                @method('delete')
                                <button class="btn btn-xs btn-danger">Delete</button>
                            </form>
                        </td>
                    </tr>
                @endforeach
                </tbody>
            </table>
        </div>
    </div>

@endsection
