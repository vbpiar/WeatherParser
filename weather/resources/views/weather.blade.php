@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-9">
            <div class="card">
                <div class="card-header">Weather Prediction</div>

                <div class="card-body">
                        <div class="col-md-12">
                                        <table class="table table-striped table-hover">
                                            <tr>
                                                <th>Time</th>
                                                <th>Wind</th>
                                                <th>Temperature</th>
                                                <th>Rain</th>
                                            </tr>
                                            @foreach($weather as $item)
                                                <tr>
                                                    <td>{{$item->time}}</td>
                                                    <td>{{$item->wind}}</td>
                                                    <td>{{$item->temp}}</td>
                                                    <td>{{$item->rain}}</td>
                                                </tr>
                                            @endforeach
                                        </table>
                                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
