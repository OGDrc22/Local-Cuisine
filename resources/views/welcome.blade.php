<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Local Cuisine</title>
    <link href="{{asset('assets/css/bootstrap.css')}}" rel="stylesheet">
    <link href="{{asset('assets/css/welcome.css')}}" rel="stylesheet">

    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@24,400,0,0&icon_names=search" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
</head>
<body class="body">
    <nav class="navbar">
        <div class="container-fluid d-flex justify-content-between align-items-center">
            <span class="navbar-brand">
                <a class="navTitle">Local Cuisine</a>
            </span>
            <div class="search w-50 d-none">
                <span class="search-icon material-symbols-outlined">search</span>
                <input class="searchbox-input outline-0 border-0" style="background: #060C0F" type="search" placeholder="Search" aria-label="Search">
            </div>

            <div class="px-5">
                <a class="LRPage" href="{{url('registernewuser')}}">Login/Register</a>
            </div>
        </div>
    </nav>

    

    <img src="{{ asset('assets/Images/imageBg.png') }}" alt="Background Image" class="imageBg">


    <div class="containerView">
        <h1 class="welcomeText">Welcome</h1>
        <div class="container-User">
            @foreach($userWithBooks as $userData)
                @foreach($userData['books'] as $book)
                    <div class="item book-item" data-id="{{ $book->id }}">
                        <img class="coverImg" src="{{ asset('storage/' . $book->coverImage) }}" alt="Cover Image">
                        <div class="info">
                            <a class="title">{{ $book->recipeTitle }}</a>
                            <a class="byText">By</a>
                            <p class="author">{{ $userData['username'] }}</p>
                           
                        </div>
                         <div class="rating">
                            <i id="star" class="fa-solid fa-star"></i>
                            <i id="star" class="fa-solid fa-star"></i>
                            <i id="star" class="fa-solid fa-star"></i>
                            <i id="star" class="fa-solid fa-star"></i>
                            <i id="star" class="fa-solid fa-star"></i>
                        </div>
                    </div>
                @endforeach
            @endforeach
        </div>
    </div>

    <script>
        document.querySelectorAll('.book-item').forEach(item => {
            item.addEventListener('click', function () {
                const bookId = this.getAttribute('data-id'); // Retrieve the book ID
                window.location.href = '{{ route('book.details', ['id' => '__ID__']) }}'.replace('__ID__', bookId);
            });
        });
    </script>

<script src="{{ asset('assets/js/projectjscript.js') }}"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
</body>
</html>