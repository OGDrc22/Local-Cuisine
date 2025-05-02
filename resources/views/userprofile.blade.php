<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>LC Profile</title>
    <link href="{{asset('assets/css/bootstrap.css')}}" rel="stylesheet">
    <link href="{{asset('assets/css/userprofile.css')}}" rel="stylesheet">

    <link rel="apple-touch-icon" sizes="180x180" href="{{asset('assets/favicon_io/chefshat.png')}}">
    <link rel="icon" type="image/png" sizes="32x32" href="{{asset('assets/favicon_io/chefshat.png')}}">
    <link rel="icon" type="image/png" sizes="16x16" href="{{asset('assets/favicon_io/chefshat.png')}}">
    <link rel="manifest" href="{{asset('assets/favicon_io/site.webmanifest')}}">

    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@24,400,0,0&icon_names=search" />
    <link rel="stylesheet"
        href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@24,400,0,0&icon_names=favorite" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons/font/bootstrap-icons.css" rel="stylesheet">

</head>
<body>
    <nav class="navbar  navbar-expand-lg">
        <div class="container-fluid">

            @if ($get_userName == 0)
                <a class="navbar-brand" href="{{url()->previous()}}">
                    <img src="{{asset('assets/favicon_io/chefshat.png')}}" alt="" srcset="" width="32" height="32">
                    Local Cuisine
                </a>
            @else
                <a class="navbar-brand" href="{{url('home')}}">
                    <img src="{{asset('assets/favicon_io/chefshat.png')}}" alt="" srcset="" width="32" height="32">
                    Local Cuisine
                </a>
            @endif

            <div class="collapse navbar-collapse d-flex">

                <div class="navbar-nav ms-auto">
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle dropdown-toggleBtn text-center" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
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


    <div class="containerP">
        @if ($errors->any())
            <div class="alert alert-danger floating-alert">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif
        <div class="card-header text-center">
            User Profile
        </div>
        <div class="card-body">
            <form action="{{url('/userprofile/' . $get_userId)}}" method="POST" id="update-form">

                @csrf

                @method('PUT')


                
                <div class="required form-group mt-2">
                    <div class="row-form">
                        <div class="form-group mt-3">
                            <label class="label" for="firstName">You are <h1 class="required">(*)</h1></label>
                            <div class="nav-item dropdownChefCategory">
                                <a class="input-field form-control selected" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                                    {{ $get_userLevel }}
                                    <input type="checkbox" class="dropdown-toggle check-boxA">
                                </a>
                                <ul class="dropdown-menu dropdown-menuChefCategory">
                                    <li class="dropdown-item" data-value="Executiveeee Chef" aria-disabled="true">Executive Chef</li>
                                    <li class="dropdown-item" data-value="ous Chef">Sous Chef</li>
                                    <li class="dropdown-item" data-value="Chef de Partie (Station Chef)">Chef de Partie (Station Chef)</li>
                                    <li class="dropdown-item" data-value="Commis Chef (Junior Chef)">Commis Chef (Junior Chef)</li>
                                    <li class="dropdown-item" data-value="Apprentice (Stagiaire or Trainee">Apprentice (Stagiaire or Trainee)</li>
                                    <li class="dropdown-item" data-value="Home Cook / Cooking Enthusiast">Home Cook / Cooking Enthusiast</li>
                                    <li class="dropdown-item" data-value="Beginner / Kitchen Newbie">Beginner / Kitchen Newbie</li>
                                </ul>
                            </div>
                            
                            <div class="invalid-feedback">Please provide a username.</div>
                        </div>

                    </div>
                </div>



                <div class="row-form">
                    <div class="form-group mt-3">
                        <label class="label" for="firstName">Username <h1 class="required">(*)</h1></label>
                        <input name="username" type="text" class="input-field form-control" id="firstName" placeholder="Enter a username" value="{{$get_userName}}">
                        
                        <div class="invalid-feedback">Please provide a username.</div>
                    </div>

                    <div class="form-group mt-3">
                        <label class="label" for="exEmail">Email address <h1 class="required">(*)</h1></label>
                        <input name="email" type="email" class="input-field form-control" id="exEmail" placeholder="name@mail.com" value="{{$get_userEmail}}" >
                        <div class="invalid-feedback">Please provide a valid email address.</div>
                    </div>
                </div>



                <div class="row-form">
                    <div class="uPass" id="uPass">
                        <div class="form-group mt-3">
                            <label class="label" for="exPassword">Create new password</label>
                            <div class="pass-input">
                                <input name="password" type="password" class="inputpass" id="exPassword" placeholder="Password">
                                <input type="checkbox" onclick="Cpass()" class="fa-solid fa-eye check-box" id="checkbox1">
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
                                <input type="checkbox" onclick="C1pass()" class="fa-solid fa-eye check-box" id="checkbox2">
                            </div>
                            <div class="invalid-feedback" id="invalid-feedback1">Please provide a Password.</div>
                        </div>

                        <div id="exPassword" class="form-text fs-7">
                            Remember your password must be matched.
                        </div>
                    </div>
                </div>
                    
                <div class="d-flex justify-content-end mt-3">
                    <a type="cancel" class="btnCancel me-3 text-center text-decoration-none" role="button" href="{{url('home')}}">Cancel</a>
                    <button type="button" id="openModal" class="btnSub">Save</button>
                </div>
            </form>

            <form action="{{ url('/userprofileDelete/' . $get_userId) }}" method="POST" class="actionBtnD" id="myFormD">
                @csrf
                @method('PUT')
                <button type="button" id="openModalD" class="btnDelete">Delete Account</button>
            </form>
            
        </div>

        <div class="modal fade" id="confirmationModal" tabindex="-1" aria-labelledby="modalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="modalLabel">Confirm Submission</h5>
                    </div>
                    <div class="modal-body">
                        Are you sure you want to save changes?
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btnCancel" data-bs-dismiss="modal">Cancel</button>
                        <button type="button" class="btnSub" id="confirmSubmit">Yes</button>
                    </div>
                </div>
            </div>
        </div>
        <div class="modal fade" id="confirmationModalD" tabindex="-1" aria-labelledby="modalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="modalLabelD">Delete Account</h5>
                    </div>
                    <div class="modal-body">
                        Are you sure you want to Delete this account?
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btnCancel" data-bs-dismiss="modal">Cancel</button>
                        <button type="button" class="btnSub" id="confirmDelete">Yes</button>
                    </div>
                </div>
            </div>
        </div>

    </div>


    <script src="{{ asset('assets/js/userprofile.js') }}"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
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