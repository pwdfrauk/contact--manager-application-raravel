@extends('Layout.app')
@section('content')
    <div class="container">
        <h3>Edit Contact</h3>
        <hr>
        <div class="col-12 my-3">
            <a class="btn btn-info" href="{{route('contacts.index')}}">Back To List</a>
        </div>
        <form method="POST" action="{{ route('contacts.update', $contact->id) }}">
            @csrf
            @method('PUT')
            <label>Name:</label>
            <input type="text" name="name" value="{{ old('name', $contact->name) }}" required>

            <label>Email:</label>
            <input type="email" name="email" value="{{ old('email', $contact->email) }}" required>

            <label>Phone:</label>
            <input type="text" name="phone" value="{{ old('phone', $contact->phone) }}">

            <label>Address:</label>
            <input type="text" name="address" value="{{ old('address', $contact->address) }}">
            <br>
            <button class="btn btn-success mt-3" type="submit">Update</button>
        </form>
    </div>
@endsection
