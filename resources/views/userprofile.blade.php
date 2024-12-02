<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>LC Profile</title>
    <link href="{{asset('assets/css/bootstrap.css')}}" rel="stylesheet">
    <link href="{{asset('assets/css/userprofile.css')}}" rel="stylesheet">

    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@24,400,0,0&icon_names=search" />
    <link rel="stylesheet"
        href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@24,400,0,0&icon_names=favorite" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons/font/bootstrap-icons.css" rel="stylesheet">

</head>
<body>
    <nav class="navbar  navbar-expand-lg">
        <div class="container-fluid">

            <a class="navbar-brand" href="#">Local Cuisine</a>

            <div class="collapse navbar-collapse d-flex">
                <div class="navbar-nav d-flex">
                    <a class="nav-link me-2 navBtn" href="{{route('newBook')}}">+ Add Recipe</a>
                    <a class="nav-link me-2 navBtn d-flex justify-content-center p-2" href="{{url('favorites')}}"><i class="fa-solid fa-heart navBtn Icon"></i>Favorites</a>
                </div>

                <div class="navbar-nav ms-auto">
                    <li class="nav-item dropdown">
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
                        </ul>
                    </li>
                </div>
            </div>
        </div>
    </nav>


    <div class="containerP">
        <div class="card-header text-center">
            User Profile
        </div>
        <div class="card-body">
            <form action="{{url('/userprofile/' . $get_userId)}}" method="POST" id="update-form">

                @csrf

                @method('PUT')

                <div class="row-form">
                    <div class="form-group mt-3">
                        <label class="label" for="firstName">Username</label>
                        <input name="username" type="text" class="input-field" id="firstName" placeholder="Enter a username" value="{{$get_userName}}">
                    </div>


                    <div class="form-group mt-3">
                        <label class="label" for="exEmail">Email address</label>
                        <input name="email" type="email" class="input-field" id="exEmail" placeholder="name@mail.com" value="{{$get_userEmail}}">
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
</html>