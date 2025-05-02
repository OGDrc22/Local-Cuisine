@extends('admin_dashboard')
@section('main-content')
    <main class="tableMain m-5 mx-2" id="table_view">
        <div class="d-flex justify-content-between">
            <ul class="tablesDB nav nav-tabs border-bottom-0 pt-2">
                <li class="nav-item text-center {{request()->is('home/tables/overview') || request()->is('home') ? 'active' : ''}}">
                    <a class="nav-link {{request()->is('home/tables/overview') || request()->is('home') ? 'active' : ''}}" href="{{route('home.tables.overview')}}">Overview</a>
                </li>
                <li class="nav-item text-center {{request()->is('home/tables/users') ? 'active' : ''}}">
                    <a class="nav-link {{request()->is('home/tables/users') ? 'active' : ''}}" href="{{route('home.tables.users')}}">Users</a>
                </li>
                <li class="nav-item text-center {{request()->is('home/tables/books') ? 'active' : ''}}">
                    <a class="nav-link {{request()->is('home/tables/books') ? 'active' : ''}}" href="{{route('home.tables.books')}}">Books</a>
                </li>
                <li class="nav-item text-center {{request()->is('home/tables/ratings') ? 'active' : ''}}">
                    <a class="nav-link {{request()->is('home/tables/ratings') ? 'active' : ''}}" href="{{route('home.tables.ratings')}}">Ratings</a>
                </li>
            </ul>

            <div class="d-flex d-inline p-2 actionAdmin">
                <button class="me-2 btn btn-secondary btnAdminCancel" disabled>Cancel</button>
                <button type="button" id="openModal" class="btn btn-primary btnAdminSub" disabled>Save</button>
            </div>
        </div>
        @yield('table-content')
    </main>
@endsection