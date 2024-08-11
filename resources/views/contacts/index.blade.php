@extends('Layout.app')
@section('content')
    <div class="container p-5 ">
        <div class="col-12 mb-2">
            <a class="btn btn-primary" href="{{ route('contacts.create') }}">Add New Contact</a>
        </div>

        <form method="GET" action="{{ route('contacts.index') }}">
            <input type="text" name="search" placeholder="Search by name or email" value="{{ request('search') }}">
            <button type="submit" class="btn btn-info">Search</button>
        </form>

        <div class="col-12 mt-3">
            <table class="table table-bordered">
                <thead>
                    <tr>
                        <th>SN</th>
                        <th>
                            <a href="{{ route('contacts.index', ['sort_by' => 'name']) }}">
                                Name
                            </a>
                        </th>
                        <th>Phone</th>
                        <th>
                            <a href="{{ route('contacts.index', ['sort_by' => 'email']) }}">
                                Email
                            </a>
                        </th>
                        <th>Address</th>
                        <th>
                            <a href="{{ route('contacts.index', ['sort_by' => 'created_at']) }}">
                                Created At
                            </a>
                        </th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($contacts as $contact)
                        <tr>
                            <td>{{ $loop->iteration }}</td>
                            <td>{{ $contact->name }}</td>
                            <td>{{ $contact->phone }}</td>
                            <td>{{ $contact->email }}</td>
                            <td>{{ $contact->address }}</td>
                            <td>{{ $contact->created_at }}</td>
                            <td>
                                <a class="btn btn-primary" href="{{ route('contacts.edit', $contact->id) }}">Edit</a>
                                <a class="btn btn-info" href="{{ route('contacts.show', $contact->id) }}">View</a>
                                <form action="{{ route('contacts.destroy', $contact->id) }}" method="POST" style="display:inline;">
                                    @csrf
                                    @method('DELETE')
                                    <button class="btn btn-danger ms-2" type="submit">Delete</button>
                                </form>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
@endsection
