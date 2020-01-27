@extends('layouts.app')

@section('content')
<form action="{{ route('send') }}" method="POST">
  @csrf
  <div class="form-group">
    <label for="to">To:</label>
    <select class="form-control" name="to" id="to">
      @foreach ($users as $user)
        <option value="{{ $user->id }}">{{ $user->name }} - {{ $user->email }}</option>
      @endforeach
    </select>
  </div>
  <div class="form-group">
    <label for="subject">Subject</label>
    <input type="text" class="form-control" id="subject" name="subject" placeholder="Enter subject" value="{{ $subject }}">
  </div>
  <div class="form-group">
    <label for="message">Message body</label>
    <textarea name="message" rows="8" cols="80" class="form-control" id="message"></textarea>
  </div>
  <button type="submit" class="btn btn-primary">Submit</button>
</form>

@endsection
