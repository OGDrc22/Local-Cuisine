@extends('Admin_Tabs.Tables')

@section('table-content')
    <div class="holder-table">
        <table class="table border-top-0">
            <thead>
                <tr>
                    <th>Creator</th>
                    <th>Book ID</th>
                    <th>Category</th>
                    <th>Title</th>
                    <th>Ingridients</th>
                    <th>Description</th>
                    <th>Cover Image</th>
                    <th>Ratings</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($table_books as $book_table)
                
                    @php
                        $stars = $book_table['starsCount'];
                        $starsTotal = number_format($stars,  1)
                    @endphp


                    
                    <tr class="stripe">
                        <form action="{{ route('edit.admin') }}" method="POST" enctype="multipart/form-data" id="adminEdit">
                            @csrf
                            @method('PUT')
                            
                            <div><input type="hidden" name="userId" value="{{$book_table['userId']}}"></div>
                            <td><input type="text" name="username" class="editables inpt" value="{{$book_table['username']}}"></td>

                            <td class="col-1"><input type="text" name="book_id" class="editables inpt"  value="{{$book_table['id']}}"></td>
                            <td><input type="text" name="recipeCategory" class="editables-long inpt" required readonly value="{{$book_table['recipeCategory']}}"></td>
                            <td><input type="text" name="recipeTitle" class="editables-long inpt" required readonly value="{{$book_table['recipeTitle']}}"></td>
                            <td class="col-3"><textarea name="recipeIngridients" class="input-field-big" placeholder="Description/Instructions..." required readonly>{{$book_table['recipeIngridients']}}</textarea></td>
                            <td class="col-3"><textarea name="recipeDescription" class="input-field-big" placeholder="Description/Instructions..." required readonly>{{$book_table['recipeDescription']}}</textarea></td>
                            <td>
                                <img name="coverImage" class="coverImgAdmin" src="{{ asset('storage/' . $book_table['coverImage']) }}" alt="Cover Image">
                            </td>
                            <td>
                                <p title="{{$stars}}"><i class="fa-solid fa-star starRated"></i> {{$starsTotal}}</p>
                                <p>({{$book_table['ratings']}}) Rates</p>
                            </td>
                        </form>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
@endsection
