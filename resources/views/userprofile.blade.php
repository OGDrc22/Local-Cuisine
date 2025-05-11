<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    
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
                    <i class="user-nav-icon fa-solid fa-circle-user"></i>
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
                        @if ($get_profilepic == null)
                            <div class="profile-pic">
                                <i class="user-nav-icon fa-solid fa-circle-user dp"></i>
                            </div>
                        @else
                            <img src="{{ asset('storage/profilepics/' . ($get_profilepic)) }}" class="profile-pic" id="current-profile-pic" alt="Profile Picture">
                        @endif
                   
                    <button class="edit-pic" id="edit-pic">
                        <i class="fa-solid fa-user-pen"></i>
                    </button>
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

            <div class="container-form accordion-collapse collapse show" id="info_user">
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


        </div>

    </div>


    <script src="{{ asset('assets/js/userprofile.js') }}"></script>
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