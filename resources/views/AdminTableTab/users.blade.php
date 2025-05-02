@extends('Admin_Tabs.Tables')

@section('table-content')
    <div class="holder-table">
        <table class="table border-top-0">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Username</th>
                    <th>Email</th>
                    <th>User Type</th>
                    <th>Updated at</th>
                    <th>Created At</th>
                </tr>
            </thead>
            <tbody>
                @foreach($table_users as $user)
                    <tr>
                        <form action="{{ route('edit.admin') }}" method="POST" enctype="multipart/form-data" id="adminEdit">
                            @csrf
                            @method('PUT')

                            <td><input type="text" name="userId" class="editables" readonly value="{{ $user['id'] }}"></td>
                            <td><input type="text" name="username" class="editables inpt"  value="{{ $user['username'] }}"></td>
                            <td><input type="text" name="email" class="editables inpt"  value="{{ $user['email'] }}"></td>

                            <td>
                                @if ($user['user_type'] == 'admin')
                                    <i class="fa-solid fa-user-lock"></i>
                                    <b class="admin">{{ ucfirst($user['user_type']) }}</b>
                                @else
                                    <i class="fa-solid fa-user"></i>
                                    Regular
                                @endif
                            </td>

                            <td>{{ $user['updated_at'] }}</td>
                            <td>{{ $user['created_at'] }}</td>
                        </form>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
@endsection
