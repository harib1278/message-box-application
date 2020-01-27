@extends('layouts.app')

@section('content')
<h4>Inbox</h4>
  @if (count($messages) > 0)
    <ul class="list-group">
      @foreach($messages as $message)
        <li class="list-group-item">
          <a href="{{ route('read', $message->id) }}">
            <strong>From: {{ $message->userFrom->name }} - {{ $message->userFrom->email }} </strong>| {{  $message->subject }}
          </a>
        </li>
      @endforeach
    </ul>
  @else
    <p>No messages!</p>
  @endif
@endsection
