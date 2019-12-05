@extends('layouts.app')

@section('content')
    <div class="container-fluid">
        <div class="row">

                    <div class="col-md-6">
                        <table class="table table-striped table-hover">
                            <tr>
                                <th>Name</th>
                                <th>Email</th>
                                <th>Text</th>
                            </tr>
                            @foreach($feedback as $feedback)
                                <tr>
                                    <td>{{$feedback->name}}</td>
                                    <td>{{$feedback->email}}</td>
                                    <td><div style="overflow: auto; height: 60px; width: 200px;">{{$feedback->text}}</div></td>
                                </tr>
                            @endforeach
                        </table>
                    </div>
        </div>
    </div>
@endsection