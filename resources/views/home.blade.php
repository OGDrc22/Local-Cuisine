<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Home</title>
    <meta name="route-tempate" content="{{ route('book.details', ['id' => '__ID__']) }}">
    <link href="{{asset('assets/css/bootstrap.css')}}" rel="stylesheet">
    <link href="{{asset('assets/css/home.css')}}" rel="stylesheet">

    <link rel="apple-touch-icon" sizes="180x180" href="{{asset('assets/favicon_io/chefshat.svg')}}">
    <link rel="icon" type="image/png" sizes="32x32" href="{{asset('assets/favicon_io/chefshat.svg')}}">
    <link rel="icon" type="image/png" sizes="16x16" href="{{asset('assets/favicon_io/chefshat.svg')}}">
    <link rel="manifest" href="{{asset('assets/favicon_io/site.webmanifest')}}">

    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@24,400,0,0&icon_names=favorite" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">

    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@11/dist/sweetalert2.min.css">

<body class="body">
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
                    <form action="{{url('home')}}" class="form-search">
                        <span class="search-icon fas fa-search"></span>
                        <input class="searchbox-input" type="search" name="query" placeholder="Search..."
                            aria-label="Search" value="{{ $query }}">
                    </form>
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
        @if (session()->has('success'))
            <script>
                document.addEventListener('DOMContentLoaded', function() {
                    Swal.fire({
                        title: 'Success!',
                        text: '{{ session('success') }}',
                        icon: 'success',
                        confirmButtonText: 'OK'
                    });
                });
            </script>
        @endif  

        @if (session()->has('welcome'))
            <script>
                document.addEventListener('DOMContentLoaded', function() {
                    showSwal({
                        title: '{{ session('welcome') }}',
                        icon: 'success',
                        confirmButtonText: 'OK'
                    });
                });
            </script>
        @endif

        
        @if (trim($query) !== '')
        <div class="container-Search mb-5 accordion-collapse collapse show" id="searchCon">
            <h1 class="searchResultText">Search Results for "{{ $query }}":</h1>
            <!-- <div class="line"></div> -->
            <button class="clearBorderedBtn" data-bs-toggle="collapse" data-bs-target="#searchCon" type="button" aria-expanded="false" aria-controls="user_books">
                <i class="fa-solid fa-xmark Icon"></i>
                Clear
            </button>

            <div class="container-Search-Result" ><!--style="background-color: blue"-->

                @if($results->isEmpty())
                    <div class="col">
                        <div class="NoResult mb-3">No results found for {{ $query }}.</div>
                    
                        <a class="btnClearFilter" href="{{url('home')}}"><i class="fa-solid fa-xmark"></i> Clear Search</a>
                    </div>
                    <!-- @dd($results) -->
                @else
                    @foreach($results as $book)
                        <div class="item book-item" data-id="{{ $book->id }}">
                            <img class="coverImg" src="{{ asset('storage/' . $book->coverImage) }}" alt="Cover Image">
                            <div class="info">
                                <a class="title">{{ $book->recipeTitle }}</a>
                                <a class="byText">By</a>
                                <p class="author d-inline"> {{$book->username}}</p>
                            </div>
                            <div class="container-rating d-flex align-items-center px-2">

                                @php
                                    $starsTotal = $book['starsCount'];
                                    $starsFull = floor($starsTotal);
                                    $starsHalf = ($starsTotal - $starsFull) > 0 ? true : false;
                                    $starsNum = number_format($book['starsCount'], 1);
                                @endphp

                                <!-- <h1 class="ratingText mb-0">Ratings: </h1> -->
                                <div class="rating-owner d-flex d-inline justify-content-center">
                                    
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
                                <h1 class="rates ms-2 mb-0 mt-1 d-inline"> {{$book['ratings']}} Ratings</h1>
                            </div>
                        </div>
                    @endforeach
                @endif
            </div>
        </div>
        @endif


            <!-- 1st Container with Horizontal Scroll -->
        <div class="user_books d-flex align-items-center">
            <div class="welcomeText me-2">My Books</div><div class="bookNumText d-inline">({{ $books->count() }})</div>
            <div class="line"></div>
            <button class="nav-link dropdown-toggle dropdown-toggle-light-color dropdown-toggle-button px-2" id="show_hide_btn" data-bs-toggle="collapse" data-bs-target="#user_books" type="button" aria-expanded="false" aria-controls="user_books">Show</button>
        </div>
        <div class="container-User collapse" id="user_books">
            <!-- 1st Scroll-->
            @foreach($books as $book)
                <div class="item book-item" data-id="{{ $book->id }}">
                    <img class="coverImg" src="{{ asset('storage/' . $book->coverImage) }}" alt="Cover Image">
                    <div class="info">
                        <a class="title">{{ $book->recipeTitle }}</a>
                        <a class="byText">By</a>
                        <p class="author d-inline"> {{$book->username}}</p>

                    </div>
                    <div class="container-rating d-flex align-items-center px-2">

                        @php
                            $starsTotal = $book['starsCount'];
                            $starsFull = floor($starsTotal);
                            $starsHalf = ($starsTotal - $starsFull) > 0 ? true : false;
                            $starsNum = number_format($book['starsCount'], decimals: 1);
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
                        <h1 class="rates ms-2 mb-0 mt-1 d-inline"> {{$book['ratings']}} Ratings</h1>
                    </div>
                </div>
            @endforeach
        </div>



        <!-- 2nd Container Vertical Scroll -->
        <div class="container-Home" id="containerView">
            <div class="header-home d-flex mt-5 align-items-center">
                
                @if ($category != null)
                    <div class="welcomeText categoryText">{{$category}}</div>
                @else
                    <div class="welcomeText">Home</div>
                @endif
                
                <div class="line"></div>

                <div class="navbar-nav justify-content-end align-content-center">
                    <li class="nav-item dropdown">
                        <button class="nav-link dropdown-toggle dropdown-toggle-light-color filter text-center px-2" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                            Filter
                            <i class="fa-solid fa-filter"></i>
                        </button>
                        <ul class="dropdown-menu">
                            <li>
                                @if ($category != null)
                                    <a class="dropdown-item" href="{{url('home')}}"><i class="fa-solid fa-xmark"></i> Clear Filter</a>
                                @endif
                            </li>
                            <li><a class="dropdown-item" href="{{route('home.custom', ['category' => 'Appetizers'])}} #containerView">Appetizers</a></li>
                            <li><a class="dropdown-item" href="{{route('home.custom', ['category' => 'Side Dishes'])}} #containerView">Side Dishes</a></li>
                            <li><a class="dropdown-item" href="{{route('home.custom', ['category' => 'Main Courses'])}} #containerView">Main Courses</a></li>
                            <li><a class="dropdown-item" href="{{route('home.custom', ['category' => 'Desserts'])}} #containerView">Desserts</a></li>
                            <li><a class="dropdown-item" href="{{route('home.custom', ['category' => 'Beverages'])}} #containerView">Beverages</a></li>
                            <li><a class="dropdown-item" href="{{route('home.custom', ['category' => 'Soups'])}} #containerView">Soups</a></li>
                            <li><a class="dropdown-item" href="{{route('home.custom', ['category' => 'Salads'])}} #containerView">Salads</a></li>
                            <li><a class="dropdown-item" href="{{route('home.custom', ['category' => 'Breakfasts'])}} #containerView">Breakfasts</a></li>
                            <li><a class="dropdown-item" href="{{route('home.custom', ['category' => 'Snacks'])}} #containerView">Snacks</a></li>
                            <li><a class="dropdown-item" href="{{route('home.custom', ['category' => 'Bread and Pastries'])}} #containerView">Bread and Pastries</a></li>
                        </ul>
                    </li>
                </div>
            </div>


            @if ($category != null && $check == false)
                <div class="NoResult mb-3">No results for {{$category}}</div>
                <a class="clearBorderedBtn" href="{{url('home')}}"><i class="fa-solid fa-xmark"></i> Clear Filter</a>
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
                            <h1 class="rates ms-2 mb-0 mt-1 d-inline"> {{$book['ratings']}} Ratings</h1>
                    </div>
                </div>
            @endforeach

            </div>

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
                            <div class="recommended">
                                <p class="recommendedText">Recommended</p>
                                <div class="container-rating d-flex align-items-center px-2">

                                    @php
                                        $starsTotal = $book['starsCount'];
                                        $starsFull = floor($starsTotal);
                                        $starsHalf = ($starsTotal - $starsFull) > 0 ? true : false;
                                        $starsNum = number_format($book['starsCount'], 1);
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
                                        <h1 class="rates ms-2 mb-0 mt-1 d-inline"> {{$book['ratings']}} Ratings</h1>
                                </div>
                            </div>
                        </div>
                    @endforeach
                        
                    <!-- All Books -->
                    @foreach($userWithBooks as $book)
                        <div class="item book-item" data-id="{{ $book->id }}">
                            <img class="coverImg" src="{{ asset('storage/' . $book->coverImage) }}" alt="Cover Image">
                            <div class="info">
                                <a class="title">{{ $book->recipeTitle }}</a>
                                <a class="byText">By</a>
                                <p class="author d-inline"> {{ $book->username }}</p>

                            </div>
                            <div class="container-rating d-flex align-items-center px-2">

                                @php
                                    $starsTotal = $book['starsCount'];
                                    $starsFull = floor($starsTotal);
                                    $starsHalf = ($starsTotal - $starsFull) > 0 ? true : false;
                                    $starsNum = number_format($book['starsCount'], 1);
                                @endphp

                                <!-- <h1 class="ratingText mb-0">Ratings: </h1> -->
                                <div class="rating-owner d-flex d-inline justify-content-center">
                                    
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
                                <h1 class="rates ms-2 mb-0 mt-1 d-inline"> {{$book['ratings']}} Ratings</h1>
                            </div>
                        </div>
                    @endforeach
                </div>
            @endif
                
        </div>
    </div>

    
    <!-- <script>
        document.querySelectorAll('.book-item').forEach(item => {
            item.addEventListener('click', function () {
                const bookId = this.getAttribute('data-id'); // Retrieve the book ID
                window.location.href = '{{ route('book.details', ['id' => '__ID__']) }}'.replace('__ID__', bookId);
            });
        });
    </script> -->


    <script src="{{ asset('assets/js/home.js') }}"></script>
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