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
                        <label for="">Name: </label>
                        <input type="text" name="name" class="form-control" required>
                    </div>
                </div>
                <div class="row form-group">
                    <div class="col-md-12">
                        <label for="">Email: </label>
                        <input type="email" name="email" class="form-control " required>
                    </div>
                </div>
                @endguest
                <div class="row form-group">
                    <div class="col-md-12">
                    <label for="text-comment">Text</label>
                    <textarea class="form-control" name="text" id="text-comment" rows="7" required></textarea>
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