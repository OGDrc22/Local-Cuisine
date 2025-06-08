

<?php $__env->startSection('table-content'); ?>
    <div class="holder-table">
        <table class="table border-top-0">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Username</th>
                    <th>Email</th>
                    <th>User Type</th>
                    <th>Updated at</th>
                    <th>Created At</th>
                </tr>
            </thead>
            <tbody>
                <?php $__currentLoopData = $table_users; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $user): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <tr>
                        <form action="<?php echo e(route('edit.admin')); ?>" method="POST" enctype="multipart/form-data" id="adminEdit">
                            <?php echo csrf_field(); ?>
                            <?php echo method_field('PUT'); ?>

                            <td><input type="text" name="userId" class="editables" readonly value="<?php echo e($user['id']); ?>"></td>
                            <td><input type="text" name="username" class="editables inpt"  value="<?php echo e($user['username']); ?>"></td>
                            <td><input type="text" name="email" class="editables inpt"  value="<?php echo e($user['email']); ?>"></td>

                            <td>
                                <?php if($user['user_type'] == 'admin'): ?>
                                    <i class="fa-solid fa-user-lock"></i>
                                    <b class="admin"><?php echo e(ucfirst($user['user_type'])); ?></b>
                                <?php else: ?>
                                    <i class="fa-solid fa-user"></i>
                                    Regular
                                <?php endif; ?>
                            </td>

                            <td><?php echo e($user['updated_at']); ?></td>
                            <td><?php echo e($user['created_at']); ?></td>
                        </form>
                    </tr>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            </tbody>
        </table>
    </div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('Admin_Tabs.Tables', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp\htdocs\main_finalproject\resources\views/AdminTableTab/users.blade.php ENDPATH**/ ?>