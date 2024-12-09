<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{$book->recipeTitle}}</title>
    <link href="{{asset('assets/css/bootstrap.css')}}" rel="stylesheet">
    <link href="{{asset('assets/css/openBook.css')}}" rel="stylesheet">

    <link rel="stylesheet"
        href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@24,400,0,0&icon_names=search" />
    <link rel="stylesheet"
        href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@24,400,0,0&icon_names=favorite" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">

<body class="body">
    <nav class="navbar  navbar-expand-lg">
        <div class="container-fluid">

            @if ($get_userName == 0)
                <a class="navbar-brand" href="{{url('welcome')}}">Local Cuisine</a>
            @else
                <a class="navbar-brand" href="{{url('home')}}">Local Cuisine</a>
            @endif

            <div class="collapse navbar-collapse d-flex">
                @if ($get_userId != 0)
                    <div class="navbar-nav d-flex">
                        <a class="nav-link me-2" href="{{route('newBook')}}">+ Add Recipe</a>
                        <a class="nav-link me-2 navBtn d-flex justify-content-center p-2" href="{{url('favorites')}}"><i class="fa-solid fa-heart navBtn Icon"></i>Favorites</a>
                    </div>
                @endif

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


    <!-- Main Container -->
    <div class="main">
        <div class="alert alert-success floating-alert d-none" role="alert">
            A simple success alert—check it out!
        </div>
        <!-- Changed: Used Bootstrap grid system (row and columns) to structure layout -->

        <div class="row m-0 p-0">
            <img class="coverImg" src="{{ asset('storage/' . $book->coverImage) }}" alt="Cover Image">
        </div>

        <div class="container-info">
            <div class="row">
                <!-- Left column: Title of your Recipe -->
                <div class="col me-3">
                    <div class="viewTextTitle d-flex align-items-center">
                        <p type="text" class="Title m-0">{{$book->recipeTitle}}</p>
                    </div>

                    <!-- Ingredients -->
                    <div class="form-floating mt-2">
                        <p class="desc">Ingridients:</p>
                        <p class="viewTextI viewText" placeholder="Ingredients" id="txtA1" readonly>{{$book->recipeIngridients}}</p>
                    </div>
                </div>



                <div class="col ms-3">

                    <div class="d-flex justify-content-between align-items-center editContainer">

                        <p class="ownerText align-self-center ps-0">By {{$ownerName}}</p>

                        <div class="d-flex justify-content-end align-items-center">
                            @if ($bookFav)
                                <form id="removeFavForm" action="/remove_favorite" method="POST">
                                    @csrf
                                    <div class="container-form">
                                        <input name="userId" class="d-none" value="{{$get_userId}}">
                                        <input name="bookId" class="d-none" value="{{$book->id}}">
                                    </div>
                                    <button class="addBtn2 text-decoration-none text-center" type="submit">
                                        <i class="fa-solid fa-heart Icon"></i>
                                        Favorites
                                    </button> 
                                </form>
                            @else
                                @if ($get_userName != 0)
                                    <form id="addFavForm" action="/add_favorite" method="POST">
                                        @csrf
                                        <div class="container-form">
                                            <input name="userId" class="d-none" value="{{$get_userId}}">
                                            <input name="bookId" class="d-none" value="{{$book->id}}">
                                        </div>
                                        <button class="addBtn text-decoration-none text-center" type="submit">
                                            <i class="fa-regular fa-heart Icon"></i>
                                            Favorites
                                        </button> 
                                    </form>
                                @endif
                            @endif


                            @if ($isOwner) 
                                <a href="{{route('editBook.edit', $book->id)}}" class="btnEdit text-decoration-none text-center ms-3">Edit</a>    
                            @endif
                        </div>

                    </div>

                    <div class="form-floating mt-2 mb-5">
                    <p class="desc">Description:</p>
                        <p class="viewTextD viewText" placeholder="Description" id="txtA2" readonly>{{$book->recipeDescription}}</p>
                    </div>
                </div>

            </div>
        </div>

    </div>

</div>



    <script src="{{ asset('assets/js/openBook.js') }}"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz"
        crossorigin="anonymous"></script>
</body>

</html>