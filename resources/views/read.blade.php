@extends('layouts.app')

@section('content')
  <p>Message from: {{ $message->userFrom->name }} - {{ $message->userFrom->email }}</p>
  <p>Subject: {{ $message->subject}}<p/>
  <hr>
  <p> Message body:</p>
  <p>{{ $message->body}}<p/>
  <hr>
  <a href="{{ route('create', [$message->userFrom->id, $message->subject]) }}" class="btn btn-primary">Reply</a>
@endsection
