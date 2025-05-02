<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Favorites</title>
    <link href="{{asset('assets/css/bootstrap.css')}}" rel="stylesheet">
    <link href="{{asset('assets/css/favorites.css')}}" rel="stylesheet">

    <link rel="apple-touch-icon" sizes="180x180" href="{{asset('assets/favicon_io/chefshat.png')}}">
    <link rel="icon" type="image/png" sizes="32x32" href="{{asset('assets/favicon_io/chefshat.png')}}">
    <link rel="icon" type="image/png" sizes="16x16" href="{{asset('assets/favicon_io/chefshat.png')}}">
    <link rel="manifest" href="{{asset('assets/favicon_io/site.webmanifest')}}">

    <link rel="stylesheet"
        href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@24,400,0,0&icon_names=search" />
    <link rel="stylesheet"
        href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@24,400,0,0&icon_names=favorite" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
</head>
<body>
    <nav class="navbar  navbar-expand-lg">
        <div class="container-fluid">


            <div class="collapse navbar-collapse d-flex">
                
                <a class="col navbar-brand justify-content-center align-content-center text-center m-0" href="{{url('home')}}">
                    <img src="{{asset('assets/favicon_io/chefshat.png')}}" alt="" srcset="" width="32" height="32">
                    Local Cuisine
                </a>
                
                <div class="col navbar-nav d-flex justify-content-center align-content-center">
                    <a class="nav-link navBtn w-75 text-center" href="{{route('newBook')}}">+ Add Recipe</a>
                    <!-- <a class="nav-link navBtn d-flex justify-content-center p-2" href="{{url('favorites')}}"><i class="fa-solid fa-bookmark navBtn Icon"></i>Favorites</a> -->
                </div>

                <form action="{{url('home')}}" class="search col-5 justify-content-center align-content-center d-none">
                    <span class="search-icon fas fa-search"></span>
                    <input class="searchbox-input outline-0 border-0 ms-1" type="text" name="query" placeholder="Search..."
                        aria-label="Search">
                        <!-- <button type="submit">Search</button> -->
                </form>

                <div class="col navbar-nav d-flex justify-content-center align-content-center">
                    <!-- <a class="nav-link navBtn" href="{{route('newBook')}}">+ Add Recipe</a> -->
                    <a class="nav-link navBtn d-flex justify-content-center align-content-center p-2 w-75" href="{{url('favorites')}}"><i class="fa-solid fa-bookmark navBtn Icon"></i>Favorites</a>
                </div>

                <div class="col navbar-nav ms-auto justify-content-center align-content-center">
                    <li class="nav-item dropdown w-75">
                        <a class="nav-link dropdown-toggle text-center" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                            {{$get_userName}}
                        </a>
                        <ul class="dropdown-menu">
                            <li><a class="dropdown-item" href="{{route('userprofile')}}">Profile</a></li>
                            <li><form action="{{route('logout')}}" method="POST" style="display: inline;">
                                    @csrf
                                    <button type="submit" class="dropdown-item">Logout</button>
                                </form>
                            </li>
                            <li class="border-top"><a class="dropdown-item" href="{{route('about')}}">About Us</a></li>
                        </ul>
                    </li>
                </div>
            </div>
        </div>
    </nav>



    <div class="main">



        <!-- 2nd Container Vertical Scroll -->
        <div class="welcomeText mt-5">Favorites</div>
        <div class="container container-User d-flex" id="container2">

            <!-- Content container for cards -->
            @if (empty($favoritedBooks))
                <h1 class="message d-flex w-100">You have no favorite books.<br>Open a book and add one!.</h1>
            @else
                @foreach($favoritedBooks as $userData)
                    <div class="item book-item card" data-id="{{$userData['books']->id}}">
                        <img class="coverImg" src="{{ asset('storage/' . $userData['books']->coverImage) }}" alt="Cover Image">
                        <div class="info">
                            <a class="title">{{ $userData['books']->recipeTitle }}</a>
                            <a class="byText">By</a>
                            <p class="author">{{ $userData['username'] }}</p>
                            
                        </div>
                        <div class="rating">
                            <i class="fa-solid fa-star"></i>
                            <i class="fa-solid fa-star"></i>
                            <i class="fa-solid fa-star"></i>
                            <i class="fa-solid fa-star"></i>
                            <i class="fa-solid fa-star"></i>
                        </div>
                    </div>
                @endforeach
            @endif

        </div>
    </div>

    <script>
        document.querySelectorAll('.my-book').forEach(item => {
            item.addEventListener('click', function () {
                const bookId = this.getAttribute('data'); // Retrieve the book ID
                window.location.href = '{{ route('book.details', ['id' => '__ID__']) }}'.replace('__ID__', bookId);
            });
        });
    </script>
    
    <script>
        document.querySelectorAll('.book-item').forEach(item => {
            item.addEventListener('click', function () {
                const bookId = this.getAttribute('data-id'); // Retrieve the book ID
                window.location.href = '{{ route('book.details', ['id' => '__ID__']) }}'.replace('__ID__', bookId);
            });
        });
    </script>


    <script src="{{ asset('Asstts/any/js/projectjscript.js') }}"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz"
        crossorigin="anonymous"></script>
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