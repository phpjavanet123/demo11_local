@extends('layouts.app')

@section('content')
<style>
  .uper {
    margin-top: 40px;
  }
</style>
<div class="card uper">
  <div class="card-header">Edit Client</div>
  <div class="card-body">
    @if ($errors->any())
      <div class="alert alert-danger">
        <ul>
            @foreach ($errors->all() as $error)
              <li>{{ $error }}</li>
            @endforeach
        </ul>
      </div><br />
    @endif
      <form method="post" action="{{ route('clients.update', $client->id) }}">
        @method('PATCH')
        @csrf
        <div class="form-group">
          <label for="name">Name:</label>
          <input type="text" class="form-control" name="name" value="{{ $client->name }}" />
        </div>
          <div class="form-group">
              <label for="surname">Surname:</label>
              <input type="text" class="form-control" name="surname" value="{{ $client->surname }}" />
          </div>
          <div class="form-group">
              <label for="email">Email:</label>
              <input type="text" class="form-control" name="email" value="{{ $client->email }}" />
          </div>
          <div class="form-group">
              <label for="password">Password:</label>
              <input type="password" class="form-control" autocomplete="new-password" name="password"  value="" />
          </div>
        <button type="submit" class="btn btn-primary">Update</button>
      </form>
  </div>
</div>
@endsection
