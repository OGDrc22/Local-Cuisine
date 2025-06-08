
<?php $__env->startSection('table-content'); ?>
    <div class="holder-table">
        <table class="table border-top-0">
            <thead>
                <tr>
                    <!-- <th>ID</th> -->
                    <th>Username</th>
                    <th>Email</th>
                    <th>Books Created</th>
                    <!-- <th>Action</th> -->
                </tr>
            </thead>
            <tbody>

                <?php $__currentLoopData = $table_overview; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $user): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>

                    <tr>
                        
                        <form action="<?php echo e(route('edit.admin')); ?>" method="POST" enctype="multipart/form-data" id="adminEdit">
                            <?php echo csrf_field(); ?>
                            <?php echo method_field('PUT'); ?>

                            <div><input type="hidden" name="userId" value="<?php echo e($user['id']); ?>"></div>
                            <td><input type="text" name="username" class="inpt editables" value="<?php echo e($user['username']); ?>"></td>
                            <td><input type="text" name="email" class="inpt editables" value="<?php echo e($user['email']); ?>"></td>

                            
                            <td>
                                <button type="submit">Save</button>
                            </td>
                        </form>

                            <td class="px-0 py-1">
                                <table class="table table2nd">
                                    <thead>
                                        <?php
                                            $books_count = count($user['created_books'])
                                        ?>
                                        <tr>
                                            <th><i class="fa-solid fa-book-open"></i> <?php echo e($books_count); ?></th>
                                            <th><i class="fa-solid fa-tag"></i> Category</th>
                                            <th><i class="fa-solid fa-star starRatedTitle"></i> Ratings</th>
                                            <th><i class="fa-solid fa-user"></i> Rate</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php $__currentLoopData = $user['created_books']; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $book_detail): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                            <?php
                                                $stars = $book_detail['starsCount'];
                                                $starsTotal = number_format($stars, 1)
                                            ?>
                                            <tr>
                                                <form action="<?php echo e(route('edit.admin')); ?>" method="POST" enctype="multipart/form-data">
                                                    <?php echo csrf_field(); ?>
                                                    <?php echo method_field('PUT'); ?>

                                                    <input type="hidden" name="book_id" value="<?php echo e($book_detail['book_id']); ?>">
                                                    
                                                    <textarea type="hidden" name="recipeIngridients" class="input-field-big d-none" placeholder="Description/Instructions..." required readonly><?php echo e($book_detail['recipeIngridients']); ?></textarea>
                                                    <textarea type="hidden" name="recipeDescription" class="input-field-big d-none" placeholder="Description/Instructions..." required readonly><?php echo e($book_detail['recipeDescription']); ?></textarea>
                                                    
                                                    <td class="col-1"><input type="text" name="recipeTitle" class="inpt editables" value="<?php echo e($book_detail['recipeTitle']); ?>"></td>
                                                    <td class="col-1"><input type="text" name="recipeCategory" class="inpt editables" value="<?php echo e($book_detail['recipeCategory']); ?>"></td>
                                                    <td class="col-1" title="<?php echo e($stars); ?>"><i class="fa-solid fa-star starRated"></i> <input type="text" class="inpt editables editables-short" value="<?php echo e($starsTotal); ?>"></td>
                                                    <td class="col-1"><?php echo e($book_detail['ratings']); ?> <i class="fa-solid fa-user"></i></td>
                                                    <td class="col-1">
                                                        <button type="submit">Save</button>
                                                    </td>
                                                </form>
                                            </tr>
                                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                        
                                    </tbody>
                                </table>
                            </td>
                    </tr>

                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            </tbody>
        </table>
    </div>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('Admin_Tabs.Tables', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp\htdocs\main_finalproject\resources\views/AdminTableTab/overview.blade.php ENDPATH**/ ?>