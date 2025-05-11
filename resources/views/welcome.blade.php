<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Local Cuisine</title>
    <meta name="route-tempate" content="{{ route('book.details', ['id' => '__ID__']) }}">
    <link href="{{asset('assets/css/bootstrap.css')}}" rel="stylesheet">
    <link href="{{asset('assets/css/welcome.css')}}" rel="stylesheet">

    <link rel="apple-touch-icon" sizes="180x180" href="{{asset('assets/favicon_io/chefshat.svg')}}">
    <link rel="icon" type="image/png" sizes="32x32" href="{{asset('assets/favicon_io/chefshat.svg')}}">
    <link rel="icon" type="image/png" sizes="16x16" href="{{asset('assets/favicon_io/chefshat.svg')}}">
    <link rel="manifest" href="{{asset('assets/favicon_io/site.webmanifest')}}">

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">

    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@11/dist/sweetalert2.min.css">
</head>

<body class="body">
    <nav class="navbar navbar-expand-lg">

        <div class="container-top-nav container-fluid">
            <div class="left-brand-container">
                <a class="navbar-brand" href="{{url('home')}}">
                    <img src="{{asset('assets/favicon_io/chefshat.svg')}}" alt="" srcset="" class="Icon" width="32"
                        height="32">
                    <div class="webname">
                        Local Cuisiness
                    </div>
                </a>
            </div>

            <div class="center-actions-container">
                <div class="left-center-action">
                </div>

                <div class="center-center-action">
                    <form action="{{route('welcome')}}" class="form-search">
                        <span class="search-icon fas fa-search"></span>
                        <input class="searchbox-input" type="search" name="query" placeholder="Search..."
                            aria-label="Search" value="{{ old('query', $query ?? '')}}">
                    </form>
                </div>

                <div class="right-center-action">
                </div>
            </div>

            <div class="right-dropdown-container dropdown">
                <a class="hidden_at_small_screen LRPage" href="{{url('registernewuser')}}">Login/Register</a>
                <button class="hidden_at_large_screen dropdown-toggle dropdown-toggle-button" data-bs-toggle="dropdown"
                    aria-expanded="false">
                    <i class="fa-solid fa-right-to-bracket Icon"></i>
                    <div class="username_hidden">Login/Register</div>
                </button>
                <ul class="dropdown-menu dropdown-menu-end">
                    <li><a class="dropdown-item" href="{{url('registernewuser')}}">Login/Register</a></li>
                    <li><a class="dropdown-item" href="{{route('about')}}">About Us</a></li>
                </ul>
            </div>
            
            <div class="right-dropdown-container dropdown hidden_at_small_screen">
                <div class="col">
                    <a class="about mx-3 d-inline" href="{{route('about')}}">About Us</a>
                </div>
            </div>
        </div>
    </nav>

    <div class="main">

        @if (session()->has('deleted'))
            <script>
                document.addEventListener('DOMContentLoaded', function() {
                    Swal.fire({
                        title: '{{ session('welcome') }}',
                        icon: 'success',
                        confirmButtonText: 'OK'
                    });
                });
            </script>
        @endif

        <img src="{{ asset('assets/Images/lc.png') }}" alt="Background Image" class="imageBg">



        <div class="main-search accordion-collapse collapse show"  id="searchCon">


            @if (trim($query) !== '')
                <div class="container-Search">
                    <h1 class="searchResultText">Search Results for "{{ $query }}":</h1>
                    <!-- <div class="line"></div> -->
                    <button class="clearBorderedBtn" data-bs-toggle="collapse" data-bs-target="#searchCon" type="button" aria-expanded="false" aria-controls="user_books">
                        <i class="fa-solid fa-xmark Icon"></i>
                        Clear
                    </button>
                    <div class="container-Search-Result"><!--style="background-color: blue"-->

                        @if($results->isEmpty())
                            <div class="col">
                                <div class="NoResult mb-3">No results found for {{ $query }}.</div>

                                <a class="btnClearFilter" href="{{url('/')}}"><i class="fa-solid fa-xmark"></i> Clear Search</a>
                            </div>
                        @else
                            @foreach($results as $book)
                                <div class="item book-item" data-id="{{ $book->id }}">
                                    <img class="coverImg" src="{{ asset('storage/' . $book->coverImage) }}" alt="Cover Image">
                                    <div class="info">
                                        <a class="title">{{ $book->recipeTitle }}</a>
                                        <a class="byText">By</a>
                                        <p class="author">
                                            {{ $book->username ?? 'Unknown Author' }}
                                        </p>
                                    </div>
                                    <div class="container-rating d-flex align-items-center px-2">

                                        @php
                                            $starsTotal = $book['starsCount'];
                                            $starsFull = floor($starsTotal);
                                            $starsHalf = ($starsTotal - $starsFull) > 0 ? true : false;
                                            $starsNum = number_format($book['starsCount'], 1);
                                        @endphp

                                        <!-- <h1 class="ratingText mb-0">Ratings: </h1> -->
                                        <div class="rating-owner d-flex d-inline">

                                            @for ($i = $starsTotal + 1; $i <= 5; $i++)
                                                <label for="Star" title="{{$starsNum}} stars"
                                                    class="fa-solid fa-star starRatedEmpty"></label>
                                            @endfor

                                            @if ($starsHalf)
                                                <label for="Star" title="{{$starsNum}} stars"
                                                    class="fa-solid fa-star-half-stroke starRated"></label>
                                            @endif

                                            @for ($i = 1; $i <= $starsTotal; $i++)
                                                <label for="Star" title="{{$starsNum}} stars"
                                                    class="fa-solid fa-star starRated"></label>
                                            @endfor


                                        </div>
                                        <h1 class="rates ms-2 mb-0 mt-1 starsNum">({{$starsNum}})</h1>
                                        <h1 class="rates ms-2 mb-0 mt-1 d-inline"> {{$book['ratings']}} Ratings</h1>
                                    </div>
                                </div>
                            @endforeach
                        @endif
                    </div>
                </div>
            @endif

        </div>

        <!-- 2nd Container Vertical Scroll -->
        <div class="main-home" id="containerView">
            <div class="header-home d-flex mt-5 align-items-center">

                @if ($category != null)
                    <div class="welcomeText d-flex categoryText">{{$category}}</div>
                @else
                    <div class="welcomeText d-flex">Home</div>
                @endif

                <div class="line"></div>

                <div class="navbar-nav justify-content-end align-content-center">
                    <li class="nav-item dropdown">
                        <button class="nav-link dropdown-toggle filter text-center px-2" href="#" role="button"
                            data-bs-toggle="dropdown" aria-expanded="false">
                            Filter
                            <i class="fa-solid fa-filter"></i>
                        </button>
                        <ul class="dropdown-menu dropdown-menu-end">
                            <li>
                                @if ($category != null)
                                    <a class="dropdown-item" href="{{url('/')}}"><i class="fa-solid fa-xmark"></i> Clear
                                        Filter</a>
                                @endif
                            </li>
                            <li><a class="dropdown-item"
                                    href="{{route('welcome', ['category' => 'Appetizers'])}} #containerView">Appetizers</a>
                            </li>
                            <li><a class="dropdown-item"
                                    href="{{route('welcome', ['category' => 'Side Dishes'])}} #containerView">Side
                                    Dishes</a></li>
                            <li><a class="dropdown-item"
                                    href="{{route('welcome', ['category' => 'Main Courses'])}} #containerView">Main
                                    Courses</a></li>
                            <li><a class="dropdown-item"
                                    href="{{route('welcome', ['category' => 'Desserts'])}} #containerView">Desserts</a>
                            </li>
                            <li><a class="dropdown-item"
                                    href="{{route('welcome', ['category' => 'Beverages'])}} #containerView">Beverages</a>
                            </li>
                            <li><a class="dropdown-item"
                                    href="{{route('welcome', ['category' => 'Soups'])}} #containerView">Soups</a>
                            </li>
                            <li><a class="dropdown-item"
                                    href="{{route('welcome', ['category' => 'Salads'])}} #containerView">Salads</a>
                            </li>
                            <li><a class="dropdown-item"
                                    href="{{route('welcome', ['category' => 'Breakfasts'])}} #containerView">Breakfasts</a>
                            </li>
                            <li><a class="dropdown-item"
                                    href="{{route('welcome', ['category' => 'Snacks'])}} #containerView">Snacks</a>
                            </li>
                            <li><a class="dropdown-item"
                                    href="{{route('welcome', ['category' => 'Bread and Pastries'])}} #containerView">Bread
                                    and Pastries</a></li>
                        </ul>
                    </li>
                </div>
            </div>



            @if ($category != null && $check == false)
                <div class="NoResult mb-3">No results for {{$category}}</div>
                <a class="clearBorderedBtn" href="{{url('/')}}"><i class="fa-solid fa-xmark"></i> Clear Filter</a>
            @endif

            <!-- Categorized Books -->
            <div class="container-User">

                @foreach($categorizedBooks as $book)
                    <div class="item book-item" data-id="{{ $book->id }}">
                        <img class="coverImg" src="{{ asset('storage/' . $book->coverImage) }}" alt="Cover Image">
                        <div class="info">
                            <a class="title">{{ $book->recipeTitle }}</a>
                            <!-- <a class="byText">By</a> -->
                            <p class="author">By {{ $book->username }}</p>

                        </div>
                        <div class="container-rating d-flex align-items-center px-2">

                            @php
                                $starsTotal = $book['starsCount'];
                                $starsFull = floor($starsTotal);
                                $starsHalf = ($starsTotal - $starsFull) > 0 ? true : false;
                                $starsNum = number_format($book['starsCount'], 1);
                            @endphp

                            <!-- <h1 class="ratingText mb-0">Ratings: </h1> -->
                            <div class="rating-owner d-flex d-inline">

                                @for ($i = $starsTotal + 1; $i <= 5; $i++)
                                    <label for="Star" title="{{$starsNum}} stars"
                                        class="fa-solid fa-star starRatedEmpty"></label>
                                @endfor

                                @if ($starsHalf)
                                    <label for="Star" title="{{$starsNum}} stars"
                                        class="fa-solid fa-star-half-stroke starRated"></label>
                                @endif

                                @for ($i = 1; $i <= $starsTotal; $i++)
                                    <label for="Star" title="{{$starsNum}} stars" class="fa-solid fa-star starRated"></label>
                                @endfor


                            </div>
                            <h1 class="rates ms-2 mb-0 mt-1 starsNum">({{$starsNum}})</h1>
                            <h1 class="rates ms-2 mb-0 mt-1 d-inline"> {{$book['ratings']}} Ratings</h1>
                        </div>
                    </div>
                @endforeach

            </div>


            <!-- General Items -->
            @if ($category == null)
                <div class="container-User">

                    <!-- Content container for cards -->

                    <!-- Recommendations -->
                    @foreach($recommendedBooks as $book)
                        <div class="item book-item" data-id="{{ $book->id }}">
                            <img class="coverImg" src="{{ asset('storage/' . $book->coverImage) }}" alt="Cover Image">
                            <div class="info">
                                <a class="title">{{ $book->recipeTitle }}</a>
                                <!-- <a class="byText">By</a> -->
                                <p class="author">By {{ $book->username }}</p>

                            </div>
                            <div class="container-rating d-flex align-items-center px-2">

                                @php
                                    $starsTotal = $book['starsCount'];
                                    $starsFull = floor($starsTotal);
                                    $starsHalf = ($starsTotal - $starsFull) > 0 ? true : false;
                                    $starsNum = number_format($book['starsCount'], 1);
                                @endphp

                                <!-- <h1 class="ratingText mb-0">Ratings: </h1> -->
                                <div class="rating-owner d-flex d-inline">

                                    @for ($i = $starsTotal + 1; $i <= 5; $i++)
                                        <label for="Star" title="{{$starsNum}} stars"
                                            class="fa-solid fa-star starRatedEmpty"></label>
                                    @endfor

                                    @if ($starsHalf)
                                        <label for="Star" title="{{$starsNum}} stars"
                                            class="fa-solid fa-star-half-stroke starRated"></label>
                                    @endif

                                    @for ($i = 1; $i <= $starsTotal; $i++)
                                        <label for="Star" title="{{$starsNum}} stars" class="fa-solid fa-star starRated"></label>
                                    @endfor


                                </div>
                                <h1 class="rates ms-2 mb-0 mt-1 starsNum">({{$starsNum}})</h1>
                                <h1 class="rates ms-2 mb-0 mt-1 d-inline"> {{$book['ratings']}} Ratings</h1>
                            </div>
                        </div>
                    @endforeach

                    <!-- All Books -->
                    @foreach($userWithBooks as $book)
                        <div class="item book-item" data-id="{{ $book->id }}">
                            <img class="coverImg" src="{{ asset('storage/' . $book->coverImage) }}" alt="Cover Image">
                            <div class="info">
                                <a class="title">{{ $book->recipeTitle }}</a>
                                <!-- <a class="byText">By</a> -->
                                <p class="author">By {{ $book->username }}</p>

                            </div>
                            <div class="container-rating d-flex align-items-center px-2">

                                @php
                                    $starsTotal = $book['starsCount'];
                                    $starsFull = floor($starsTotal);
                                    $starsHalf = ($starsTotal - $starsFull) > 0 ? true : false;
                                    $starsNum = number_format($book['starsCount'], 1);
                                @endphp

                                <!-- <h1 class="ratingText mb-0">Ratings: </h1> -->
                                <div class="rating-owner d-flex d-inline">

                                    @for ($i = $starsTotal + 1; $i <= 5; $i++)
                                        <label for="Star" title="{{$starsNum}} stars"
                                            class="fa-solid fa-star starRatedEmpty"></label>
                                    @endfor

                                    @if ($starsHalf)
                                        <label for="Star" title="{{$starsNum}} stars"
                                            class="fa-solid fa-star-half-stroke starRated"></label>
                                    @endif

                                    @for ($i = 1; $i <= $starsTotal; $i++)
                                        <label for="Star" title="{{$starsNum}} stars" class="fa-solid fa-star starRated"></label>
                                    @endfor


                                </div>
                                <h1 class="rates ms-2 mb-0 mt-1 starsNum">({{$starsNum}})</h1>
                                <h1 class="rates ms-2 mb-0 mt-1 d-inline"> {{$book['ratings']}} Ratings</h1>
                            </div>
                        </div>
                    @endforeach
                </div>
            @endif

        </div>
    </div>


    <script>

    </script>

    <script src="{{ asset('assets/js/welcome.js') }}"></script>
    <script src="{{ asset('assets/js/bookSelection.js') }}"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz"
        crossorigin="anonymous"></script>

    
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