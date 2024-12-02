<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>LC Profile</title>
    <link href="{{asset('assets/css/bootstrap.css')}}" rel="stylesheet">
    <link href="{{asset('assets/css/newBook.css')}}" rel="stylesheet">

    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@24,400,0,0&icon_names=search" />
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons/font/bootstrap-icons.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">

</head>
<body>
    <nav class="navbar">
        <div class="container-fluid d-flex justify-content-between align-items-center">
            <span class="navbar-brand">
                <a class="navTitle">Local Cuisine</a>
            </span>
            <div class="search w-50 d-none">
                <span class="search-icon material-symbols-outlined">search</span>
                <input class="searchbox-input outline-0 border-0" style="background: #060C0F" type="search" placeholder="Search" aria-label="Search">
            </div>

            <div class="d-flex px-5">
                <div class="dropdown show">
                    <a class="custom-dropdown" href="#" role="link" id="dropdownMenuLink" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        {{$get_userName}}
                        <i class="ms-2 bi bi-chevron-down"></i>
                    </a>

                    <div class="dropdown-menu" aria-labelledby="dropdownMenuLink">
                        <a class="dropdown-item" href="{{route('userprofile')}}">Profile</a>
                        <form action="{{ route('logout') }}" method="POST" style="display: inline;">
                            @csrf
                            <button type="submit" class="dropdown-item">Logout</button>
                        </form>
                    </div>
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

            <h1 class="welcomeText">Create</h1>
            <div class="containerP">
                <form action="{{ route('newBook.create') }}" method="POST" enctype="multipart/form-data" id="myForm">
                    @csrf
                    <input name="userId" value="{{ $get_userId }}" class="d-none">
                    
                    <input name="recipeTitle" type="text" class="input-field-title" id="sourceInput" placeholder="Title" value="{{old('recipeTitle')}}" required>
                    
                    <textarea name="recipeIngridients" class="input-field-big mt-3" placeholder="Ingredients..." required>{{old('recipeIngridients')}}</textarea>
                    
                    <textarea name="recipeDescription" class="input-field-big mt-3" placeholder="Description/Instructions..." required>{{old('recipeDescription')}}</textarea>
                    
                    <div class="mb-3 mt-1">
                        <label for="formFile" class="form-label">Upload Cover Photo</label>
                        <input name="coverImage" class="input-field" type="file" id="formFile">
                    </div>

                    
                    <div class="d-flex justify-content-between">
                            <a type="cancel" class="btnCancel mt-3 text-decoration-none" href="{{url('home')}}">Cancel</a>
                            <button type="button" id="openModal" class="btnSub float-right mt-3">Publish</button>
                    </div>
                </form>
            </div>
        </div>

        <div class="column right">
            
            <h1 class="welcomeText">Preview</h1>
            
            <div class="container-User d-flex justify-content-center align-items-center">
                <div class="item book-item">
                    <img class="coverImg" id="imagePreview" src="{{ asset('assets/Images/default.jpg') }}" alt="Cover Image">
                    <div class="info">
                        <a class="title" id="targetInput">Title</a>
                        <a class="byText">By</a>
                        <p class="author">{{$get_userName}}</p>
                        
                    </div>
                    <div class="rating">
                        <i id="star" class="fa-solid fa-star"></i>
                        <i id="star" class="fa-solid fa-star"></i>
                        <i id="star" class="fa-solid fa-star"></i>
                        <i id="star" class="fa-solid fa-star"></i>
                        <i id="star" class="fa-solid fa-star"></i>
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
                    <button type="button" class="btnCancel" data-bs-dismiss="modal">Cancel</button>
                    <button type="button" class="btnSub" id="confirmSubmit">Publish it</button>
                </div>
            </div>
        </div>
    </div>


    <script src="{{ asset('assets/js/newBook.js') }}"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
</body>
</html>