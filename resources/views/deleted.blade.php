@extends('layouts.app')

@section('content')
<h4>Trash</h4>
  @if (count($messages) > 0)
    <ul class="list-group">
      @foreach($messages as $message)
        <li class="list-group-item">
            <strong>From: {{ $message->userFrom->name }} - {{ $message->userFrom->email }} </strong>| {{  $message->subject }}
            <a href="{{ route('restore', $message->id) }}" class="btn btn-sm btn-info float-right">Restore</a>
        </li>
      @endforeach
    </ul>
  @else
    <p>You have No messages!</p>
  @endif
@endsection
