<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>LC Profile</title>
    <link href="{{asset('assets/css/bootstrap.css')}}" rel="stylesheet">
    <link href="{{asset('assets/css/editBook.css')}}" rel="stylesheet">

    <link rel="apple-touch-icon" sizes="180x180" href="{{asset('assets/favicon_io/chefshat.png')}}">
    <link rel="icon" type="image/png" sizes="32x32" href="{{asset('assets/favicon_io/chefshat.png')}}">
    <link rel="icon" type="image/png" sizes="16x16" href="{{asset('assets/favicon_io/chefshat.png')}}">
    <link rel="manifest" href="{{asset('assets/favicon_io/site.webmanifest')}}">

    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@24,400,0,0&icon_names=search" />
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons/font/bootstrap-icons.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">

</head>
<body class="body">    
    <nav class="navbar  navbar-expand-lg">
        <div class="container-fluid">

            @if ($get_userName == 0)
                <a class="navbar-brand" href="{{url()->previous()}}">
                    <img src="{{asset('assets/favicon_io/chefshat.png')}}" alt="" srcset="" width="32" height="32">
                    Local Cuisine
                </a>
            @else
                <a class="navbar-brand" href="{{url('home')}}">
                    <img src="{{asset('assets/favicon_io/chefshat.png')}}" alt="" srcset="" width="32" height="32">
                    Local Cuisine
                </a>
            @endif

            <div class="collapse navbar-collapse d-flex">

                <div class="navbar-nav ms-auto">
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle text-center" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                            @if ($get_userName == 0) 
                                Guess User
                            @else
                                {{$get_userName}}                            
                            @endif
                        </a>
                        <ul class="dropdown-menu">
                            @if ($get_userName == 0)
                                <li><a class="dropdown-item" href="{{url('registernewuser')}}">Login/Register</a></li>
                                <li><a class="dropdown-item" href="{{route('about')}}">About Us</a></li>
                            @else
                                <li><a class="dropdown-item" href="{{route('userprofile')}}">Profile</a></li>
                                <li><form action="{{route('logout')}}" method="POST" style="display: inline;">
                                        @csrf
                                        <button type="submit" class="dropdown-item">Logout</button>
                                    </form>
                                </li>
                                <li class="border-top"><a class="dropdown-item" href="{{route('about')}}">About Us</a></li>
                            @endif
                        </ul>
                    </li>
                </div>
            </div>
        </div>
    </nav>




    <div class="main">
        <div class="column left">

            @if ($errors->any())
                <div class="alert alert-danger floating-alert">
                    <ul>
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <h1 class="welcomeText">Edit</h1>
            <div class="containerP">
                <form action="{{ route('editBook.update', $book->id) }}" method="POST" enctype="multipart/form-data" id="myForm">
                    @csrf
                    @method('PUT')
                    <input name="userId" value="{{ $get_userId }}" class="d-none">
                    
                    <div class="required">
                        <input name="recipeTitle" type="text" class="input-field-title" id="sourceInput" placeholder="Title" value="{{$book->recipeTitle}}" required>
                    </div>

                    <div class="mt-3">
                        <select name="recipeCategory" class="form-control input-field-category">
                            <option value="" disabled>Category</option>
                            <option value="Appetizers" {{ $book->recipeCategory == 'Appetizers' ? 'selected' : '' }}>Appetizers</option>
                            <option value="Side Dishes" {{ $book->recipeCategory == 'Side Dishes' ? 'selected' : '' }}>Side Dishes</option>
                            <option value="Main Courses" {{ $book->recipeCategory == 'Main Courses' ? 'selected' : '' }}>Main Courses</option>
                            <option value="Desserts" {{ $book->recipeCategory == 'Desserts' ? 'selected' : '' }}>Desserts</option>
                            <option value="Beverages" {{ $book->recipeCategory == 'Beverages' ? 'selected' : '' }}>Beverages</option>
                            <option value="Soups" {{ $book->recipeCategory == 'Soups' ? 'selected' : '' }}>Soups</option>
                            <option value="Salads" {{ $book->recipeCategory == 'Salads' ? 'selected' : '' }}>Salads</option>
                            <option value="Breakfasts" {{ $book->recipeCategory == 'Breakfasts' ? 'selected' : '' }}>Breakfasts</option>
                            <option value="Snacks" {{ $book->recipeCategory == 'Snacks' ? 'selected' : '' }}>Snacks</option>
                            <option value="Bread and Pastries" {{ $book->recipeCategory == 'Bread and Pastries' ? 'selected' : '' }}>Bread and Pastries</option>
                        </select>
                    </div>
                    
                    <div class="mt-3">
                        <textarea name="recipeIngridients" class="input-field-big" placeholder="Ingredients..." required>{{$book->recipeIngridients}}</textarea>
                    </div>

                    <div class="mt-3">
                        <textarea name="recipeDescription" class="input-field-big" placeholder="Description/Instructions..." required>{{$book->recipeDescription}}</textarea>
                    </div>
                    
                    <div class="mt-1">
                        <label for="formFile" class="form-label mb-0">Recipe Origin</label>
                        <input name="recipeOrigin" type="text" class="input-field-category" id="sourceInput" placeholder="Recipe Origin" value="{{$book->recipeOrigin}}" required>
                    </div>

                    <div class="mb-3 mt-1">
                        <label for="formFile" class="form-label mb-0">Upload Cover Photo</label>
                        <input name="coverImage" class="input-field" type="file" id="formFile">
                    </div>

                    
                    <div class="d-flex justify-content-end mt-3">
                            <a type="cancel"" class="btnCancel me-3 text-decoration-none text-center" href="{{url()->previous()}}">Cancel</a>
                            <button type="button" id="openModal" class="btnSub float-right">Save</button>
                    </div>
                </form>
                <form action="{{ route('deleteBook', $book->id) }}" method="POST" id="deleteBook">
                    @csrf
                    @method('DELETE')
                    <button type="button" id="openModalD" class="btnDelete">Delete</button>
                </form>
            </div>
        </div>

        <div class="column right">
            
            <h1 class="welcomeText">Preview</h1>
            
            <div class="container-User d-flex justify-content-center align-items-center">
                <div class="item book-item">
                    <img class="coverImg" id="imagePreview" src="{{ asset('storage/' . $book->coverImage) }}" alt="Cover Image">
                    <div class="info">
                        <a class="title" id="targetInput">{{$book->recipeTitle}}</a>
                        <a class="byText">By</a>
                        <p class="author d-inline">{{$get_userName}}</p>
                        
                    </div>
                    <div class="container-rating d-flex align-items-center px-2">
                        <div class="rating-owner">
                            <i id="star" class="fa-solid fa-star starRated"></i>
                            <i id="star" class="fa-solid fa-star starRated"></i>
                            <i id="star" class="fa-solid fa-star starRated"></i>
                            <i id="star" class="fa-solid fa-star starRated"></i>
                            <i id="star" class="fa-solid fa-star starRated"></i>
                        </div>
                        <h1 class="rates ms-2 mb-0 mt-1 starsNum">(0)</h1>
                        <h1 class="rates ms-2 mb-0 mt-1 d-inline"> 0 Ratings</h1>
                    </div>
                </div>
            </div>

        </div>
    </div>

    <div class="modal fade" id="confirmationModal" tabindex="-1" aria-labelledby="modalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="modalLabel">Confirm Submission</h5>
                </div>
                <div class="modal-body">
                    Are you sure you want to publish this form?
                </div>
                <div class="modal-footer">
                    <button type="button" class="btnCancel" id="btnCancelModal" data-bs-dismiss="modal">Cancel</button>
                    <button type="button" class="btnSub" id="confirmSubmit">Save</button>
                </div>
            </div>
        </div>
    </div>

    <div class="modal fade" id="confirmationModalD" tabindex="-1" aria-labelledby="modalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="modalLabelD">Delete Book</h5>
                    </div>
                    <div class="modal-body">
                        Are you sure you want to Delete this Book?
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btnCancel" id="btnCancelModal data-bs-dismiss="modal">Cancel</button>
                        <button type="button" class="btnSub" id="confirmDelete">Yes</button>
                    </div>
                </div>
            </div>
        </div>

    <script src="{{ asset('assets/js/newBook.js') }}"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
</body>

<footer>
    <hr class="footerLine">
    <div class="footer">
        <div class="container-fluid d-flex justify-content-center align-items-center">
            <a class="col navbar-brand justify-content-center align-content-center text-center m-0" href="{{url('/')}}">
                <img src="{{asset('assets/favicon_io/chefshat.png')}}" alt="" srcset="" class="Icon" width="32" height="32">
                Local Cuisine
            </a>
        </div>
    </div>
    <div class="footerText">
        <p>© 2025 Local Cuisine. All rights reserved.</p>
        <div class="footerAcknowledgment">
            <p>Designed by <a href="" target="_blank">Team ACIM</a></p>
            <p>Powered by <a href="https://laravel.com/" target="_blank">Laravel</a></p>
            <p>Icons by <a href="https://fontawesome.com/" target="_blank">Font Awesome</a></p>
        </div>
    </div>
</footer>
</html>