-@extends('layouts.app')

@section('content')
  @if (count($messages) > 0)
    <ul class="list-group">
      @foreach($messages as $message)
        <li class="list-group-item"><strong>From: {{ $message->userFrom->name }} - {{ $message->userFrom->email }} </strong>| {{  $message->subject }}</li>
      @endforeach
    </ul>
  @else
    <p>No messages!</p>
  @endif
@endsection
