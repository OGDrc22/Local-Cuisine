<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Home</title>
    <meta name="route-tempate" content="<?php echo e(route('book.details', ['id' => '__ID__'])); ?>">
    <link href="<?php echo e(asset('assets/css/bootstrap.css')); ?>" rel="stylesheet">
    <link href="<?php echo e(asset('assets/css/home.css')); ?>" rel="stylesheet">

    <link rel="apple-touch-icon" sizes="180x180" href="<?php echo e(asset('assets/favicon_io/chefshat.svg')); ?>">
    <link rel="icon" type="image/png" sizes="32x32" href="<?php echo e(asset('assets/favicon_io/chefshat.svg')); ?>">
    <link rel="icon" type="image/png" sizes="16x16" href="<?php echo e(asset('assets/favicon_io/chefshat.svg')); ?>">
    <link rel="manifest" href="<?php echo e(asset('assets/favicon_io/site.webmanifest')); ?>">

    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@24,400,0,0&icon_names=favorite" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">

    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@11/dist/sweetalert2.min.css">

<body class="body">
    <nav class="navbar navbar-expand-lg">

        <div class="container-top-nav container-fluid">
            <div class="left-brand-container">
                <a class="navbar-brand" href="<?php echo e(url('home')); ?>">
                    <img src="<?php echo e(asset('assets/favicon_io/chefshat.svg')); ?>" alt="" srcset="" class="Icon" width="32" height="32">
                    <div class="webname">
                        Local Cuisine
                    </div>
                </a>
            </div>

            <div class="center-actions-container">
                <div class="left-center-action">
                    <a class="nav-link" href="<?php echo e(route('newBook')); ?>"><i class="fa-solid fa-circle-plus"></i> Add Recipe</a>
                </div>

                <div class="center-center-action">
                    <form action="<?php echo e(url('home')); ?>" class="form-search">
                        <span class="search-icon fas fa-search"></span>
                        <input class="searchbox-input" type="search" name="query" placeholder="Search..."
                            aria-label="Search" value="<?php echo e($query); ?>">
                    </form>
                </div>

                <div class="right-center-action">
                    <a class="nav-link" href="<?php echo e(url('favorites')); ?>"><i class="fa-solid fa-bookmark navBtn Icon"></i>Favorites</a>
                </div>
            </div>

            <div class="right-dropdown-container dropdown">
                <button class="dropdown-toggle dropdown-toggle-button d-flex" data-bs-toggle="dropdown" aria-expanded="false">
                    <?php if($get_profilepic == null): ?>
                        <i class="user-nav-icon fa-solid fa-circle-user"></i>
                    <?php else: ?>
                        <img src="<?php echo e(asset('storage/profilepics/' . ($get_profilepic))); ?>" class="user-nav-icon-img" id="current-profile-pic" alt="Profile Picture">                
                    <?php endif; ?>
                    <div class="username_hidden"><?php echo e($get_userName); ?></div>
                </button>
                <ul class="dropdown-menu dropdown-menu-end">
                    <li><a class="navBarActions_dropdown dropdown-item" href="<?php echo e(route('newBook')); ?>">Add Recipe</a></li>
                    <li><a class="navBarActions_dropdown dropdown-item" href="<?php echo e(url('favorites')); ?>"></i>Favorites</a></li>
                    <li><a class="dropdown-item" href="<?php echo e(route('userprofile')); ?>">Profile</a></li>
                    <li><form action="<?php echo e(route('logout')); ?>" method="POST" style="display: inline;">
                            <?php echo csrf_field(); ?>
                            <button type="submit" class="dropdown-item">Logout</button>
                        </form>
                    </li>
                    <li class="border-top"><a class="dropdown-item" href="<?php echo e(route('about')); ?>">About Us</a></li>
                </ul>
            </div>
        </div>
    </nav>

    


    <div class="main">
        <?php if(session()->has('success')): ?>
            <script>
                document.addEventListener('DOMContentLoaded', function() {
                    Swal.fire({
                        title: 'Success!',
                        text: '<?php echo e(session('success')); ?>',
                        icon: 'success',
                        confirmButtonText: 'OK'
                    });
                });
            </script>
        <?php endif; ?>  

        <?php if(session()->has('welcome')): ?>
            <script>
                document.addEventListener('DOMContentLoaded', function() {
                    showSwal({
                        title: '<?php echo e(session('welcome')); ?>',
                        icon: 'success',
                        confirmButtonText: 'OK'
                    });
                });
            </script>
        <?php endif; ?>

        
        <?php if(trim($query) !== ''): ?>
        <div class="container-Search mb-5 accordion-collapse collapse show" id="searchCon">
            <h1 class="searchResultText">Search Results for "<?php echo e($query); ?>":</h1>
            <!-- <div class="line"></div> -->
            <button class="clearBorderedBtn" data-bs-toggle="collapse" data-bs-target="#searchCon" type="button" aria-expanded="false" aria-controls="user_books">
                <i class="fa-solid fa-xmark Icon"></i>
                Clear
            </button>

            <div class="container-Search-Result" ><!--style="background-color: blue"-->

                <?php if($results->isEmpty()): ?>
                    <div class="col">
                        <div class="NoResult mb-3">No results found for <?php echo e($query); ?>.</div>
                    
                        <a class="btnClearFilter" href="<?php echo e(url('home')); ?>"><i class="fa-solid fa-xmark"></i> Clear Search</a>
                    </div>
                    <!-- <?php dd($results); ?> -->
                <?php else: ?>
                    <?php $__currentLoopData = $results; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $book): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <div class="item book-item" data-id="<?php echo e($book->id); ?>">
                            <img class="coverImg" src="<?php echo e(asset('storage/' . $book->coverImage)); ?>" alt="Cover Image">
                            <div class="info">
                                <a class="title"><?php echo e($book->recipeTitle); ?></a>
                                <a class="byText">By</a>
                                <p class="author d-inline"> <?php echo e($book->username); ?></p>
                            </div>
                            <div class="container-rating d-flex align-items-center px-2">

                                <?php
                                    $starsTotal = $book['starsCount'];
                                    $starsFull = floor($starsTotal);
                                    $starsHalf = ($starsTotal - $starsFull) > 0 ? true : false;
                                    $starsNum = number_format($book['starsCount'], 1);
                                ?>

                                <!-- <h1 class="ratingText mb-0">Ratings: </h1> -->
                                <div class="rating-owner d-flex d-inline justify-content-center">
                                    
                                    <?php for($i = $starsTotal+1; $i <= 5; $i++): ?>
                                        <label for="Star" title="<?php echo e($starsNum); ?> stars" class="fa-solid fa-star starRatedEmpty"></label>                     
                                    <?php endfor; ?>

                                    <?php if($starsHalf): ?>
                                        <label for="Star" title="<?php echo e($starsNum); ?> stars" class="fa-solid fa-star-half-stroke starRated"></label>
                                    <?php endif; ?>

                                    <?php for($i = 1; $i <= $starsTotal; $i++): ?>
                                        <label for="Star" title="<?php echo e($starsNum); ?> stars" class="fa-solid fa-star starRated"></label>
                                    <?php endfor; ?>
                                    
                                    
                                </div>
                                <h1 class="rates ms-2 mb-0 mt-1 starsNum">(<?php echo e($starsNum); ?>)</h1>
                                <h1 class="rates ms-2 mb-0 mt-1 d-inline"> <?php echo e($book['ratings']); ?> Ratings</h1>
                            </div>
                        </div>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                <?php endif; ?>
            </div>
        </div>
        <?php endif; ?>


            <!-- 1st Container with Horizontal Scroll -->
        <div class="user_books d-flex align-items-center">
            <div class="welcomeText me-2">My Books</div><div class="bookNumText d-inline">(<?php echo e($books->count()); ?>)</div>
            <div class="line"></div>
            <button class="nav-link dropdown-toggle dropdown-toggle-light-color dropdown-toggle-button px-2" id="show_hide_btn" data-bs-toggle="collapse" data-bs-target="#user_books" type="button" aria-expanded="false" aria-controls="user_books">Show</button>
        </div>
        <div class="container-User collapse" id="user_books">
            <!-- 1st Scroll-->
            <?php $__currentLoopData = $books; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $book): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <div class="item book-item" data-id="<?php echo e($book->id); ?>">
                    <img class="coverImg" src="<?php echo e(asset('storage/' . $book->coverImage)); ?>" alt="Cover Image">
                    <div class="info">
                        <a class="title"><?php echo e($book->recipeTitle); ?></a>
                        <a class="byText">By</a>
                        <p class="author d-inline"> <?php echo e($book->username); ?></p>

                    </div>
                    <div class="container-rating d-flex align-items-center px-2">

                        <?php
                            $starsTotal = $book['starsCount'];
                            $starsFull = floor($starsTotal);
                            $starsHalf = ($starsTotal - $starsFull) > 0 ? true : false;
                            $starsNum = number_format($book['starsCount'], decimals: 1);
                        ?>

                        <!-- <h1 class="ratingText mb-0">Ratings: </h1> -->
                        <div class="rating-owner d-flex d-inline">
                            
                            <?php for($i = $starsTotal+1; $i <= 5; $i++): ?>
                                <label for="Star" title="<?php echo e($starsNum); ?> stars" class="fa-solid fa-star starRatedEmpty"></label>                     
                            <?php endfor; ?>

                            <?php if($starsHalf): ?>
                                <label for="Star" title="<?php echo e($starsNum); ?> stars" class="fa-solid fa-star-half-stroke starRated"></label>
                            <?php endif; ?>

                            <?php for($i = 1; $i <= $starsTotal; $i++): ?>
                                <label for="Star" title="<?php echo e($starsNum); ?> stars" class="fa-solid fa-star starRated"></label>
                            <?php endfor; ?>
                            
                            
                        </div>
                        <h1 class="rates ms-2 mb-0 mt-1 starsNum">(<?php echo e($starsNum); ?>)</h1>
                        <h1 class="rates ms-2 mb-0 mt-1 d-inline"> <?php echo e($book['ratings']); ?> Ratings</h1>
                    </div>
                </div>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
        </div>



        <!-- 2nd Container Vertical Scroll -->
        <div class="container-Home" id="containerView">
            <div class="header-home d-flex mt-5 align-items-center">
                
                <?php if($category != null): ?>
                    <div class="welcomeText categoryText"><?php echo e($category); ?></div>
                <?php else: ?>
                    <div class="welcomeText">Home</div>
                <?php endif; ?>
                
                <div class="line"></div>

                <div class="navbar-nav justify-content-end align-content-center">
                    <li class="nav-item dropdown">
                        <button class="nav-link dropdown-toggle dropdown-toggle-light-color filter text-center px-2" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                            Filter
                            <i class="fa-solid fa-filter"></i>
                        </button>
                        <ul class="dropdown-menu">
                            <li>
                                <?php if($category != null): ?>
                                    <a class="dropdown-item" href="<?php echo e(url('home')); ?>"><i class="fa-solid fa-xmark"></i> Clear Filter</a>
                                <?php endif; ?>
                            </li>
                            <li><a class="dropdown-item" href="<?php echo e(route('home.custom', ['category' => 'Appetizers'])); ?> #containerView">Appetizers</a></li>
                            <li><a class="dropdown-item" href="<?php echo e(route('home.custom', ['category' => 'Side Dishes'])); ?> #containerView">Side Dishes</a></li>
                            <li><a class="dropdown-item" href="<?php echo e(route('home.custom', ['category' => 'Main Courses'])); ?> #containerView">Main Courses</a></li>
                            <li><a class="dropdown-item" href="<?php echo e(route('home.custom', ['category' => 'Desserts'])); ?> #containerView">Desserts</a></li>
                            <li><a class="dropdown-item" href="<?php echo e(route('home.custom', ['category' => 'Beverages'])); ?> #containerView">Beverages</a></li>
                            <li><a class="dropdown-item" href="<?php echo e(route('home.custom', ['category' => 'Soups'])); ?> #containerView">Soups</a></li>
                            <li><a class="dropdown-item" href="<?php echo e(route('home.custom', ['category' => 'Salads'])); ?> #containerView">Salads</a></li>
                            <li><a class="dropdown-item" href="<?php echo e(route('home.custom', ['category' => 'Breakfasts'])); ?> #containerView">Breakfasts</a></li>
                            <li><a class="dropdown-item" href="<?php echo e(route('home.custom', ['category' => 'Snacks'])); ?> #containerView">Snacks</a></li>
                            <li><a class="dropdown-item" href="<?php echo e(route('home.custom', ['category' => 'Bread and Pastries'])); ?> #containerView">Bread and Pastries</a></li>
                        </ul>
                    </li>
                </div>
            </div>


            <?php if($category != null && $check == false): ?>
                <div class="NoResult mb-3">No results for <?php echo e($category); ?></div>
                <a class="clearBorderedBtn" href="<?php echo e(url('home')); ?>"><i class="fa-solid fa-xmark"></i> Clear Filter</a>
            <?php endif; ?>

             <!-- Categorized Books -->
            <div class="container-User">

            <?php $__currentLoopData = $categorizedBooks; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $book): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <div class="item book-item" data-id="<?php echo e($book->id); ?>">
                    <img class="coverImg" src="<?php echo e(asset('storage/' . $book->coverImage)); ?>" alt="Cover Image">
                    <div class="info">
                        <a class="title"><?php echo e($book->recipeTitle); ?></a>
                        <!-- <a class="byText">By</a> -->
                        <p class="author">By <?php echo e($book->username); ?></p>

                    </div>
                    <div class="container-rating d-flex align-items-center px-2">

                        <?php
                            $starsTotal = $book['starsCount'];
                            $starsFull = floor($starsTotal);
                            $starsHalf = ($starsTotal - $starsFull) > 0 ? true : false;
                            $starsNum = number_format($book['starsCount'], 1);
                        ?>

                        <!-- <h1 class="ratingText mb-0">Ratings: </h1> -->
                        <div class="rating-owner d-flex d-inline">
                            
                            <?php for($i = $starsTotal+1; $i <= 5; $i++): ?>
                                <label for="Star" title="<?php echo e($starsNum); ?> stars" class="fa-solid fa-star starRatedEmpty"></label>                     
                            <?php endfor; ?>

                            <?php if($starsHalf): ?>
                                <label for="Star" title="<?php echo e($starsNum); ?> stars" class="fa-solid fa-star-half-stroke starRated"></label>
                            <?php endif; ?>

                            <?php for($i = 1; $i <= $starsTotal; $i++): ?>
                                <label for="Star" title="<?php echo e($starsNum); ?> stars" class="fa-solid fa-star starRated"></label>
                            <?php endfor; ?>
                            
                            
                        </div>
                            <h1 class="rates ms-2 mb-0 mt-1 starsNum">(<?php echo e($starsNum); ?>)</h1>
                            <h1 class="rates ms-2 mb-0 mt-1 d-inline"> <?php echo e($book['ratings']); ?> Ratings</h1>
                    </div>
                </div>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>

            </div>

            <?php if($category == null): ?>
                <div class="container-User">
                
                    <!-- Content container for cards -->
                    
                    <!-- Recommendations -->
                    <?php $__currentLoopData = $recommendedBooks; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $book): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <div class="item book-item" data-id="<?php echo e($book->id); ?>">
                            <img class="coverImg" src="<?php echo e(asset('storage/' . $book->coverImage)); ?>" alt="Cover Image">
                            <div class="info">
                                <a class="title"><?php echo e($book->recipeTitle); ?></a>
                                <!-- <a class="byText">By</a> -->
                                <p class="author">By <?php echo e($book->username); ?></p>

                            </div>
                            <div class="recommended">
                                <p class="recommendedText">Recommended</p>
                                <div class="container-rating d-flex align-items-center px-2">

                                    <?php
                                        $starsTotal = $book['starsCount'];
                                        $starsFull = floor($starsTotal);
                                        $starsHalf = ($starsTotal - $starsFull) > 0 ? true : false;
                                        $starsNum = number_format($book['starsCount'], 1);
                                    ?>

                                    <!-- <h1 class="ratingText mb-0">Ratings: </h1> -->
                                    <div class="rating-owner d-flex d-inline">
                                        
                                        <?php for($i = $starsTotal+1; $i <= 5; $i++): ?>
                                            <label for="Star" title="<?php echo e($starsNum); ?> stars" class="fa-solid fa-star starRatedEmpty"></label>                     
                                        <?php endfor; ?>

                                        <?php if($starsHalf): ?>
                                            <label for="Star" title="<?php echo e($starsNum); ?> stars" class="fa-solid fa-star-half-stroke starRated"></label>
                                        <?php endif; ?>

                                        <?php for($i = 1; $i <= $starsTotal; $i++): ?>
                                            <label for="Star" title="<?php echo e($starsNum); ?> stars" class="fa-solid fa-star starRated"></label>
                                        <?php endfor; ?>
                                        
                                        
                                    </div>
                                        <h1 class="rates ms-2 mb-0 mt-1 starsNum">(<?php echo e($starsNum); ?>)</h1>
                                        <h1 class="rates ms-2 mb-0 mt-1 d-inline"> <?php echo e($book['ratings']); ?> Ratings</h1>
                                </div>
                            </div>
                        </div>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        
                    <!-- All Books -->
                    <?php $__currentLoopData = $userWithBooks; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $book): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <div class="item book-item" data-id="<?php echo e($book->id); ?>">
                            <img class="coverImg" src="<?php echo e(asset('storage/' . $book->coverImage)); ?>" alt="Cover Image">
                            <div class="info">
                                <a class="title"><?php echo e($book->recipeTitle); ?></a>
                                <a class="byText">By</a>
                                <p class="author d-inline"> <?php echo e($book->username); ?></p>

                            </div>
                            <div class="container-rating d-flex align-items-center px-2">

                                <?php
                                    $starsTotal = $book['starsCount'];
                                    $starsFull = floor($starsTotal);
                                    $starsHalf = ($starsTotal - $starsFull) > 0 ? true : false;
                                    $starsNum = number_format($book['starsCount'], 1);
                                ?>

                                <!-- <h1 class="ratingText mb-0">Ratings: </h1> -->
                                <div class="rating-owner d-flex d-inline justify-content-center">
                                    
                                    <?php for($i = $starsTotal+1; $i <= 5; $i++): ?>
                                        <label for="Star" title="<?php echo e($starsNum); ?> stars" class="fa-solid fa-star starRatedEmpty"></label>                     
                                    <?php endfor; ?>

                                    <?php if($starsHalf): ?>
                                        <label for="Star" title="<?php echo e($starsNum); ?> stars" class="fa-solid fa-star-half-stroke starRated"></label>
                                    <?php endif; ?>

                                    <?php for($i = 1; $i <= $starsTotal; $i++): ?>
                                        <label for="Star" title="<?php echo e($starsNum); ?> stars" class="fa-solid fa-star starRated"></label>
                                    <?php endfor; ?>
                                    
                                    
                                </div>
                                <h1 class="rates ms-2 mb-0 mt-1 starsNum">(<?php echo e($starsNum); ?>)</h1>
                                <h1 class="rates ms-2 mb-0 mt-1 d-inline"> <?php echo e($book['ratings']); ?> Ratings</h1>
                            </div>
                        </div>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                </div>
            <?php endif; ?>
                
        </div>
    </div>

    
    <!-- <script>
        document.querySelectorAll('.book-item').forEach(item => {
            item.addEventListener('click', function () {
                const bookId = this.getAttribute('data-id'); // Retrieve the book ID
                window.location.href = '<?php echo e(route('book.details', ['id' => '__ID__'])); ?>'.replace('__ID__', bookId);
            });
        });
    </script> -->


    <script src="<?php echo e(asset('assets/js/home.js')); ?>"></script>
    <script src="<?php echo e(asset('assets/js/bookSelection.js')); ?>"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz"
        crossorigin="anonymous"></script>

    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11/dist/sweetalert2.all.min.js"></script>
</body>

<footer>
    <hr class="footerLine">
    <div class="footer">
        <div class="container-fluid d-flex justify-content-center align-items-center">
            <a class="col navbar-brand justify-content-center align-content-center text-center m-0" href="<?php echo e(url('/')); ?>">
                <img src="<?php echo e(asset('assets/favicon_io/chefshat.svg')); ?>" alt="" srcset="" class="Icon" width="32" height="32">
                Local Cuisine
            </a>
        </div>
    </div>
    <div class="footerText">
        <p>© 2025 Local Cuisine. All rights reserved.</p>
        <div class="footerAcknowledgment">
            <a href="" target="">
                <img src="<?php echo e(asset('assets/Images/ACIM.svg')); ?>" height="48">
            </a>
            <a href="https://laravel.com/">
                <img src="<?php echo e(asset('assets/Images/laravel.svg')); ?>" height="48">
            </a>
            <a href="https://fontawesome.com/" target="_blank">
                <img src="<?php echo e(asset(('assets/Images/fontawesome.svg'))); ?>" height="48">
            </a>
        </div>
    </div>
</footer>

</html><?php /**PATH C:\xampp\htdocs\main_finalproject\resources\views/home.blade.php ENDPATH**/ ?>