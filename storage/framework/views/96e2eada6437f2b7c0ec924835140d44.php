

<?php $__env->startSection('table-content'); ?>
    <div class="holder-table">
        <table class="table border-top-0">
            <thead>
                <tr>
                    <th>Creator</th>
                    <th>Book ID</th>
                    <th>Category</th>
                    <th>Title</th>
                    <th>Ingridients</th>
                    <th>Description</th>
                    <th>Cover Image</th>
                    <th>Ratings</th>
                </tr>
            </thead>
            <tbody>
                <?php $__currentLoopData = $table_books; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $book_table): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                
                    <?php
                        $stars = $book_table['starsCount'];
                        $starsTotal = number_format($stars,  1)
                    ?>


                    
                    <tr class="stripe">
                        <form action="<?php echo e(route('edit.admin')); ?>" method="POST" enctype="multipart/form-data" id="adminEdit">
                            <?php echo csrf_field(); ?>
                            <?php echo method_field('PUT'); ?>
                            
                            <div><input type="hidden" name="userId" value="<?php echo e($book_table['userId']); ?>"></div>
                            <td><input type="text" name="username" class="editables inpt" value="<?php echo e($book_table['username']); ?>"></td>

                            <td class="col-1"><input type="text" name="book_id" class="editables inpt"  value="<?php echo e($book_table['id']); ?>"></td>
                            <td><input type="text" name="recipeCategory" class="editables-long inpt" required readonly value="<?php echo e($book_table['recipeCategory']); ?>"></td>
                            <td><input type="text" name="recipeTitle" class="editables-long inpt" required readonly value="<?php echo e($book_table['recipeTitle']); ?>"></td>
                            <td class="col-3"><textarea name="recipeIngridients" class="input-field-big" placeholder="Description/Instructions..." required readonly><?php echo e($book_table['recipeIngridients']); ?></textarea></td>
                            <td class="col-3"><textarea name="recipeDescription" class="input-field-big" placeholder="Description/Instructions..." required readonly><?php echo e($book_table['recipeDescription']); ?></textarea></td>
                            <td>
                                <img name="coverImage" class="coverImgAdmin" src="<?php echo e(asset('storage/' . $book_table['coverImage'])); ?>" alt="Cover Image">
                            </td>
                            <td>
                                <p title="<?php echo e($stars); ?>"><i class="fa-solid fa-star starRated"></i> <?php echo e($starsTotal); ?></p>
                                <p>(<?php echo e($book_table['ratings']); ?>) Rates</p>
                            </td>
                        </form>
                    </tr>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            </tbody>
        </table>
    </div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('Admin_Tabs.Tables', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp\htdocs\main_finalproject\resources\views/AdminTableTab/books.blade.php ENDPATH**/ ?>