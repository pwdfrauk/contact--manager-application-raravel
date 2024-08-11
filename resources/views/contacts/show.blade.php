@extends('Layout.app')
@section('content')
    <div class="container">
        <h3>View Contact Details</h3>
        <hr>
        
        <div class="row">
            <div class="col-4">
                <div class="card shadow mb-4">
                    <div class="card-body">
                        <h4 class="text-uppercase">{{ old('name', $contact->name) }}</h4>
                        <p>Phone:{{ old('phone', $contact->phone) }} </p>
                        <p>Email:{{ old('phone', $contact->email) }} </p>
                        <p>Address:{{ old('phone', $contact->address) }} </p>
                    </div>
                    <div class="card-footer text-end">
                        <a class="btn btn-info me-3" href="{{route('contacts.index')}}">Back</a>
                        <form action="{{ route('contacts.destroy', $contact->id) }}" method="POST" style="display:inline;">
                            @csrf
                            @method('DELETE')
                            <button class="btn btn-danger ms-2" type="submit">Delete</button>
                        </form>
                                
                    </div>
                </div>
                
            </div>
        </div>
        <!-- <form method="POST" action="{{ route('contacts.update', $contact->id) }}">
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
          utton class="btn btn-success mt-3" type="submit">Update</button>
        </form> -->
    </div>
@endsection
