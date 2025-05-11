<div class="comment_connection">
    <div class="comment_card">
        <h3 class="comment_Title"><?php echo e($comment->user->username ?? 'Guest'); ?></h3>
        <p class="commenet_Text"><?php echo e($comment->comment); ?></p>
        <h1 class="parent d-none" ><?php echo e($comment->id); ?></h1>

        <div class="comment_card_footer">
            <i class="fa-solid fa-thumbs-up d-none"></i>
            <i class="fa-solid fa-share-nodes d-none"></i>
            <?php if($get_userId != 0 || $get_userId != null): ?>
                <i class="fa-solid fa-reply replyTo"></i>
            <?php endif; ?>
            <div class="viewReplies">
                Replies (<?php echo e($comment->replies->count()); ?>)
                <i class="fa-solid fa-caret-down"></i>
            </div>
        </div>


        <?php if($get_userId != 0 || $get_userId != null): ?>
            <div class="d-flex justify-content-center addComment_container d-none">
                <div class="commentContainer">
                    <form action="<?php echo e(url('/add-comment')); ?>" method="POST" class="commentForm">
                        <?php echo csrf_field(); ?>
                        <input name="book_id" type="hidden" value="<?php echo e($book->id); ?>">
                        <input type="hidden" name="parent_id" class="parent_id_input" value="">
                        <textarea name="comment" class="commentTextArea replyToInput"
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

<?php if($comment->replies->count()): ?>
    <div class="comment_replies" > 
        <?php $__currentLoopData = $comment->replies; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $reply): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
            <div class="comment_container d-none">
                <?php echo $__env->make('components.comment', ['comment' => $reply], \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
            </div>
        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
    </div>
<?php endif; ?>
<?php /**PATH C:\xampp\htdocs\main_finalproject\resources\views/components/comment.blade.php ENDPATH**/ ?>