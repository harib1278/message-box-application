@extends('layouts.app')

@section('content')
  @if ($messsge == false)
    <p>Message doesnt exist</p>
  @else
    <br>
    <p>Message from: {{ $messsge->userFrom->name }} - {{ $messsge->userFrom->email }}</p>
    <p>Subject: {{ $messsge->subject}}<p/>
    <p>Sent: {{ $messsge->created_at }}</p>
    <hr>
    <p> Message body:</p>
    <p>{{ $messsge->body}}<p/>
    <hr>
    <a href="{{ route('create', [$messsge->userFrom->id, $messsge->subject]) }}" class="btn btn-primary">Reply</a>
    <a href="{{ route('delete', [$messsge->id]) }}" class="btn btn-danger float-right">Trash</a>
  @endif


@endsection
