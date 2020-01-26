@extends('layouts.app')

@section('content')
<form>
  <div class="form-group">
    <label for="to">To:</label>
    <select class="" name="">

    </select>
  </div>
  <div class="form-group">
    <label for="subject">Subject</label>
    <input type="text" class="form-control" id="subject" name="subject" placeholder="Enter subject">
  </div>
  <div class="form-group">
    <label for="message">MEssage body</label>
    <input type="text" class="form-control" id="message" name="message" placeholder="Enter message body">
  </div>
  <button type="submit" class="btn btn-primary">Submit</button>
</form>
@endsection
