@extends('layouts.app')

@section('content')
    <div class="container-fluid">
        <div class="row">

                    <div class="col-md-6">
                        <table class="table table-striped table-hover">
                            <tr>
                                <th>Make</th>
                                <th>Model</th>
                                <th>Produced on</th>
                            </tr>
                            @foreach($feedback as $feedback)
                                <tr>
                                    <td>{{$feedback->name}}</td>
                                    <td>{{$feedback->email}}</td>
                                    <td>{{$feedback->text}}</td>
                                </tr>
                            @endforeach
                        </table>
                    </div>
        </div>
    </div>
@endsection