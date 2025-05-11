<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ $book->recipeTitle }}</title>
    <link href="{{asset('assets/css/bootstrap.css')}}" rel="stylesheet">
    <link href="{{asset('assets/css/newBook.css')}}" rel="stylesheet">

    <link rel="apple-touch-icon" sizes="180x180" href="{{asset('assets/favicon_io/chefshat.png')}}">
    <link rel="icon" type="image/png" sizes="32x32" href="{{asset('assets/favicon_io/chefshat.png')}}">
    <link rel="icon" type="image/png" sizes="16x16" href="{{asset('assets/favicon_io/chefshat.png')}}">
    <link rel="manifest" href="{{asset('assets/favicon_io/site.webmanifest')}}">

    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@24,400,0,0&icon_names=search" />
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons/font/bootstrap-icons.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">

    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@11/dist/sweetalert2.min.css">

</head>
<body class="body">
    <nav class="navbar navbar-expand-lg">

        <div class="container-top-nav container-fluid">
            <div class="left-brand-container">
                <a class="navbar-brand" href="{{url('home')}}">
                    <img src="{{asset('assets/favicon_io/chefshat.svg')}}" alt="" srcset="" class="Icon" width="32" height="32">
                    <div class="webname hide-at-small-screen">
                        Local Cuisine
                    </div>
                    <div class="webname navBarActions_dropdown">
                        Edit Book
                    </div>
                </a>
            </div>

            <div class="center-actions-container">
                <div class="left-center-action">
                </div>

                <div class="center-center-action">
                </div>

                <div class="right-center-action">
                </div>
            </div>

            <div class="right-dropdown-container dropdown">
                <button class="dropdown-toggle dropdown-toggle-button d-flex" data-bs-toggle="dropdown" aria-expanded="false">
                    <i class="user-nav-icon fa-solid fa-circle-user"></i>
                    <div class="username_hidden">{{$get_userName}}</div>
                </button>
                <ul class="dropdown-menu dropdown-menu-end">
                    <li><form action="{{route('logout')}}" method="POST" style="display: inline;">
                            @csrf
                            <button type="submit" class="dropdown-item">Logout</button>
                        </form>
                    </li>
                    <li class="border-top"><a class="dropdown-item" href="{{route('about')}}">About Us</a></li>
                </ul>
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

            <h1 class="welcomeText hide-at-small-screen">Create</h1>
            <div class="container-form">
                <form action="{{ route('editBook.update', $book->id) }}" method="POST" enctype="multipart/form-data" id="myForm">
                    @csrf
                    @method('PUT')
                    <input name="userId" value="{{ $get_userId }}" class="d-none">
                    
                    <div class="required">
                        <input name="recipeTitle" type="text" class="input-field-title" id="sourceInput" placeholder="Title" value="{{$book->recipeTitle}}" required>
                    </div>

                    <div class="form-group mt-2">
                        <div class="row-form">
                            <div class="form-group mt-3">
                                <div class="nav-item dropdownCategory">
                                    <a class="input-field form-control selected" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                                        {{ $book->recipeCategory ?? 'Select Category' }}
                                        <input type="checkbox" class="dropdown-toggle check-boxA">
                                    </a>
                                    <ul class="dropdown-menu dropdown-menuCategory">
                                        <li class="dropdown-item" data-value="Appetizers">Appetizers</li> 
                                        <li class="dropdown-item" data-value="Side Dishes">Side Dishes</li> 
                                        <li class="dropdown-item" data-value="Main Courses">Main Courses</li> 
                                        <li class="dropdown-item" data-value="Desserts">Desserts</li> 
                                        <li class="dropdown-item" data-value="Beverages">Beverages</li> 
                                        <li class="dropdown-item" data-value="Soups">Soups</li> 
                                        <li class="dropdown-item" data-value="Salads">Salads</li> 
                                        <li class="dropdown-item" data-value="Breakfasts">Breakfasts</li> 
                                        <li class="dropdown-item" data-value="Snacks">Snacks</li> 
                                        <li class="dropdown-item" data-value="Bread and Pastries">Bread and Pastries</li>
                                    </ul>
                                </div>
                            
                            </div>

                        </div>
                    </div>

                    <div class="mt-3">
                        <select name="recipeCategory" class="form-control input-field-category d-none">
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


                    <div class="container-User justify-content-center align-items-center navBarActions_dropdown">
                        <div class="item book-item">
                            <img class="coverImg" id="imagePreview" src="{{ asset('storage/' . $book->coverImage) }}" alt="Cover Image">
                            <div class="info">
                                <a class="title" id="targetInput">{{ $book->recipeTitle }}</a>
                                <a class="byText">By</a>
                                <p class="author d-inline">{{$get_userName}}</p>
                                
                            </div>
                            <div class="container-rating d-flex align-items-center px-2">
                                <div class="rating">
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

        <div class="column right hide-at-small-screen">
            
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


    <script src="{{ asset('assets/js/newBook.js') }}"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11/dist/sweetalert2.all.min.js"></script>
</body>

<footer>
    <hr class="footerLine">
    <div class="footer">
        <div class="container-fluid d-flex justify-content-center align-items-center">
            <a class="col navbar-brand justify-content-center align-content-center text-center m-0" href="{{url('/')}}">
                <img src="{{asset('assets/favicon_io/chefshat.svg')}}" alt="" srcset="" class="Icon" width="32" height="32">
                Local Cuisine
            </a>
        </div>
    </div>
    <div class="footerText">
        <p>© 2025 Local Cuisine. All rights reserved.</p>
        <div class="footerAcknowledgment">
            <a href="" target="">
                <img src="{{ asset('assets/Images/ACIM.svg') }}" height="48">
            </a>
            <a href="https://laravel.com/">
                <img src="{{ asset('assets/Images/laravel.svg') }}" height="48">
            </a>
            <a href="https://fontawesome.com/" target="_blank">
                <img src="{{ asset(('assets/Images/fontawesome.svg')) }}" height="48">
            </a>
        </div>
    </div>
</footer>
</html>