@extends('layouts.app')

@section('content')
<div class="container-fluid">

    <div class="row">
        <div class="col-md-6">
            <form action="{{route('feedback.create')}}" method="post">
                @csrf
                @guest
                <div class="row form-group">
                    <div class="col-md-12">
                        <label for="name">Name: </label>
                        <input id="name" type="text" name="name" class="form-control" required>
                        @if ($errors->has('name'))
                                        <strong>{{ $errors->first('name') }}</strong>
                        @endif
                    </div>
                </div>
                <div class="row form-group">
                    <div class="col-md-12">
                        <label for="email">Email: </label>
                        <input id="email" type="email" name="email" class="form-control " required>
                        @if ($errors->has('email'))

                                        <strong>{{ $errors->first('email') }}</strong>

                        @endif
                    </div>
                </div>
                @endguest
                <div class="row form-group">
                    <div class="col-md-12">
                    <label for="text-comment">Text</label>
                    <textarea class="form-control" name="text" id="text-comment" rows="7" required></textarea>
                        @if ($errors->has('text'))
                                        <strong>{{ $errors->first('text') }}</strong>
                        @endif
                    </div>
                    </div>
                <div class="row form-group">
                    <div class="col-md-12">
                        <button type="submit" class="btn btn-success w-50 float-right">Ad Post</button>
                    </div>
                </div>
            </form>
        </div>
    </div>

</div>

@endsection