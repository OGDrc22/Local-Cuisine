<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>LC Profile</title>
    <link href="{{asset('assets/css/bootstrap.css')}}" rel="stylesheet">
    <link href="{{asset('assets/css/home.css')}}" rel="stylesheet">

    <link rel="stylesheet"
        href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@24,400,0,0&icon_names=search" />
    <link rel="stylesheet"
        href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@24,400,0,0&icon_names=favorite" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">

<body class="body">
    <nav class="navbar  navbar-expand-lg">
        <div class="container-fluid">

            <a class="navbar-brand" href="{{url('home')}}">Local Cuisine</a>

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
                            <li class="border-top"><a class="dropdown-item" href="{{route('about')}}">About Us</a></li>
                        </ul>
                    </li>
                </div>
            </div>
        </div>
    </nav>


    <div class="main">
            <!-- 1st Container with Horizontal Scroll -->
        @if (session('success'))
            <div class="alert alert-success floating-alert" role="alert">
                <h5 class="modal-title">{{ session('success') }}</h5>
            </div>
        @endif
        <div class="welcomeText">My Books</div>
        <div class="container container-User flex scroll-container1" id="container1">
            <!-- 1st Scroll-->
            <!-- <div class="content" id="content1"> -->
                <!-- Card 1 -->
                @foreach($books as $book)
                    <div class="item my-book card" data="{{$book->id}}">
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



            <!-- </div> -->
        </div>



        <!-- 2nd Container Vertical Scroll -->
        <div class="welcomeText mt-5">Home</div>
        <div class="container container-User flex" id="container2">

            <!-- Content container for cards -->
            <!-- <div class="content" id="content2"> -->
                @foreach($userWithBooks as $userData)
                    @foreach($userData['books'] as $book)
                        <div class="item book-item card" data-id="{{$book->id}}">
                            <img class="coverImg" src="{{ asset('storage/' . $book->coverImage) }}" alt="Cover Image">
                            <div class="info">
                                <a class="title">{{ $book->recipeTitle }}</a>
                                <a class="byText">By</a>
                                <p class="author">{{ $userData['username'] }}</p>
                                
                            </div>
                            <div class="rating">
                                <i class="fa-solid fa-star"></i>
                                <i class="fa-solid fa-star"></i>
                                <i class="fa-solid fa-star"></i>
                                <i class="fa-solid fa-star"></i>
                                <i class="fa-solid fa-star"></i>
                            </div>
                        </div>
                    @endforeach
                @endforeach

            <!-- </div> -->
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


    <script src="{{ asset('assets/js/home.js') }}"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz"
        crossorigin="anonymous"></script>
</body>

</html>