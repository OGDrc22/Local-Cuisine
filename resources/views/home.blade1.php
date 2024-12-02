<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Local Cuisine</title>
    <link href="{{asset('assets/css/bootstrap.css')}}" rel="stylesheet">
    <link href="{{asset('assets/css/customstyles.css')}}" rel="stylesheet">
    <link href="{{asset('assets/css/home.css')}}" rel="stylesheet">

    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@24,400,0,0&icon_names=search" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons/font/bootstrap-icons.css" rel="stylesheet">

</head>
<body class="body">
    <nav class="navbar">
        <div class="container-fluid d-flex justify-content-between align-items-center">
            <span class="navbar-brand px-5" style="background: transparent">
                <a class="text-primary text-decoration-none" href="{{url('home')}}">Local Cuisine</a>
            </span>
            <div class="createNewBook">
                <a href="{{route('newBook')}}">+ Add Book</a>
            </div>
            <div class="favoriteBook">
                <a href="">Favorite</a>
            </div>
            <div class="search w-50">
                <span class="search-icon material-symbols-outlined">search</span>
                <input class="searchbox-input outline-0 border-0" style="background: #060C0F" type="search" placeholder="Search" aria-label="Search">
            </div>
            <div class="d-flex px-5">
                <div class="dropdown show">
                    <a class="btn btn-secondary custom-dropdown" href="#" role="link" id="dropdownMenuLink" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        {{$get_userName}}
                        <i class="ms-2 bi bi-chevron-down"></i>
                    </a>

                    <div class="dropdown-menu" aria-labelledby="dropdownMenuLink">
                        <a class="dropdown-item" href="{{route('userprofile')}}">Profile</a>
                        <form action="{{route('logout')}}" method="POST" style="display: inline;">
                            @csrf
                            <button type="submit" class="dropdown-item">Logout</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </nav>

    <!-- @if(session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif -->

    @if(session(success))
    <div class="modal fade show" id="exampleModal" tabindex="-1" role="dialog" style="display: block;" aria-modal="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="title">{{ session('success') }}</h5>
                    <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">Close</button>
                </div>
            </div>
        </div>
    </div>
    @endif

    <!-- <script>
        // Dismiss the modal after 3 seconds
        setTimeout(() => {
            let modal = new bootstrap.Modal(document.getElementById('exampleModal'));
            modal.hide();
        }, 3000);
    </script> -->

    <div class="main">
        <div class="myBooksText">My Books</div>
        <div class="container-User flex">
            @foreach($books as $book)
                <div class="item my-book" data="{{$book->id}}">
                    <img class="coverImg" src="{{ asset('storage/' . $book->coverImage) }}" alt="Cover Image">
                    <div class="info">
                        <a class="title">{{$book->recipeTitle}}</a>
                        <a class="byText" href="">By</a>
                        <p class="author">{{$get_userName}}</p>
                        <div class="rating">
                            <i class="fa-solid fa-star"></i>
                            <i class="fa-solid fa-star"></i>
                            <i class="fa-solid fa-star"></i>
                            <i class="fa-solid fa-star"></i>
                            <i class="fa-solid fa-star"></i>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>

        <div class="myBooksText">Take a look</div>
        <div class="container-User flex">
            @foreach($userWithBooks as $userData)
                @foreach($userData['books'] as $book)
                    <div class="item book-item" data-id="{{$book->id}}">
                        <img class="coverImg" src="{{ asset('storage/' . $book->coverImage) }}" alt="Cover Image">
                        <div class="info">
                            <a class="title">{{ $book->recipeTitle }}</a>
                            <a class="byText">By</a>
                            <p class="author">{{ $userData['username'] }}</p>
                            <div class="rating">
                                <i class="fa-solid fa-star"></i>
                                <i class="fa-solid fa-star"></i>
                                <i class="fa-solid fa-star"></i>
                                <i class="fa-solid fa-star"></i>
                                <i class="fa-solid fa-star"></i>
                            </div>
                        </div>
                    </div>
                @endforeach
            @endforeach
        </div>
    </div>

    <script>
        document.querySelectorAll('.my-book').forEach(item => {
            item.addEventListener('click', function () {
                const bookId = this.getAttribute('data'); // Retrieve the book ID
                window.location.href = '{{ route('book.details', ['id' => '__ID__']) }}'.replace('__ID__', bookId);
            });
        });
    </script>
    
    <script>
        document.querySelectorAll('.book-item').forEach(item => {
            item.addEventListener('click', function () {
                const bookId = this.getAttribute('data-id'); // Retrieve the book ID
                window.location.href = '{{ route('book.details', ['id' => '__ID__']) }}'.replace('__ID__', bookId);
            });
        });
    </script>


<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
</body>
</html>