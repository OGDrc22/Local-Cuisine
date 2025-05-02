@extends('Admin_Tabs.Tables')
@section('table-content')
    <div class="holder-table">
        <table class="table border-top-0">
            <thead>
                <tr>
                    <!-- <th>ID</th> -->
                    <th>Username</th>
                    <th>Email</th>
                    <th>Books Created</th>
                    <!-- <th>Action</th> -->
                </tr>
            </thead>
            <tbody>

                @foreach($table_overview as $user)

                    <tr>
                        
                        <form action="{{ route('edit.admin') }}" method="POST" enctype="multipart/form-data" id="adminEdit">
                            @csrf
                            @method('PUT')

                            <div><input type="hidden" name="userId" value="{{ $user['id']}}"></div>
                            <td><input type="text" name="username" class="inpt editables" value="{{ $user['username'] }}"></td>
                            <td><input type="text" name="email" class="inpt editables" value="{{ $user['email'] }}"></td>

                            
                            <td>
                                <button type="submit">Save</button>
                            </td>
                        </form>

                            <td class="px-0 py-1">
                                <table class="table table2nd">
                                    <thead>
                                        @php
                                            $books_count = count($user['created_books'])
                                        @endphp
                                        <tr>
                                            <th><i class="fa-solid fa-book-open"></i> {{$books_count}}</th>
                                            <th><i class="fa-solid fa-tag"></i> Category</th>
                                            <th><i class="fa-solid fa-star starRatedTitle"></i> Ratings</th>
                                            <th><i class="fa-solid fa-user"></i> Rate</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach($user['created_books'] as $book_detail)
                                            @php
                                                $stars = $book_detail['starsCount'];
                                                $starsTotal = number_format($stars, 1)
                                            @endphp
                                            <tr>
                                                <form action="{{ route('edit.admin') }}" method="POST" enctype="multipart/form-data">
                                                    @csrf
                                                    @method('PUT')

                                                    <input type="hidden" name="book_id" value="{{ $book_detail['book_id']}}">
                                                    
                                                    <textarea type="hidden" name="recipeIngridients" class="input-field-big d-none" placeholder="Description/Instructions..." required readonly>{{$book_detail['recipeIngridients']}}</textarea>
                                                    <textarea type="hidden" name="recipeDescription" class="input-field-big d-none" placeholder="Description/Instructions..." required readonly>{{$book_detail['recipeDescription']}}</textarea>
                                                    
                                                    <td class="col-1"><input type="text" name="recipeTitle" class="inpt editables" value="{{ $book_detail['recipeTitle'] }}"></td>
                                                    <td class="col-1"><input type="text" name="recipeCategory" class="inpt editables" value="{{ $book_detail['recipeCategory'] }}"></td>
                                                    <td class="col-1" title="{{ $stars }}"><i class="fa-solid fa-star starRated"></i> <input type="text" class="inpt editables editables-short" value="{{ $starsTotal }}"></td>
                                                    <td class="col-1">{{ $book_detail['ratings'] }} <i class="fa-solid fa-user"></i></td>
                                                    <td class="col-1">
                                                        <button type="submit">Save</button>
                                                    </td>
                                                </form>
                                            </tr>
                                        @endforeach
                                        
                                    </tbody>
                                </table>
                            </td>
                    </tr>

                @endforeach
            </tbody>
        </table>
    </div>
@endsection