<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="<?php echo e(csrf_token()); ?>">

    <title><?php echo e($book->recipeTitle); ?></title>
    <link href="<?php echo e(asset('assets/css/bootstrap.css')); ?>" rel="stylesheet">
    <link href="<?php echo e(asset('assets/css/openBook.css')); ?>" rel="stylesheet">

    <link rel="apple-touch-icon" sizes="180x180" href="<?php echo e(asset('assets/favicon_io/chefshat.svg')); ?>">
    <link rel="icon" type="image/png" sizes="32x32" href="<?php echo e(asset('assets/favicon_io/chefshat.svg')); ?>">
    <link rel="icon" type="image/png" sizes="16x16" href="<?php echo e(asset('assets/favicon_io/chefshat.svg')); ?>">
    <link rel="manifest" href="<?php echo e(asset('assets/favicon_io/site.webmanifest')); ?>">

    <link rel="stylesheet"
        href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@24,400,0,0&icon_names=search" />
    <link rel="stylesheet"
        href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@24,400,0,0&icon_names=favorite" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    <link rel="stylesheet"
        href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@24,400,0,0&icon_names=send" />

    
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@11/dist/sweetalert2.min.css">

<body class="body">
    <nav class="navbar navbar-expand-lg">

    <div class="container-top-nav container-fluid">
            <div class="left-brand-container">
                <a class="navbar-brand" href="<?php echo e(route('home.custom')); ?>">
                    <img src="<?php echo e(asset('assets/favicon_io/chefshat.svg')); ?>" alt="" srcset="" class="Icon" width="32" height="32">
                    <div class="webname">
                        Local Cuisine
                    </div>
                </a>
            </div>

            <div class="center-actions-container">
                <div class="left-center-action">
                    <?php if($get_userName != 0): ?>
                        <a class="nav-link" href="<?php echo e(route('newBook')); ?>"><i class="fa-solid fa-circle-plus"></i> Add Recipe</a>
                    <?php endif; ?>
                </div>

                <div class="center-center-action">
                    
                </div>

                <div class="right-center-action">
                    <?php if($get_userName != 0): ?>
                        <a class="nav-link" href="<?php echo e(url('favorites')); ?>"><i class="fa-solid fa-bookmark Icon"></i>Favorites</a>
                    <?php endif; ?>
                </div>
            </div>

            
            <?php if($get_userName != 0): ?>
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
                        <li><a class="hidden_at_large_screen dropdown-item" href="<?php echo e(route('newBook')); ?>">Add Recipe</a></li>
                        <li><a class="hidden_at_large_screen dropdown-item" href="<?php echo e(url('favorites')); ?>"></i>Favorites</a></li>
                        <li><a class="dropdown-item" href="<?php echo e(route('userprofile')); ?>">Profile</a></li>
                        <li><form action="<?php echo e(route('logout')); ?>" method="POST" style="display: inline;">
                                <?php echo csrf_field(); ?>
                                <button type="submit" class="dropdown-item">Logout</button>
                            </form>
                        </li>
                        <li class="border-top"><a class="dropdown-item" href="<?php echo e(route('about')); ?>">About Us</a></li>
                    </ul>
                </div>
            <?php else: ?>
                <div class="right-dropdown-container dropdown">
                    <a class="hidden_at_small_screen LRPage" href="<?php echo e(url('registernewuser')); ?>">Login/Register</a>
                    <button class="hidden_at_large_screen dropdown-toggle dropdown-toggle-button" data-bs-toggle="dropdown"
                        aria-expanded="false">
                        <i class="fa-solid fa-right-to-bracket Icon"></i>
                        <div class="username_hidden">Login/Register</div>
                    </button>
                    <ul class="dropdown-menu dropdown-menu-end">
                        <li><a class="dropdown-item LRPage" href="<?php echo e(url('registernewuser')); ?>">Login/Register</a></li>
                        <li><a class="dropdown-item about" href="<?php echo e(route('about')); ?>">About Us</a></li>
                    </ul>
                </div>
                
                <div class="right-dropdown-container dropdown hidden_at_small_screen">
                    <div class="col">
                        <a class="about mx-3 d-inline" href="<?php echo e(route('about')); ?>">About Us</a>
                    </div>
                </div>
            <?php endif; ?>
            
        </div>
    </nav>


    <!-- Main Container -->
    <div class="main">
        <?php if(session()->has('added')): ?>
            <script>
                document.addEventListener('DOMContentLoaded', function() {
                    Swal.fire({
                        title: '<?php echo e(session('added')); ?>',
                        text: 'Go to Favorites tab to see!',
                        icon: 'success',
                        confirmButtonText: 'OK'
                    });
                });
            </script>
        <?php endif; ?>

        <?php if(session()->has('removed')): ?>
            <script>
                document.addEventListener('DOMContentLoaded', function() {
                    Swal.fire({
                        title: '<?php echo e(session('removed')); ?>',
                        text: 'Book has beed removed!',
                        icon: 'success',
                        confirmButtonText: 'OK'
                    });
                });
            </script>
        <?php endif; ?>

        <script>
            document.addEventListener("DOMContentLoaded", function () {
                const message = sessionStorage.getItem("ratingMessage");
                if (message) {
                    Swal.fire({
                        icon: 'success',
                        title: 'Success!',
                        text: message,
                        timer: 3000,
                        showConfirmButton: false
                    });
                    sessionStorage.removeItem("ratingMessage"); // Clear it after showing
                }
            });
        </script>


        <?php if(session('error')): ?>
            <div class="alert alert-success floating-alert" role="alert">
                <h5 class="modal-title"><?php echo e(session('error')); ?></h5>
            </div>
        <?php endif; ?>


        <div class="alert alert-success floating-alert d-none" role="alert">
            <!-- For Favorites -->
        </div>

        <?php if(session(key: 'message')): ?>
            <div class="alert alert-success floating-alert d-none" role="alert">
                <h5 class="modal-title"><?php echo e(session('message')); ?></h5>
            </div>
        <?php endif; ?>
        <!-- Changed: Used Bootstrap grid system (row and columns) to structure layout -->

        <div class="row m-0 p-0">
            <img class="coverImg" src="<?php echo e(asset('storage/' . $book->coverImage)); ?>" alt="Cover Image">
        </div>


        <div class="container-info grid-container">
            <!-- Left column: Title of your Recipe -->
            <div class="col">
                <div class="viewTextTitle align-items-center">
                    <h1 type="text" class="Title my-0"><?php echo e($book->recipeTitle); ?></h1>
                </div>
                <a class="byText">By</a>
                <p class="author d-inline"> <?php echo e($ownerName); ?></p>
                <!-- <div class="d-flex"><h1 class="ownerText align-self-center p-0 my-0">By <?php echo e($ownerName); ?></h1></div> -->
                <div class="moreInfo">
                    <a class="byText">Recipe Origin</a>
                    <p class="author d-inline"><?php echo e($book->recipeOrigin); ?></p>
                </div>
            </div>

            <!-- Actions -->
            <div class="align-items-center pb-2">

                <div class="container-rating container-fluid align-items-center ps-0">

                    <?php
                        $starsTotal = $book['starsCount'];
                        $starsFull = floor($starsTotal);
                        $starsHalf = ($starsTotal - $starsFull) > 0 ? true : false;
                        $starsNum = number_format($book['starsCount'], 1);
                    ?>


                    <h1 class="ratingText">Ratings: </h1>

                    <div class="rating-owner">

                        <?php for($i = $starsTotal + 1; $i <= 5; $i++): ?>
                            <label for="Star" title="<?php echo e($starsNum); ?> stars" class="fa-solid fa-star starRatedEmpty"></label>
                        <?php endfor; ?>

                        <?php if($starsHalf): ?>
                            <label for="Star" title="<?php echo e($starsNum); ?> stars"
                                class="fa-solid fa-star-half-stroke starRated"></label>
                        <?php endif; ?>

                        <?php for($i = 1; $i <= $starsTotal; $i++): ?>
                            <label for="Star" title="<?php echo e($starsNum); ?> stars" class="fa-solid fa-star starRated"></label>
                        <?php endfor; ?>

                    </div>
                    <div class="rateInfo">
                        <h1 class="rates starsNum"><?php echo e($starsNum); ?></h1>
                        <h1 class="rates ratersSum"> <?php echo e($book['ratings']); ?> Ratings</h1>
                    </div>
                    <!-- <h1 class="rates ms-2 mb-0 mt-1">(<?php echo e($starsCount); ?> Stars) <?php echo e($rates->count()); ?> Ratings</h1> -->
                </div>

                <div class="d-flex align-items-center buttonContainer justify-content-start">

                    <button type="button" id="openDownloadAlert" class="actionBtn">
                        <i class="fa-solid fa-download Icon action-icon"></i>
                        <div class="action_name">
                            Download
                        </div>
                    </button>
                    



                    <?php if($bookFav): ?>
                        <form id="removeFavForm" action="/remove_favorite" method="POST" title="Remove to Favorites">
                            <?php echo csrf_field(); ?>
                            <div class="container-form">
                                <input name="userId" class="d-none" value="<?php echo e($get_userId); ?>">
                                <input name="bookId" class="d-none" value="<?php echo e($book->id); ?>">
                            </div>
                            <button class="actionBtn text-decoration-none text-center" type="submit">
                                <i class="fa-solid fa-bookmark Icon action-icon"></i>
                                <div class="action_name">
                                    Favorites
                                </div>
                            </button>
                        </form>
                    <?php else: ?>
                        <?php if($get_userName != 0): ?>
                            <form id="addFavForm" action="/add_favorite" method="POST" title="Add to Favorites">
                                <?php echo csrf_field(); ?>
                                <div class="container-form">
                                    <input name="userId" class="d-none" value="<?php echo e($get_userId); ?>">
                                    <input name="bookId" class="d-none" value="<?php echo e($book->id); ?>">
                                </div>
                                <button class="actionBtn text-decoration-none text-center" type="submit">
                                    <i class="fa-regular fa-bookmark Icon"></i>
                                    <div class="action_name">
                                        Favorites
                                    </div>
                                </button>
                            </form>
                        <?php endif; ?>
                    <?php endif; ?>


                    <?php if($isOwner): ?>
                        <a href="<?php echo e(route('editBook.edit', $book->id)); ?>" class="actionBtn text-decoration-none text-center">
                            <i class="fa-regular fa-pen-to-square Icon action-icon"></i>
                            <div class="action_name">
                                Edit
                            </div>
                        </a>
                    <?php elseif($get_userId != 0 || $get_userId != null): ?>
                        <button type="button" class="actionBtn" id="rateAction">
                            <i class="fa-regular fa-star Icon action-icon"></i>
                            <div class="action_name">
                                Rate it
                            </div>
                        </button>
                        <!-- <div class="modal fade" id="confirmationModal" tabindex="-1" aria-labelledby="modalLabel"
                            aria-hidden="true">
                            <div class="modal-dialog">
                                <div class="modal-content">
                                    <form action="<?php echo e(url('/add-rating')); ?>" method="POST">
                                        <?php echo csrf_field(); ?>
                                        <input name="userId" class="d-none" value="<?php echo e($get_userId); ?>">
                                        <input name="bookId" class="d-none" value="<?php echo e($book->id); ?>">
                                        <div class="modal-header">
                                            <h5 class="modal-title" id="modalLabel">Rate <?php echo e($book->recipeTitle); ?></h5>
                                        </div>
                                        <div class="modal-body">
                                            <div class="container-rating d-flex align-items-center p-2 ps-0">
                                                <div class="rating d-flex d-inline ms-2">
                                                    <input type="radio" id="BStar5" name="rating" class="star" value="5" />
                                                    <label for="BStar5" title="5 stars" class="fa-solid fa-star"></label>
                                                    <input type="radio" id="BStar4" name="rating" class="star" value="4" />
                                                    <label for="BStar4" title="4 stars" class="fa-solid fa-star"></label>
                                                    <input type="radio" id="BStar3" name="rating" class="star" value="3" />
                                                    <label for="BStar3" title="3 stars" class="fa-solid fa-star"></label>
                                                    <input type="radio" id="BStar2" name="rating" class="star" value="2" />
                                                    <label for="BStar2" title="2 stars" class="fa-solid fa-star"></label>
                                                    <input type="radio" id="BStar1" name="rating" class="star" value="1" />
                                                    <label for="BStar1" title="1 star" class="fa-solid fa-star"></label>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="modal-footer">
                                            <button type="button" class="btnCancel" data-bs-dismiss="modal">Cancel</button>
                                            <button type="submit" class="btnSub">Rate it</button>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div> -->
                    <?php endif; ?>
                </div>

            </div>

            <!-- Ingridients -->
            <div class="form-info">
                <div class="desc">Ingridients:</div>
                <p class="viewTextBig viewText" placeholder="Ingredients" id="txtA1" readonly><?php echo e($book->recipeIngridients); ?>

                </p>
            </div>

            <!-- Description -->
            <div class="form-info">
                <div class="desc">Description:</div>
                <p class="viewTextBig viewText" placeholder="Description" id="txtA2" readonly><?php echo e($book->recipeDescription); ?>

                </p>
            </div>
        </div>

        <div class="commentSection container-fluid">
            <hr class="line">

            <div class="commentTitle_header">Comments (<?php echo e($comments->count()); ?>)</div>


            <div class="comments container-fluid">

                <!-- <div class="allComments"> -->
                <?php if(isset($comments)): ?>
                    <?php $__currentLoopData = $comments; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $comment): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <?php echo $__env->make('components.comment', ['comment' => $comment], \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                <?php endif; ?>

                <!-- </div> -->


                <?php if($get_userId != 0 || $get_userId != null): ?>
                    <div class=" d-flex justify-content-center addComment_container">
                        <div class="commentContainer">
                            <form action="<?php echo e(url('/add-comment')); ?>" method="POST" class="commentForm">
                                <?php echo csrf_field(); ?>
                                <input name="book_id" type="hidden" value="<?php echo e($book->id); ?>">
                                <input type="hidden" name="parent_id" id="parent_id_input" value="">
                                <textarea name="comment" id="replyToInput" class="commentTextArea"
                                    placeholder="Write your comment here..."></textarea>
                                <button type="submit" class="btnSend">
                                    <span class="material-symbols-outlined sendIcon">
                                        send
                                    </span>
                                </button>
                            </form>
                        </div>
                    </div>
                <?php endif; ?>



            </div>
        </div>

    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz"
        crossorigin="anonymous"></script>

    <!-- html2canvas for screenshot -->
    <!-- <script src="https://cdnjs.cloudflare.com/ajax/libs/html2canvas/1.4.1/html2canvas.min.js"></script> -->
    <script src="https://unpkg.com/html-to-image"></script>

    <!-- jsPDF for PDF generation -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jspdf/2.5.1/jspdf.umd.min.js"></script>


    <script type="module" src="<?php echo e(asset('assets/js/openedBook.js')); ?>"></script>

    <script>
        const ADD_RATING_URL = "<?php echo e(url('/add-rating')); ?>";
    </script>


    <script type="module" src="<?php echo e(asset('assets/js/openBook_sweetAlert2.js')); ?>"></script>

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

</html><?php /**PATH C:\xampp\htdocs\main_finalproject\resources\views/openedBook.blade.php ENDPATH**/ ?>