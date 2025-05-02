<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>LC About</title>
    <link href="{{asset('assets/css/bootstrap.css')}}" rel="stylesheet">
    <link href="{{asset('assets/css/about.css')}}" rel="stylesheet">

    <link rel="apple-touch-icon" sizes="180x180" href="{{asset('assets/favicon_io/chefshat.png')}}">
    <link rel="icon" type="image/png" sizes="32x32" href="{{asset('assets/favicon_io/chefshat.png')}}">
    <link rel="icon" type="image/png" sizes="16x16" href="{{asset('assets/favicon_io/chefshat.png')}}">
    <link rel="manifest" href="{{asset('assets/favicon_io/site.webmanifest')}}">

    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@24,400,0,0&icon_names=search" />

</head>
<body class="body">
    <nav class="navbar  navbar-expand-lg">
        <div class="container-fluid">

            <a class="navbar-brand justify-content-center align-content-center text-center" href="{{url('home')}}">
                <img src="{{asset('assets/favicon_io/chefshat.png')}}" alt="" srcset="" width="32" height="32">
                Local Cuisine
            </a>

            <div class="collapse navbar-collapse d-flex">
                <div class="navbar-nav ms-auto">
                    <a class="nav-link mainNav text-center" href="{{url()->previous()}}">Go Back</a>
                </div>
            </div>
        </div>
    </nav>


    <!-- Container 1 About us -->
    <div class="position-relative" id="container1">
        <h2 class="mb-4 fw-bold welcomeText position-absolute  top-50 start-50 translate-middle"> About Us</h2>
        <img src="{{ asset('assets/Images/9170.jpg') }}" alt="Background Image" class="imageBg">
    </div>
    
    <!-- Container 2 NavTabs -->
    
    <div class="container" id="container2">
        <ul class="nav nav-tabs justify-content-center column-gap-3" id="myTab" role="tablist">
            <li class="nav-item" role="presentation">
                <button class="nav-link active" id="Story-tab" data-bs-toggle="tab" data-bs-target="#Story-tab-pane" type="button" role="tab" aria-controls="Story-tab-pane" aria-selected="true">Our Story</button>
            </li>
            <li class="nav-item" role="presentation">
                <button class="nav-link" id="Vision-tab" data-bs-toggle="tab" data-bs-target="#Vision-tab-pane" type="button" role="tab" aria-controls="Vision-tab-pane" aria-selected="false">Vision</button>
            </li>
            <li class="nav-item" role="presentation">
                <button class="nav-link" id="HWorks-tab" data-bs-toggle="tab" data-bs-target="#HWorks-tab-pane" type="button" role="tab" aria-controls="HWorks-tab-pane" aria-selected="false">How it works</button>
            </li>
            <li class="nav-item" role="presentation">
                <button class="nav-link" id="ExShare-tab" data-bs-toggle="tab" data-bs-target="#ExShare-tab-pane" type="button" role="tab" aria-controls="ExShare-tab-pane" aria-selected="false">Explore and Share</button>
            </li>
            <li class="nav-item" role="presentation">
                <button class="nav-link" id="Contacts-tab" data-bs-toggle="tab" data-bs-target="#Contacts-tab-pane" type="button" role="tab" aria-controls="Contacts-tab-pane" aria-selected="false">Contacts</button>
            </li>
        </ul>

        <div class="tab-content mt-5" id="myTabContent">
            <div class="tab-pane fade show active text-center" id="Story-tab-pane" role="tabpanel" aria-labelledby="Story-tab" tabindex="0">
                <p class="viewText">Welcome to Local Cuisine! We are third-year students from PCU-COI, and this website is our final project for our Software Engineering class.</p>
                <p class="viewText">Our task was to create a recipe book website, and we are excited to share some of the best Filipino recipes we've collected.</p>
            </div>
            <div class="tab-pane fade" id="Vision-tab-pane" role="tabpanel" aria-labelledby="Vision-tab" tabindex="0">

                <p class="viewText">Our goal is more than just creating this project. We want to share Filipino recipes with clear instructions to promote our local food. We noticed that Filipino dishes are not well-known in other countries.
                <p class="viewText">It's time for the world to see, taste, and enjoy the unique flavors of Filipino cuisine..</p>
            </div>

            <div class="tab-pane fade" id="HWorks-tab-pane" role="tabpanel" aria-labelledby="HWorks-tab" tabindex="0">
                <p class="viewText">Using our website is easy.</p>
                <p class="viewText">Log In or Sign Up:</p>

                <p class="viewText">If you already have an account, just log in.
                New users need to sign up by giving their name and Gmail address.</p>

                <p class="viewText">Set Up Your Account:</p>

                <p class="viewText">After signing up, complete the setup process. Make sure to save your password!</p>
                <!-- You'll also need to agree to our policies. -->
            </div>

            <div class="tab-pane fade" id="ExShare-tab-pane" role="tabpanel" aria-labelledby="ExShare-tab" tabindex="0">
                <p class="viewText">Once logged in, you can search for recipes and save your favorites.You can also create your own recipes and share them with others!</p>
                <p class="viewText"> Acknowledgements</p>
                <p class="viewText">A big thank you to Sir Glen Paul Choco, our professor in Software Engineering, for guiding us and helping us create this website.</p>
            </div>
            <div class="tab-pane fade" id="Contacts-tab-pane" role="tabpanel" aria-labelledby="Contacts-tab" tabindex="0">
                <p class="viewText">Having problem?<br>Contact our Developer.</p>
                <a href="https://www.facebook.com/Eivan.Mart1738?mibextid=ZbWKwL">https://www.facebook.com/Eivan.Mart1738?mibextid=ZbWKwL</a><br>
                <a href="https://www.facebook.com/dcxme09">https://www.facebook.com/dcxme09</a><br>
                <a href="https://www.facebook.com/liahhellaene22">https://www.facebook.com/liahhellaene22</a><br>
                <a href="https://www.facebook.com/profile.php?id=100085608210769&mibextid=ZbWKwL">https://www.facebook.com/profile.php?id=100085608210769&mibextid=ZbWKwL</a>
            </div>
        </div>
    </div>


    <script src="{{ asset('assets/js/projectjscript.js') }}"></script>
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