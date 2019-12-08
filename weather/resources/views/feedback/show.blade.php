@extends('layouts.app')

@section('content')
    <div class="container-fluid">
        <div class="row">

                    <div class="col-md-8">
                        <table class="table table-striped table-hover">
                            <tr>
                                <th>Name</th>
                                <th>Email</th>
                                <th>Text</th>
                            </tr>
{{--                            {{dd( DB::getQueryLog())}}--}}

                            @foreach($feedback as $feedbackItem)
                                <tr>
                                    @if($feedbackItem->name)
                                        <td>{{$feedbackItem->name}}</td>
                                        <td>{{$feedbackItem->email}}</td>
                                    @else
                                        <td>{{$feedbackItem->user->fname .$feedbackItem->user->lname}}</td>
                                        <td>{{$feedbackItem->user->email}}</td>
                                        @endif

                                    <td><div style="overflow: auto;">{{$feedbackItem->text}}</div></td>
                                </tr>
                            @endforeach
                        </table>
                    </div>
        </div>
    </div>

@endsection

