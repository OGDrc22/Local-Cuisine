<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login/Register</title>
    <link href="{{asset('assets/css/bootstrap.css')}}" rel="stylesheet">
    <link href="{{asset('assets/css/loginregister.css')}}" rel="stylesheet">

    <link rel="apple-touch-icon" sizes="180x180" href="{{asset('assets/favicon_io/chefshat.svg')}}">
    <link rel="icon" type="image/png" sizes="32x32" href="{{asset('assets/favicon_io/chefshat.svg')}}">
    <link rel="icon" type="image/png" sizes="16x16" href="{{asset('assets/favicon_io/chefshat.svg')}}">
    <link rel="manifest" href="{{asset('assets/favicon_io/site.webmanifest')}}">
    
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@11/dist/sweetalert2.min.css">

</head>
<body>
    <!-- @if ($errors->any())
        <div class="alert alert-danger floating-alert">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif -->

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
    
    <div class="centered-content">

        <div class="formcard" id="formcard">
            <div class="btns-top">
                <div class="btnHighlight" id="btns"></div>
                <button class="toggle-btn" onclick="login()">Login</button>
                <button class="toggle-btn" onclick="register()">Register</button>
            </div>
            <form method="POST" action="{{route('loginuser')}}" class="input-form needs-validation mt-5" id="login-form">
                @csrf
                <div class="form-group fg">
                    <label for="exEmail" class="label">Email address</label>
                    <input name="email" type="email" class="input-field" id="exEmail" placeholder="name@mail.com" required>
                    <div class="invalid-feedback">Please provide a valid email address.</div>
                </div>

                <div class="form-group fg">
                    <label for="exPassword1" class="label">Password</label>
                    <div class="pass-input">
                        <input name="password" type="password" class="inputpass" id="LGPassword" placeholder="Password" required>
                        <input type="checkbox" onclick="LGpass()" class="fa-solid fa-eye check-box" id="checkbox">
                    </div>
                    <div class="invalid-feedback">Password Required.</div>
                </div>


        
                <div class="d-flex justify-content-center mt-3">
                    <button name="btnsubmit" type="submit" class="btnSub">Login</button>
                </div>
            </form>

            <form action="/registernewuser" method="POST" class="input-form needs-validation" id="register-form" novalidate>
                @csrf
                <div class="form-group mt-3 fg">
                    <label for="firstName" class="label">Username</label>
                    <input name="username" type="text" class="input-field" id="firstName" placeholder="Enter a username" required>
                    <div class="invalid-feedback">Please provide a username.</div>
                    <div class="valid-feedback">Looks good!</div>
                </div>

                <div class="form-group fg">
                    <label for="exEmail" class="label">Email address</label>
                    <input name="email" type="email" class="input-field" placeholder="name@mail.com" id="exEmail" required>
                    <div class="invalid-feedback">Please provide a valid email address.</div>
                </div>

                <div class="form-group fg">
                    <label for="exPassword" class="label">Password</label>
                    <div class="pass-input">
                        <input name="password" type="password" class="inputpass" id="exPassword"  placeholder="Password" required>
                        <input type="checkbox" onclick="Cpass()" class="fa-solid fa-eye check-box" id="checkbox1">
                    </div>
                    <div class="invalid-feedback invalid" id="invalid-feedback">Please provide a Password.</div>
                </div>

                <div class="form-group fg">
                    <label for="conPassword" class="label">Confirm Password</label>
                    <div class="pass-input">
                        <input type="password" class="inputpass" id="conPassword" placeholder="Re-enter password" required>
                        <input type="checkbox" onclick="C1pass()" class="fa-solid fa-eye check-box" id="checkbox2">
                    </div>
                    <div class="invalid-feedback invalid" id="invalid-feedback1">Please provide a Password.</div>
                </div>

                <div class="d-flex justify-content-center mt-2">
                    <button type="submit" class="btnSub">Register</button>
                </div>
            </form>
        </div>
        <div class="container" id="container2">
            <h1>I am looking for <br> <span class="auto-type"></span></h1>
        </div>
    </div>


    <script src="https://unpkg.com/typed.js@2.1.0/dist/typed.umd.js"></script>
    <script src="{{asset('assets/js/loginregister.js')}}"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11/dist/sweetalert2.all.min.js"></script>
    <!-- <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js" integrity="sha384-oBqDVmMz4fnFO9gybT2ssH/t6eB4PmTcjMwTwxd3GhKK7Fpcu4q8fK/ujPaX/lH7" crossorigin="anonymous"></script> -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-tjMNZjMaRUEy1L4c+wb+nHgMKFvh5QboMD6a9aKKtYfRVW3/eEk7pQq7Z/96p4Ed" crossorigin="anonymous"></script>


</body>

<footer id="ft">
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
