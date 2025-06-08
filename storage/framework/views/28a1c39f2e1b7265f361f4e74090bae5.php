

<?php $__env->startSection('main-content'); ?>
    <div class="home-main">
        <?php if(session('success')): ?>
            <div class="alert alert-success floating-alert" role="alert">
                <h5 class="modal-title"><?php echo e(session('success')); ?></h5>
            </div>
        <?php endif; ?>


        <?php if(trim($query) !== ''): ?>
            <div class="container-Search">
                <h1 class="welcomeText">Search Results for "<?php echo e($query); ?>":</h1>
                <div class="container-Search-Result"><!--style="background-color: blue"-->

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

        <div class="welcomeText d-none">My Books</div>
        <div class="container-User flex scroll-container1 d-none" id="container1">
            <!-- 1st Scroll-->
            <?php if(isset($books)): ?>
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
                                $starsNum = number_format($book['starsCount'], 1);
                            ?>

                            <!-- <h1 class="ratingText mb-0">Ratings: </h1> -->
                            <div class="rating-owner d-flex d-inline">

                                <?php for($i = $starsTotal + 1; $i <= 5; $i++): ?>
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



        <!-- 2nd Container Vertical Scroll -->
        <div class="container-Home" id="containerView">
            <div class="header-home d-flex mt-5 align-items-center">

                <?php if($category != null): ?>
                    <div class="welcomeText pe-5 d-flex categoryText"><?php echo e($category); ?></div>
                <?php else: ?>
                    <div class="welcomeText pe-5 d-flex">Home</div>
                <?php endif; ?>

                <div class="line"></div>

                <div class="navbar-nav ms-auto d-flex justify-content-end align-content-center">
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle filter text-center px-5 py-0" href="#" role="button"
                            data-bs-toggle="dropdown" aria-expanded="false">
                            Filter
                            <i class="fa-solid fa-filter"></i>
                        </a>
                        <ul class="dropdown-menu">
                            <li>
                                <?php if($category != null): ?>
                                    <a class="dropdown-item" href="<?php echo e(url('home')); ?>"><i class="fa-solid fa-xmark"></i> Clear
                                        Filter</a>
                                <?php endif; ?>
                            </li>
                            <li><a class="dropdown-item"
                                    href="<?php echo e(route('home.admin', ['category' => 'Appetizers'])); ?> #containerView">Appetizers</a>
                            </li>
                            <li><a class="dropdown-item"
                                    href="<?php echo e(route('home.admin', ['category' => 'Side Dishes'])); ?> #containerView">Side Dishes</a>
                            </li>
                            <li><a class="dropdown-item"
                                    href="<?php echo e(route('home.admin', ['category' => 'Main Courses'])); ?> #containerView">Main
                                    Courses</a></li>
                            <li><a class="dropdown-item"
                                    href="<?php echo e(route('home.admin', ['category' => 'Desserts'])); ?> #containerView">Desserts</a></li>
                            <li><a class="dropdown-item"
                                    href="<?php echo e(route('home.admin', ['category' => 'Beverages'])); ?> #containerView">Beverages</a>
                            </li>
                            <li><a class="dropdown-item"
                                    href="<?php echo e(route('home.admin', ['category' => 'Soups'])); ?> #containerView">Soups</a></li>
                            <li><a class="dropdown-item"
                                    href="<?php echo e(route('home.admin', ['category' => 'Salads'])); ?> #containerView">Salads</a></li>
                            <li><a class="dropdown-item"
                                    href="<?php echo e(route('home.admin', ['category' => 'Breakfasts'])); ?> #containerView">Breakfasts</a>
                            </li>
                            <li><a class="dropdown-item"
                                    href="<?php echo e(route('home.admin', ['category' => 'Snacks'])); ?> #containerView">Snacks</a></li>
                            <li><a class="dropdown-item"
                                    href="<?php echo e(route('home.admin', ['category' => 'Bread and Pastries'])); ?> #containerView">Bread
                                    and Pastries</a></li>
                        </ul>
                    </li>
                </div>
            </div>


            <?php if($category != null && $check == false): ?>
                <div class="NoResult mb-3">No results for <?php echo e($category); ?></div>
                <a class="btnClearFilter" href="<?php echo e(url('home')); ?>"><i class="fa-solid fa-xmark"></i> Clear Filter</a>
            <?php endif; ?>

            <!-- Categorized Books -->
            <div class="container-User flex">

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
                                <h1 class="rates ms-2 mb-0 mt-1 starsNum">(<?php echo e($starsNum); ?>)</h1>
                                <h1 class="rates ms-2 mb-0 mt-1 d-inline"> <?php echo e($book['ratings']); ?> Ratings</h1>
                            </div>
                        </div>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>

            </div>

            <?php if($category == null): ?>
                <div class="container-User flex">

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
                            <div class="container-rating d-flex align-items-center px-2">

                                <?php
                                    $starsTotal = $book['starsCount'];
                                    $starsFull = floor($starsTotal);
                                    $starsHalf = ($starsTotal - $starsFull) > 0 ? true : false;
                                    $starsNum = number_format($book['starsCount'], 1);
                                ?>

                                <!-- <h1 class="ratingText mb-0">Ratings: </h1> -->
                                <div class="rating-owner d-flex d-inline">

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
                                <h1 class="rates ms-2 mb-0 mt-1 starsNum">(<?php echo e($starsNum); ?>)</h1>
                                <h1 class="rates ms-2 mb-0 mt-1 d-inline"> <?php echo e($book['ratings']); ?> Ratings</h1>
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
                                <h1 class="rates ms-2 mb-0 mt-1 starsNum">(<?php echo e($starsNum); ?>)</h1>
                                <h1 class="rates ms-2 mb-0 mt-1 d-inline"> <?php echo e($book['ratings']); ?> Ratings</h1>
                            </div>
                        </div>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                </div>
            <?php endif; ?>

        </div>

    </div>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('admin_dashboard', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp\htdocs\main_finalproject\resources\views/Admin_Tabs/Home.blade.php ENDPATH**/ ?>