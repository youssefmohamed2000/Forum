@extends('layouts.app')

@section('content')
    <div class="container">

        <div class="row justify-content-center">

            <div class="col-md-8">

                <div class="card">

                    <div class="card-header text-center">Create New Discussion</div>

                    <div class="card-body">

                        <form action="{{ route('discussions.store') }}" method="post">
                            @csrf

                            <div class="form-group">

                                <label for="title"><b>Title</b></label>

                                <input name="title" id="title" class="form-control" value="{{ old('title') }}"
                                       placeholder="Enter Title For Your Discussion" required/>

                            </div>

                            <br>

                            <div class="form-group">

                                <label for="channel_id"><b>Pick A Channel</b></label>

                                <select name="channel_id" id="channel_id" class="form-control" required>

                                    <option value="" selected disabled>Choose One</option>

                                    @foreach($channels as $channel)

                                        <option value="{{ $channel->id }}">{{ $channel->title }}</option>

                                    @endforeach

                                </select>

                            </div>

                            <br>

                            <div class="form-group">

                                <label for="content"><b>Ask Question</b></label>

                                <textarea name="content" id="content" cols="30" rows="10" class="form-control"
                                          required>{{ old('title') }}</textarea>

                            </div>

                            <br>

                            <div class="form-group">

                                <div class="text-center">

                                    <button class="btn btn-success" type="submit">
                                        Add Disscussion
                                    </button>

                                </div>

                            </div>

                        </form>

                    </div>

                </div>

            </div>

        </div>

    </div>

@endsection



