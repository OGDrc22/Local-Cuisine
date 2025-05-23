<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Favorites</title>
    <meta name="route-tempate" content="{{ route('book.details', ['id' => '__ID__']) }}">
    <link href="{{asset('assets/css/bootstrap.css')}}" rel="stylesheet">
    <link href="{{asset('assets/css/favorites.css')}}" rel="stylesheet">

    <link rel="apple-touch-icon" sizes="180x180" href="{{asset('assets/favicon_io/chefshat.svg')}}">
    <link rel="icon" type="image/png" sizes="32x32" href="{{asset('assets/favicon_io/chefshat.svg')}}">
    <link rel="icon" type="image/png" sizes="16x16" href="{{asset('assets/favicon_io/chefshat.svg')}}">
    <link rel="manifest" href="{{asset('assets/favicon_io/site.webmanifest')}}">

    <link rel="stylesheet"
        href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@24,400,0,0&icon_names=search" />
    <link rel="stylesheet"
        href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@24,400,0,0&icon_names=favorite" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
</head>
<body>
    <nav class="navbar navbar-expand-lg">

        <div class="container-top-nav container-fluid">
            <div class="left-brand-container">
                <a class="navbar-brand" href="{{url('home')}}">
                    <img src="{{asset('assets/favicon_io/chefshat.svg')}}" alt="" srcset="" class="Icon" width="32" height="32">
                    <div class="webname">
                        Local Cuisine
                    </div>
                </a>
            </div>

            <div class="center-actions-container">
                <div class="left-center-action">
                    <a class="nav-link" href="{{route('newBook')}}"><i class="fa-solid fa-circle-plus"></i> Add Recipe</a>
                </div>

                <div class="center-center-action">
                    
                </div>

                <div class="right-center-action">
                    <a class="nav-link" href="{{url('favorites')}}"><i class="fa-solid fa-bookmark navBtn Icon"></i>Favorites</a>
                </div>
            </div>

            <div class="right-dropdown-container dropdown">
                <button class="dropdown-toggle dropdown-toggle-button d-flex" data-bs-toggle="dropdown" aria-expanded="false">
                    @if ($get_profilepic == null)
                        <i class="user-nav-icon fa-solid fa-circle-user"></i>
                    @else
                        <img src="{{ asset('storage/profilepics/' . ($get_profilepic)) }}" class="user-nav-icon-img" id="current-profile-pic" alt="Profile Picture">                
                    @endif
                    <div class="username_hidden">{{$get_userName}}</div>
                </button>
                <ul class="dropdown-menu dropdown-menu-end">
                    <li><a class="navBarActions_dropdown dropdown-item" href="{{route('newBook')}}">Add Recipe</a></li>
                    <li><a class="navBarActions_dropdown dropdown-item" href="{{url('favorites')}}"></i>Favorites</a></li>
                    <li><a class="dropdown-item" href="{{route('userprofile')}}">Profile</a></li>
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



        <!-- 2nd Container Vertical Scroll -->
        <div class="welcomeText hide-at-small-screen">Favorites</div>
        

            <!-- Content container for cards -->
            @if (empty($favoritedBooks))
                <h1 class="message d-flex">You have no favorite books.<br>Open a book and add one!.</h1>
            @else
                <div class="container-User" id="container2"></div>
                    @foreach($favoritedBooks as $userData)
                        <div class="item book-item" data-id="{{$userData['books']->id}}">
                            <img class="coverImg" src="{{ asset('storage/' . $userData['books']->coverImage) }}" alt="Cover Image">
                            <div class="info">
                                <a class="title">{{ $userData['books']->recipeTitle }}</a>
                                <a class="byText">By</a>
                                <p class="author">{{ $userData['username'] }}</p>
                                
                            </div>
                            <div class="recommended">
                                <div class="container-rating d-flex align-items-center px-2">

                                    @php
                                        $starsTotal = $userData['starsCount'];
                                        $starsFull = floor($starsTotal);
                                        $starsHalf = ($starsTotal - $starsFull) > 0 ? true : false;
                                        $starsNum = number_format($userData['starsCount'], 1);
                                    @endphp

                                    <!-- <h1 class="ratingText mb-0">Ratings: </h1> -->
                                    <div class="rating-owner d-flex d-inline">
                                        
                                        @for ($i = $starsTotal+1; $i <= 5; $i++)
                                            <label for="Star" title="{{$starsNum}} stars" class="fa-solid fa-star starRatedEmpty"></label>                     
                                        @endfor

                                        @if ($starsHalf)
                                            <label for="Star" title="{{$starsNum}} stars" class="fa-solid fa-star-half-stroke starRated"></label>
                                        @endif

                                        @for ($i = 1; $i <= $starsTotal; $i++)
                                            <label for="Star" title="{{$starsNum}} stars" class="fa-solid fa-star starRated"></label>
                                        @endfor
                                        
                                        
                                    </div>
                                        <h1 class="rates ms-2 mb-0 mt-1 starsNum">({{$starsNum}})</h1>
                                        <h1 class="rates ms-2 mb-0 mt-1 d-inline"> {{$userData['ratingsCount']}} Ratings</h1>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
            @endif

    </div>


    <script src="{{ asset('assets/js/bookSelection.js') }}"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz"
        crossorigin="anonymous"></script>
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