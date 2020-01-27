@extends('layouts.app')

@section('content')
<h6>Sent messaages</h6>
  @if (count($messages) > 0)
    <ul class="list-group">
      @foreach($messages as $message)
        <li class="list-group-item"><strong>To: {{ $message->userTo->name }} - {{ $message->userTo->email }} </strong>| {{  $message->subject }}
          @if ($message->read)
            <span class="badge badge-secondary success float-right">READ</span>
          @endif
        </li>
      @endforeach
    </ul>
  @else
    <p>No messages!</p>
  @endif
@endsection
