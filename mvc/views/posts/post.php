<?php if(count($this->posts)): ?>
    <div class="posts-wrapper">
        <?php foreach($this->posts as $post): ?>
            <div class="post-column">
                <a href="http://194.5.157.97/php2/mvc/index.php/post/show/?id=<?php echo  $post->id ?>">
                    <img src="<?php echo $post->image ?>">
                    <h3><?php echo $post->title ?></h3>
                </a>
            </div>
        <?php endforeach; ?>
    </div>
<?php endif; ?>
