<?php if(count($this->posts)): ?>
    <div class="posts-wrapper">
        <?php foreach($this->posts as $post): ?>
            <div class="post-column">
                <a href="<?php echo url('post/show/'); echo $post->id ?>">
                    <img src="<?php echo 'http://194.5.157.97/php2/mvc/uploads/'.App\Helper\ImageHelper::loadImage($post->post_img);?>">
                    <h2><?php echo $post->title ?></h2>
                </a>
                <?php if($this->user):; ?>
                <div class="buttons">
                <a href="<?php echo url('post/edit/'); echo $post->id ?>"');" class="btn">
                EDIT</a>
                <a href="<?php echo url('post/delete/'); echo $post->id ?>"
                   onClick="return confirm('Are you sure you want to delete blog post: <?php echo $post->title ?>');"
                   class="btn">DELETE!</a>
                </div>
                <?php endif; ?>
            </div>
        <?php endforeach; ?>
    </div>
<?php endif; ?>
