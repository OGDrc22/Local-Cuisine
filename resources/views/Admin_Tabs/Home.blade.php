@extends('admin_dashboard')

@section('main-content')
    <div class="home-main">
        @if (session('success'))
            <div class="alert alert-success floating-alert" role="alert">
                <h5 class="modal-title">{{ session('success') }}</h5>
            </div>
        @endif


        @if (trim($query) !== '')
            <div class="container-Search">
                <h1 class="welcomeText">Search Results for "{{ $query }}":</h1>
                <div class="container-Search-Result"><!--style="background-color: blue"-->

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

                                        @for ($i = $starsTotal + 1; $i <= 5; $i++)
                                            <label for="Star" title="{{$starsNum}} stars" class="fa-solid fa-star starRatedEmpty"></label>
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
                    @endif
                </div>
            </div>
        @endif


        <!-- 1st Container with Horizontal Scroll -->

        <div class="welcomeText d-none">My Books</div>
        <div class="container-User flex scroll-container1 d-none" id="container1">
            <!-- 1st Scroll-->
            @if (isset($books))
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
                                $starsNum = number_format($book['starsCount'], 1);
                            @endphp

                            <!-- <h1 class="ratingText mb-0">Ratings: </h1> -->
                            <div class="rating-owner d-flex d-inline">

                                @for ($i = $starsTotal + 1; $i <= 5; $i++)
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



        <!-- 2nd Container Vertical Scroll -->
        <div class="container-Home" id="containerView">
            <div class="header-home d-flex mt-5 align-items-center">

                @if ($category != null)
                    <div class="welcomeText pe-5 d-flex categoryText">{{$category}}</div>
                @else
                    <div class="welcomeText pe-5 d-flex">Home</div>
                @endif

                <div class="line"></div>

                <div class="navbar-nav ms-auto d-flex justify-content-end align-content-center">
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle filter text-center px-5 py-0" href="#" role="button"
                            data-bs-toggle="dropdown" aria-expanded="false">
                            Filter
                            <i class="fa-solid fa-filter"></i>
                        </a>
                        <ul class="dropdown-menu">
                            <li>
                                @if ($category != null)
                                    <a class="dropdown-item" href="{{url('home')}}"><i class="fa-solid fa-xmark"></i> Clear
                                        Filter</a>
                                @endif
                            </li>
                            <li><a class="dropdown-item"
                                    href="{{route('home.admin', ['category' => 'Appetizers'])}} #containerView">Appetizers</a>
                            </li>
                            <li><a class="dropdown-item"
                                    href="{{route('home.admin', ['category' => 'Side Dishes'])}} #containerView">Side Dishes</a>
                            </li>
                            <li><a class="dropdown-item"
                                    href="{{route('home.admin', ['category' => 'Main Courses'])}} #containerView">Main
                                    Courses</a></li>
                            <li><a class="dropdown-item"
                                    href="{{route('home.admin', ['category' => 'Desserts'])}} #containerView">Desserts</a></li>
                            <li><a class="dropdown-item"
                                    href="{{route('home.admin', ['category' => 'Beverages'])}} #containerView">Beverages</a>
                            </li>
                            <li><a class="dropdown-item"
                                    href="{{route('home.admin', ['category' => 'Soups'])}} #containerView">Soups</a></li>
                            <li><a class="dropdown-item"
                                    href="{{route('home.admin', ['category' => 'Salads'])}} #containerView">Salads</a></li>
                            <li><a class="dropdown-item"
                                    href="{{route('home.admin', ['category' => 'Breakfasts'])}} #containerView">Breakfasts</a>
                            </li>
                            <li><a class="dropdown-item"
                                    href="{{route('home.admin', ['category' => 'Snacks'])}} #containerView">Snacks</a></li>
                            <li><a class="dropdown-item"
                                    href="{{route('home.admin', ['category' => 'Bread and Pastries'])}} #containerView">Bread
                                    and Pastries</a></li>
                        </ul>
                    </li>
                </div>
            </div>


            @if ($category != null && $check == false)
                <div class="NoResult mb-3">No results for {{$category}}</div>
                <a class="btnClearFilter" href="{{url('home')}}"><i class="fa-solid fa-xmark"></i> Clear Filter</a>
            @endif

            <!-- Categorized Books -->
            <div class="container-User flex">

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
                                        <label for="Star" title="{{$starsNum}} stars" class="fa-solid fa-star starRatedEmpty"></label>
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

            @if ($category == null)
                <div class="container-User flex">

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
                                        <label for="Star" title="{{$starsNum}} stars" class="fa-solid fa-star starRatedEmpty"></label>
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

                                    @for ($i = $starsTotal + 1; $i <= 5; $i++)
                                        <label for="Star" title="{{$starsNum}} stars" class="fa-solid fa-star starRatedEmpty"></label>
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
@endsection