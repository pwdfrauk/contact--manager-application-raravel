@extends('Layout.app')
@section('content')
    <div class="container">
        <h1>Create Contact</h1>
        <hr>
        <div class="col-12 my-3">
            <a class="btn btn-info" href="{{route('contacts.index')}}">Back To List</a>
        </div>
        @if ($errors->any())
            <div class="alert alert-danger">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif
        <form method="POST" action="{{ route('contacts.store') }}">
            @csrf
            <label>Name:</label>
            <input type="text" name="name" value="{{ old('name') }}" required>

            <label>Email:</label>
            <input type="email" name="email" value="{{ old('email') }}" required>

            <label>Phone:</label>
            <input type="text" name="phone" value="{{ old('phone') }}">

            <label>Address:</label>
            <input type="text" name="address" value="{{ old('address') }}">

            <div class=" my-3">
                  <button class="btn btn-success" type="submit">Save</button>
            </div>
           
        </form>
    </div>
@endsection
