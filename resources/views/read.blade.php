@extends('layouts.app')

@section('content')
  @if ($message == false)
    <p>Message doesnt exist</p>
  @else
    <br>
    <p>Message from: {{ $message->userFrom->name }} - {{ $message->userFrom->email }}</p>
    <p>Subject: {{ $message->subject}}<p/>
    <p>Sent: {{ $message->created_at }}</p>
    <hr>
    <p> Message body:</p>
    <p>{{ $message->body}}<p/>
    <hr>
    <a href="{{ route('create', [$message->userFrom->id, $message->subject]) }}" class="btn btn-primary">Reply</a>
    <a href="{{ route('delete', [$message->id]) }}" class="btn btn-danger float-right">Trash</a>
  @endif


@endsection
