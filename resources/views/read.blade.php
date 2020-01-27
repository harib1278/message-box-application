@extends('layouts.app')

@section('content')
  <p>Message from: {{ $message->userFrom->name }} - {{ $message->userFrom->email }}</p>
  <p>Subject: {{ $message->subject}}<p/>
  <hr>
  <p> Message body:</p>
  <p>{{ $message->body}}<p/>
  <hr>
  <a href="{{ route('reply', $meessage->userFrom->id) }}" class="btn btn-primary">Reply</a>
@endsection
