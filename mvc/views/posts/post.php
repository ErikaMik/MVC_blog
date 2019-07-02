<?php if(count($this->posts)): ?>
    <div class="posts-wrapper">
        <?php foreach($this->posts as $post): ?>
            <div class="post-column">
                <a href="http://194.5.157.97/php2/mvc/index.php/post/show/<?php echo  $post->id ?>">
                    <img src="<?php echo $post->post_img ?>">
                    <h3><?php echo $post->title ?></h3>
                </a>
                <a href="http://194.5.157.97/php2/mvc/index.php/post/delete/<?php echo  $post->id ?>"
                   onClick="return confirm('Are you sure you want to delete blog post: <?php echo $post->title ?>');"
                   class="btn">DELETE!</a>
                <a href="http://194.5.157.97/php2/mvc/index.php/post/edit/<?php echo  $post->id ?>"');" class="btn">
                    Edit!</a>
            </div>
        <?php endforeach; ?>
    </div>
<?php endif; ?>
