<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta name="route-tempate" content="{{ route('book.details', ['id' => '__ID__']) }}">
    
    <title>LC Profile</title>
    <link href="{{asset('assets/css/bootstrap.css')}}" rel="stylesheet">
    <link href="{{asset('assets/css/userprofile.css')}}" rel="stylesheet">

    <link rel="apple-touch-icon" sizes="180x180" href="{{asset('assets/favicon_io/chefshat.svg')}}">
    <link rel="icon" type="image/png" sizes="32x32" href="{{asset('assets/favicon_io/chefshat.svg')}}">
    <link rel="icon" type="image/png" sizes="16x16" href="{{asset('assets/favicon_io/chefshat.svg')}}">
    <link rel="manifest" href="{{asset('assets/favicon_io/site.webmanifest')}}">

    <link rel="stylesheet"
        href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@24,400,0,0&icon_names=search" />
    <link rel="stylesheet"
        href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@24,400,0,0&icon_names=favorite" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons/font/bootstrap-icons.css" rel="stylesheet">

    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@11/dist/sweetalert2.min.css">

    
    <link rel="stylesheet" href="{{ asset('assets/cropperjs/css/main.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/cropperjs/css/second.css') }}">

</head>

<body class="body">
    <nav class="navbar navbar-expand-lg">

        <div class="container-top-nav container-fluid">
            <div class="left-brand-container">
                <a class="navbar-brand" href="{{url('home')}}">
                    <img src="{{asset('assets/favicon_io/chefshat.svg')}}" alt="" srcset="" class="Icon" width="32"
                        height="32">
                    <div class="webname">
                        Local Cuisine
                    </div>
                    <div class="navBarActions_dropdown">
                        Profile
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
                <button class="dropdown-toggle dropdown-toggle-button d-flex" data-bs-toggle="dropdown"
                    aria-expanded="false">
                    @if ($get_profilepic == null)
                        <i class="user-nav-icon fa-solid fa-circle-user"></i>
                    @else
                        <img src="{{ asset('storage/profilepics/' . ($get_profilepic)) }}" class="user-nav-icon-img" id="current-profile-pic" alt="Profile Picture">                
                    @endif
                    <div class="username_hidden">{{$get_userName}}</div>
                </button>
                <ul class="dropdown-menu dropdown-menu-end">
                    <li>
                        <form action="{{route('logout')}}" method="POST" style="display: inline;">
                            @csrf
                            <button type="submit" class="dropdown-item">Logout</button>
                        </form>
                    </li>
                    <li class="border-top"><a class="dropdown-item" href="{{route('about')}}">About Us</a></li>
                </ul>
            </div>
        </div>
    </nav>


    <div class="container-main">
        @if($errors->any())
            <script>
                document.addEventListener('DOMContentLoaded', function () {
                    showSwal({
                        icon: 'error',
                        title: 'Please fix the following:',
                        // build an HTML list of all errors
                        html: `{!! '<ul style="text-align:left;margin:0;padding-left:1.2em;">'
            . implode('', $errors->all('<li>:message</li>'))
            . '</ul>' !!}`,
                        confirmButtonText: 'OK'
                    });
                });
            </script>
        @endif


        @if (session()->has('success'))
            <script>
                document.addEventListener('DOMContentLoaded', function () {
                    showSwal({
                        title: 'Success!',
                        text: '{{ session('success') }}',
                        icon: 'success',
                        confirmButtonText: 'OK'
                    });
                });
            </script>
        @endif
        <div class="text-center webname welcomeText d-none">
            User Profile
        </div>

        <div class="user">
            <img src="{{ asset('assets/Images/bitmap.svg') }}" alt="" class="banner">

        </div>

        <div class="grid-container">

            <div class="user-in">
                <div class="pic-container">
                    <div class="profile-pic-container" id="edit-pic">
                        @if ($get_profilepic == null)
                                <i class="user-nav-icon fa-solid fa-circle-user dp"></i>
                            
                        @else
                            <img src="{{ asset('storage/profilepics/' . ($get_profilepic)) }}" class="profile-pic" id="current-profile-pic" alt="Profile Picture">
                        @endif
                    </div>
                       
                    <i class="fa-solid fa-pen-to-square edit-pic" id="edit-pic"></i>

                    <img src="{{ asset('assets/Images/chefshat.svg') }}" alt="" class="hat">
                </div>
                <div class="user-info">
                    <h3 class="user_name">{{ $get_userName }}</h3>
                    <h5 class="user_chefs_level">{{ $get_userLevel }}</h5>
                    <h5 class="user_email">{{ $get_userEmail }}</h5>
                </div>

            </div>

            <button class="edit-info-2">
            </button>

            <button class="edit-info-2">
            </button>


            <button class="edit-info" data-bs-toggle="collapse" data-bs-target="#info_user" type="button"
                aria-expanded="false" aria-controls="info_user">
                <i class="fa-solid fa-pen-to-square"></i>
            </button>

            <div class="container-form accordion-collapse collapse" id="info_user">
                <form action="{{ route('userprofile.update', $get_userId )}}" method="POST" id="update-form">

                    @csrf

                    @method('PUT')



                    <div class="required form-group formcard">
                        <div class="row-form">
                            <div class="form-group mt-3">
                                <label class="label" for="firstName">You are <h1 class="required">(*)</h1></label>
                                <div class="nav-item dropdownChefCategory">
                                    <button class="input-field form-control chefs_level" href="#" role="button"
                                        data-bs-toggle="dropdown" aria-expanded="false" id="chefs_toggle">
                                        <div id="dataVal">{{ $get_userLevel }}</div>
                                        <input type="checkbox" class="dropdown-toggle check-boxA">
                                    </button>

                                    <input name="chefs_level" type="hidden" id="input_chefs_level"
                                        value="{{ $get_userLevel }}">

                                    <ul class="dropdown-menu dropdown-menuChefCategory">
                                        <li class="dropdown-item" data-value="Executive Chef" aria-disabled="true">
                                            Executive
                                            Chef</li>
                                        <li class="dropdown-item" data-value="Sous Chef">Sous Chef</li>
                                        <li class="dropdown-item" data-value="Chef de Partie (Station Chef)">Chef de
                                            Partie
                                            (Station Chef)</li>
                                        <li class="dropdown-item" data-value="Commis Chef (Junior Chef)">Commis Chef
                                            (Junior
                                            Chef)</li>
                                        <li class="dropdown-item" data-value="Apprentice (Stagiaire or Trainee">
                                            Apprentice
                                            (Stagiaire or Trainee)</li>
                                        <li class="dropdown-item" data-value="Home Cook / Cooking Enthusiast">Home Cook
                                            /
                                            Cooking Enthusiast</li>
                                        <li class="dropdown-item" data-value="Beginner / Kitchen Newbie">Beginner /
                                            Kitchen
                                            Newbie</li>
                                    </ul>
                                </div>

                                <div class="invalid-feedback">Please provide a username.</div>
                            </div>

                        </div>
                    </div>



                    <div class="row-form">
                        <div class="form-group mt-3">
                            <label class="label" for="firstName">Username <h1 class="required">(*)</h1></label>
                            <input name="username" type="text" class="input-field form-control" id="firstName"
                                placeholder="Enter a username" value="{{$get_userName}}">

                            <div class="invalid-feedback">Please provide a username.</div>
                        </div>

                        <div class="form-group mt-3">
                            <label class="label" for="exEmail">Email address <h1 class="required">(*)</h1></label>
                            <input name="email" type="email" class="input-field form-control" id="exEmail"
                                placeholder="name@mail.com" value="{{$get_userEmail}}">
                            <div class="invalid-feedback">Please provide a valid email address.</div>
                        </div>
                    </div>



                    <div class="row-form">
                        <div class="uPass" id="uPass">
                            <div class="form-group mt-3">
                                <label class="label" for="exPassword">Create new password</label>
                                <div class="pass-input">
                                    <input name="password" type="password" class="inputpass" id="exPassword"
                                        placeholder="Password">
                                    <input type="checkbox" onclick="Cpass()" class="fa-solid fa-eye check-box"
                                        id="checkbox1">
                                </div>
                                <div class="invalid-feedback" id="invalid-feedback">Please provide a Password.</div>
                            </div>

                            <div id="exPassword" class="form-text fs-7">
                                Your password must be 8-20 characters long.
                            </div>

                            <div class="form-group mt-3">
                                <label class="label" for="conPassword">Confirm new password</label>
                                <div class="pass-input">
                                    <input type="password" class="inputpass" id="conPassword" placeholder="Password">
                                    <input type="checkbox" onclick="C1pass()" class="fa-solid fa-eye check-box"
                                        id="checkbox2">
                                </div>
                                <div class="invalid-feedback" id="invalid-feedback1">Please provide a Password.</div>
                            </div>

                            <div id="exPassword" class="form-text fs-7">
                                Remember your password must be matched.
                            </div>
                        </div>
                    </div>

                    <div class="d-flex justify-content-end mt-3">
                        <a type="cancel" class="btnCancel me-3 text-center text-decoration-none" role="button"
                            href="{{url('home')}}">Cancel</a>
                        <button type="button" id="openModal" class="btnSub">Save</button>
                    </div>
                </form>

                <form action="{{ url('/userprofileDelete/' . $get_userId) }}" method="POST" class="actionBtnD"
                    id="myFormD">
                    @csrf
                    @method('PUT')
                    <button type="button" id="openModalD" class="btnDelete">Delete</button>
                </form>

            </div>


            <div class="users-books">

                <div class="user_books d-flex align-items-center">
                    <div class="welcomeText me-2">My Books</div><div class="bookNumText d-inline">({{ $books->count() }})</div>
                    <div class="line"></div>
                    <button class="nav-link dropdown-toggle dropdown-toggle-light-color dropdown-toggle-button px-2" id="show_hide_btn" data-bs-toggle="collapse" data-bs-target="#user_books" type="button" aria-expanded="false" aria-controls="user_books">Show</button>
                </div>
                <div class="container-User collapse show" id="user_books">
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
                
            </div>

        </div>

    </div>


    <script src="{{ asset('assets/js/userprofile.js') }}"></script>
    <script src="{{ asset('assets/js/bookSelection.js') }}"></script>
    <!-- Bootstrap 5 JS bundle (includes Popper.js) -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>

    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11/dist/sweetalert2.all.min.js"></script>

    
    <script src="{{ asset('assets/cropperjs/js/main.js') }}"></script>

    <script>
        const ADD_UPDATE_URL = "{{ route('userprofile.updatepic', $get_userId )}}";
    </script>


</body>

<footer id="ft">
    <hr class="footerLine">
    <div class="footer">
        <div class="container-fluid d-flex justify-content-center align-items-center">
            <a class="col navbar-brand justify-content-center align-content-center text-center m-0" href="{{url('/')}}">
                <img src="{{asset('assets/favicon_io/chefshat.svg')}}" alt="" srcset="" class="Icon" width="32"
                    height="32">
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