<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo e($book->recipeTitle); ?></title>
    <link href="<?php echo e(asset('assets/css/bootstrap.css')); ?>" rel="stylesheet">
    <link href="<?php echo e(asset('assets/css/newBook.css')); ?>" rel="stylesheet">

    <link rel="apple-touch-icon" sizes="180x180" href="<?php echo e(asset('assets/favicon_io/chefshat.png')); ?>">
    <link rel="icon" type="image/png" sizes="32x32" href="<?php echo e(asset('assets/favicon_io/chefshat.png')); ?>">
    <link rel="icon" type="image/png" sizes="16x16" href="<?php echo e(asset('assets/favicon_io/chefshat.png')); ?>">
    <link rel="manifest" href="<?php echo e(asset('assets/favicon_io/site.webmanifest')); ?>">

    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@24,400,0,0&icon_names=search" />
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons/font/bootstrap-icons.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">

    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@11/dist/sweetalert2.min.css">

</head>
<body class="body">
    <nav class="navbar navbar-expand-lg">

        <div class="container-top-nav container-fluid">
            <div class="left-brand-container">
                <a class="navbar-brand" href="<?php echo e(url('home')); ?>">
                    <img src="<?php echo e(asset('assets/favicon_io/chefshat.svg')); ?>" alt="" srcset="" class="Icon" width="32" height="32">
                    <div class="webname hide-at-small-screen">
                        Local Cuisine
                    </div>
                    <div class="webname navBarActions_dropdown">
                        Edit Book
                    </div>
                </a>
            </div>

            <div class="center-actions-container">
                <div class="left-center-action">
                </div>

                <div class="center-center-action">
                </div>

                <div class="right-center-action">
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
        <div class="column left">

            <?php if($errors->any()): ?>
                <div class="alert alert-danger floating-alert">
                    <ul>
                        <?php $__currentLoopData = $errors->all(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $error): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <li><?php echo e($error); ?></li>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    </ul>
                </div>
            <?php endif; ?>

            <h1 class="welcomeText hide-at-small-screen">Create</h1>
            <div class="container-form">
                <form action="<?php echo e(route('editBook.update', $book->id)); ?>" method="POST" enctype="multipart/form-data" id="myForm">
                    <?php echo csrf_field(); ?>
                    <?php echo method_field('PUT'); ?>
                    <input name="userId" value="<?php echo e($get_userId); ?>" class="d-none">
                    
                    <div class="required">
                        <input name="recipeTitle" type="text" class="input-field-title" id="sourceInput" placeholder="Title" value="<?php echo e($book->recipeTitle); ?>" required>
                    </div>

                    <div class="form-group mt-2">
                        <div class="row-form">
                            <div class="form-group mt-3">
                                <div class="nav-item dropdownCategory">
                                    <a class="input-field form-control selected" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                                        <?php echo e($book->recipeCategory ?? 'Select Category'); ?>

                                        <input type="checkbox" class="dropdown-toggle check-boxA">
                                    </a>
                                    <ul class="dropdown-menu dropdown-menuCategory">
                                        <li class="dropdown-item" data-value="Appetizers">Appetizers</li> 
                                        <li class="dropdown-item" data-value="Side Dishes">Side Dishes</li> 
                                        <li class="dropdown-item" data-value="Main Courses">Main Courses</li> 
                                        <li class="dropdown-item" data-value="Desserts">Desserts</li> 
                                        <li class="dropdown-item" data-value="Beverages">Beverages</li> 
                                        <li class="dropdown-item" data-value="Soups">Soups</li> 
                                        <li class="dropdown-item" data-value="Salads">Salads</li> 
                                        <li class="dropdown-item" data-value="Breakfasts">Breakfasts</li> 
                                        <li class="dropdown-item" data-value="Snacks">Snacks</li> 
                                        <li class="dropdown-item" data-value="Bread and Pastries">Bread and Pastries</li>
                                    </ul>
                                </div>
                            
                            </div>

                        </div>
                    </div>

                    <div class="mt-3">
                        <select name="recipeCategory" class="form-control input-field-category d-none">
                            <option value="" disabled>Category</option>
                            <option value="Appetizers" <?php echo e($book->recipeCategory == 'Appetizers' ? 'selected' : ''); ?>>Appetizers</option>
                            <option value="Side Dishes" <?php echo e($book->recipeCategory == 'Side Dishes' ? 'selected' : ''); ?>>Side Dishes</option>
                            <option value="Main Courses" <?php echo e($book->recipeCategory == 'Main Courses' ? 'selected' : ''); ?>>Main Courses</option>
                            <option value="Desserts" <?php echo e($book->recipeCategory == 'Desserts' ? 'selected' : ''); ?>>Desserts</option>
                            <option value="Beverages" <?php echo e($book->recipeCategory == 'Beverages' ? 'selected' : ''); ?>>Beverages</option>
                            <option value="Soups" <?php echo e($book->recipeCategory == 'Soups' ? 'selected' : ''); ?>>Soups</option>
                            <option value="Salads" <?php echo e($book->recipeCategory == 'Salads' ? 'selected' : ''); ?>>Salads</option>
                            <option value="Breakfasts" <?php echo e($book->recipeCategory == 'Breakfasts' ? 'selected' : ''); ?>>Breakfasts</option>
                            <option value="Snacks" <?php echo e($book->recipeCategory == 'Snacks' ? 'selected' : ''); ?>>Snacks</option>
                            <option value="Bread and Pastries" <?php echo e($book->recipeCategory == 'Bread and Pastries' ? 'selected' : ''); ?>>Bread and Pastries</option>
                        </select>
                    </div>
                    
                    <div class="mt-3">
                        <textarea name="recipeIngridients" class="input-field-big" placeholder="Ingredients..." required><?php echo e($book->recipeIngridients); ?></textarea>
                    </div>

                    <div class="mt-3">
                        <textarea name="recipeDescription" class="input-field-big" placeholder="Description/Instructions..." required><?php echo e($book->recipeDescription); ?></textarea>
                    </div>
                    
                    <div class="mt-1">
                        <label for="formFile" class="form-label mb-0">Recipe Origin</label>
                        <input name="recipeOrigin" type="text" class="input-field-category" id="sourceInput" placeholder="Recipe Origin" value="<?php echo e($book->recipeOrigin); ?>" required>
                    </div>

                    <div class="mb-3 mt-1">
                        <label for="formFile" class="form-label mb-0">Upload Cover Photo</label>
                        <input name="coverImage" class="input-field" type="file" id="formFile">
                    </div>


                    <div class="container-User justify-content-center align-items-center navBarActions_dropdown">
                        <div class="item book-item">
                            <img class="coverImg" id="imagePreview" src="<?php echo e(asset('storage/' . $book->coverImage)); ?>" alt="Cover Image">
                            <div class="info">
                                <a class="title" id="targetInput"><?php echo e($book->recipeTitle); ?></a>
                                <a class="byText">By</a>
                                <p class="author d-inline"><?php echo e($get_userName); ?></p>
                                
                            </div>
                            <div class="container-rating d-flex align-items-center px-2">
                                <div class="rating">
                                    <i id="star" class="fa-solid fa-star starRated"></i>
                                    <i id="star" class="fa-solid fa-star starRated"></i>
                                    <i id="star" class="fa-solid fa-star starRated"></i>
                                    <i id="star" class="fa-solid fa-star starRated"></i>
                                    <i id="star" class="fa-solid fa-star starRated"></i>
                                </div>
                                <h1 class="rates ms-2 mb-0 mt-1 starsNum">(0)</h1>
                                <h1 class="rates ms-2 mb-0 mt-1 d-inline"> 0 Ratings</h1>
                            </div>
                        </div>
                    </div>

                    
                    <div class="d-flex justify-content-end mt-3">
                            <a type="cancel"" class="btnCancel me-3 text-decoration-none text-center" href="<?php echo e(url()->previous()); ?>">Cancel</a>
                            <button type="button" id="openModal" class="btnSub float-right">Save</button>
                    </div>
                </form>
                <form action="<?php echo e(route('deleteBook', $book->id)); ?>" method="POST" id="deleteBook">
                    <?php echo csrf_field(); ?>
                    <?php echo method_field('DELETE'); ?>
                    <button type="button" id="openModalD" class="btnDelete">Delete</button>
                </form>
            </div>
        </div>

        <div class="column right hide-at-small-screen">
            
            <h1 class="welcomeText">Preview</h1>
            
            <div class="container-User d-flex justify-content-center align-items-center">
                <div class="item book-item">
                    <img class="coverImg" id="imagePreview" src="<?php echo e(asset('storage/' . $book->coverImage)); ?>" alt="Cover Image">
                    <div class="info">
                        <a class="title" id="targetInput"><?php echo e($book->recipeTitle); ?></a>
                        <a class="byText">By</a>
                        <p class="author d-inline"><?php echo e($get_userName); ?></p>
                        
                    </div>
                    <div class="container-rating d-flex align-items-center px-2">
                        <div class="rating-owner">
                            <i id="star" class="fa-solid fa-star starRated"></i>
                            <i id="star" class="fa-solid fa-star starRated"></i>
                            <i id="star" class="fa-solid fa-star starRated"></i>
                            <i id="star" class="fa-solid fa-star starRated"></i>
                            <i id="star" class="fa-solid fa-star starRated"></i>
                        </div>
                        <h1 class="rates ms-2 mb-0 mt-1 starsNum">(0)</h1>
                        <h1 class="rates ms-2 mb-0 mt-1 d-inline"> 0 Ratings</h1>
                    </div>
                </div>
            </div>

        </div>
    </div>


    <script src="<?php echo e(asset('assets/js/newBook.js')); ?>"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
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
</html><?php /**PATH C:\xampp\htdocs\main_finalproject\resources\views//editBook.blade.php ENDPATH**/ ?>