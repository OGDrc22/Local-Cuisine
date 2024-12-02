<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>LC About</title>
    <link href="{{asset('assets/css/bootstrap.css')}}" rel="stylesheet">
    <link href="{{asset('assets/css/customstyles.css')}}" rel="stylesheet">

    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@24,400,0,0&icon_names=search" />

</head>
<body style="background: #060C0F">
    <nav class="navbar" style="background: #030608">
        <div class="container-fluid d-flex justify-content-between align-items-center">
            <span class="navbar-brand px-5" style="background: #030608">
                <a class="text-primary text-decoration-none " href="{{url('home')}}">Local Cuisine</a>
            </span>
            <div class="search w-50">
                <span class="search-icon material-symbols-outlined">search</span>
                <input class="searchbox-input outline-0 border-0" style="background: #060C0F" type="search" placeholder="Search" aria-label="Search">
            </div>
            <div class="d-flex px-5">
                <a class="rightBtn" href="{{url()->previous()}}">Go Back</a>
            </div>
        </div>
    </nav>


    <div class="containerP mt-5">
        <div class="card-header text-center">
            About Us
        </div>
        <div class="card-body">
                
            <div class="rowAction">
                <p>Secret</p>
        </div>
    </div>


    <script src="{{ asset('assets/js/projectjscript.js') }}"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
</body>
</html>