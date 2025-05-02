<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Dashboard</title>
    <link href="{{asset('assets/css/bootstrap.css')}}" rel="stylesheet">
    <link href="{{asset('assets/css/admin.css')}}" rel="stylesheet">

    <link rel="apple-touch-icon" sizes="180x180" href="{{asset('assets/favicon_io/chefshat.png')}}">
    <link rel="icon" type="image/png" sizes="32x32" href="{{asset('assets/favicon_io/chefshat.png')}}">
    <link rel="icon" type="image/png" sizes="16x16" href="{{asset('assets/favicon_io/chefshat.png')}}">
    <link rel="manifest" href="{{asset('assets/favicon_io/site.webmanifest')}}">

    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@24,400,0,0&icon_names=favorite" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">

<body class="body">
        
    @if (session('success'))
                <div class="alert alert-success floating-alert" role="alert">
                    <h5 class="modal-title">{{ session('success') }}</h5>
                </div>
    @endif
    <nav class="navbar  navbar-expand-lg">
        <div class="container-fluid">


            <div class="collapse navbar-collapse d-flex">
                
                <a class="col navbar-brand justify-content-center align-content-center text-center m-0" href="{{url('home')}}">
                    <img src="{{asset('assets/favicon_io/chefshat.svg')}}" alt="" srcset="" class="Icon" width="32" height="32">
                    Local Cuisine
                </a>

                <div class="col navbar-nav d-flex justify-content-center align-content-center">
                    <a class="nav-link navBtn w-75 text-center" href="{{route('newBook')}}"><i class="fa-solid fa-circle-plus"></i> Add Recipe</a>
                    <!-- <a class="nav-link navBtn d-flex justify-content-center p-2" href="{{url('favorites')}}"><i class="fa-solid fa-bookmark navBtn Icon"></i>Favorites</a> -->
                </div>

                <form class="search col-5 justify-content-center align-content-center" id="search-form">
                    <span class="search-icon fas fa-search"></span>
                    <input class="searchbox-input outline-0 border-0 ms-1" type="text" name="query" placeholder="Search..."
                        aria-label="Search">
                        <!-- <button type="submit">Search</button> -->
                </form>

                <!-- <button onclick="searchText()">Search</button> -->

                <div class="col navbar-nav d-flex justify-content-center align-content-center">
                    <!-- <a class="nav-link navBtn" href="{{route('newBook')}}">+ Add Recipe</a> -->
                    <a class="nav-link navBtn d-flex justify-content-center align-content-center p-2 w-75" href="{{url('favorites')}}"><i class="fa-solid fa-bookmark navBtn Icon"></i>Favorites</a>
                </div>

                <div class="col navbar-nav ms-auto justify-content-center align-content-center">
                    <li class="nav-item dropdown w-75">
                        <a class="nav-link dropdown-toggle text-center" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                            {{$get_userName}} - {{$userType}}
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

    <div class="main d-flex">
        <div class="col-1">
            <aside class="sidebar">
                <ul>
                    <li class="{{request()->is('home/tables/*') ? 'active' : ''}}">
                        <a href="{{route('home.tables.overview')}}"><i class="fa-solid fa-table Icon me-2"></i>Table</a>
                    </li>
                    <li class="{{request()->is('home/admin') ? 'active' : ''}}">
                        <a href="{{route('home.admin')}}"><i class="fa-solid fa-house Icon me-2"></i>Home</a>
                    </li>
                    <li class="{{request()->is('home/settings') ? 'active' : ''}}">
                        <a href="{{route('home.settings')}}"><i class="fa-solid fa-gear Icon me-2"></i>Settings</a>
                    </li>
                </ul>
            </aside>
        </div>
        
        
        <div class="main-content col">
            @yield('main-content')
        </div>

        
    </div>

    <div class="popup-image">
        <img src="" alt="popup">
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
                    <button type="button" class="btn btn-secondary btnAdminCancelM" data-bs-dismiss="modal">Cancel</button>
                    <button type="button" class="btn btn-primary btnAdminSubM" id="confirmSubmit">Save Changes</button>
                </div>
            </div>
        </div>
    </div>


    

    <script>

        const currentPath = window.location.pathname;
        const desiredDestination = "/home/tables/overview"; // Absolute path for the redirection

        if (currentPath.endsWith("/home") || currentPath.endsWith("/home/tables")) {
            // Redirect to the correct route if conditions match
            window.location.href = desiredDestination;
        }

        document.getElementById('openModal').addEventListener('click', function () {
            // Open the modal
            const modal = new bootstrap.Modal(document.getElementById('confirmationModal'));
            modal.show();
        });

        document.getElementById('confirmSubmit').addEventListener('click', function () {
            // Submit the form after confirmation
            document.getElementById('adminEdit').submit();
        });
    
        document.querySelectorAll('.btnAdminSub').forEach(button => {
            button.addEventListener('click', function () {
                let activeForm = document.activeElement.closest('form'); // Get the closest form related to the button
                if (activeForm) {
                    activeForm.submit();
                }
            });
        });

        document.querySelectorAll('td img').forEach(image => {
            image.onclick = () =>  {
                document.querySelector('.popup-image').style.display = 'block';
                document.querySelector('.popup-image img').src = image.getAttribute('src');
            }
        });

        document.querySelector('.popup-image').onclick = () => {
            document.querySelector('.popup-image').style.display = 'none';
        };

        document.addEventListener('keydown', function(e) {
            if (e.key == "Escape") {
                document.querySelector('.popup-image').style.display = 'none';
            }
        });


        // Get all <textarea> elements
        const elementsTA = document.querySelectorAll('.input-field-big');
        const elementsINPT = document.querySelectorAll('.inpt');
        const textarea = document.querySelectorAll('.col-3 .input-field-big');
        const actionAdminC = document.querySelector('.btnAdminCancel');
        const actionAdminS = document.querySelector('.btnAdminSub');
        // const cancelAction = document.querySelector('.cancelAction');

        textarea.forEach(inpt => {
            inpt.addEventListener('dblclick', () => {
                inpt.removeAttribute('readonly');
                inpt.style.backgroundColor = '#80ffb1';
                actionAdminC.removeAttribute('disabled');
                actionAdminS.removeAttribute('disabled');
            });
        });
        
        elementsINPT.forEach(inpt => {
            inpt.addEventListener('dblclick', () => {
                inpt.removeAttribute('readonly');
                inpt.style.backgroundColor = '#80ffb1';
                actionAdminC.removeAttribute('disabled');
                actionAdminS.removeAttribute('disabled');
            });
        });

        actionAdminC.onclick = () => {
            actionAdminC.setAttribute('disabled', true);
            actionAdminS.setAttribute('disabled', true);
            // window.alert('Clicked!');
            textarea.forEach(inpt => {
                inpt.setAttribute('readonly', true);
                inpt.style.backgroundColor = 'transparent';
            });
            
            elementsINPT.forEach(inpt => {
                inpt.setAttribute('readonly', true);
                inpt.style.backgroundColor = 'transparent';
            });
        };

        document.addEventListener('DOMContentLoaded', () => {
            const searchForm = document.getElementById('search-form');
            const searchInput = document.querySelector('.searchbox-input');

            searchForm.addEventListener('submit', e => {
                e.preventDefault();

                const pathname = window.location.pathname;
                
                const searchTextVal = searchInput.value.trim();
                // Escape special characters for regex
                const escapedText = searchTextVal.replace(/[.*+?^${}()|[\]\\]/g, "\\$&");
                const pattern = new RegExp(escapedText, "gi");



                if (pathname.includes('home/tables')) {
                    
                    // const allText = document.querySelector('.table tbody');
                    // allText.innerHTML = allText.textContent.replace(
                    //     pattern,
                    //     match => `<mark>${match}</mark>`
                    // );
                    elementsTA.forEach(element => {
                        if (element.tagName === 'DIV') {
                            // alert('break');

                            element.innerHTML = element.textContent.replace(
                                pattern,
                                match => `<mark>${match}</mark>`
                            );

                        } else if (element.tagName === 'TEXTAREA') {
                            //Create a new <div> element
                            const div = document.createElement('div');

                            // Highlight matching text in the element's value
                            const highlightedContent = element.value.replace(
                                pattern,
                                match => `<mark>${match}</mark>` // Wrap matches in <mark>
                            );

                            // Set the highlighted content as innerHTML
                            div.innerHTML = highlightedContent;

                            // Copy styles from <element> to <div>
                            div.style.cssText = window.getComputedStyle(element).cssText;

                            // Set the same class and attributes
                            div.className = element.className;
                            div.contentEditable = true; // Allow editing, like a element
                            div.style.whiteSpace = "pre-wrap"; // Preserve line breaks and spaces

                            // Replace the <element> with the new <div>
                            element.parentNode.replaceChild(div, element);
                            // alert('Search and highlight complete!');
                        }
                        // alert('called');
                    });
                    // );
                    elementsINPT.forEach(element => {
                        if (element.tagName === 'DIV') {
                            // alert('break');

                            element.innerHTML = element.textContent.replace(
                                pattern,
                                match => `<mark>${match}</mark>`
                            );

                        } else if (element.tagName === 'INPUT') {
                            //Create a new <div> element
                            const div = document.createElement('div');

                            // Highlight matching text in the element's value
                            const highlightedContent = element.value.replace(
                                pattern,
                                match => `<mark>${match}</mark>` // Wrap matches in <mark>
                            );

                            // Set the highlighted content as innerHTML
                            div.innerHTML = highlightedContent;

                            // Copy styles from <element> to <div>
                            div.style.cssText = window.getComputedStyle(element).cssText;
                            div.style.display = 'inline';

                            // Set the same class and attributes
                            div.className = element.className;
                            div.contentEditable = true; // Allow editing, like a element
                            div.style.whiteSpace = "pre-wrap"; // Preserve line breaks and spaces

                            // Replace the <element> with the new <div>
                            element.parentNode.replaceChild(div, element);
                            // alert('Search and highlight complete!');
                        }
                        // alert('called');
                    });

                } else {
                    searchForm.action = "{{url('home/admin')}}"
                }
                // alert('called');
            });


            

            // Attach the function to a button
        });

        // Table Option

        document.querySelectorAll('.tablesDB .nav-link').forEach(link => {
            link.addEventListener('click', function() {
                // Remove active class from all tabs
                document.querySelectorAll('.tablesDB .nav-link').forEach(item => {
                    item.classList.remove('active');
                });

                // Add active class to the clicked tab
                this.classList.add('active');
            });
        });

        // document.addEventListener("DOMContentLoaded", function () {
        //     // Loop through the links to find the active one
        //     const activeLink = document.querySelector(".tablesDB .nav-link.active");

        //     // Ensure an active link exists and its href differs from the current route
        //     if (activeLink) {
        //         const currentPath = window.location.pathname;
        //         const desiredDestination = "/home/tables/overview"; // Absolute path for the redirection

        //         if (currentPath.endsWith("/home") || currentPath.endsWith("/home/tables")) {
        //             // Redirect to the correct route if conditions match
        //             window.location.href = desiredDestination;
        //         }
        //     }
        // });

        
    </script>

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