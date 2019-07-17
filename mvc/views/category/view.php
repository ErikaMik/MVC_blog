<div class="wrapper">
<h1><?php echo $this->categoryName; ?></h1>
</div>
<div class="posts-wrapper">
    <?php foreach($this->posts as $post):?>
        <div class="post-column">
            <a href="<?php echo url('post/show/', $post->getId()); ?>">
                <img src="<?php echo $post->getImage() ?>">
                <h2><?php echo $post->getTitle() ?></h2>
            </a>
            <?php if($this->user):; ?>
                <div class="buttons">
                    <a href="<?php echo url('post/edit/'); echo $post->getId() ?>"');" class="btn">
                    EDIT</a>
                    <a href="<?php echo url('post/delete/'); echo $post->getId() ?>"
                       onClick="return confirm('Are you sure you want to delete blog post: <?php echo $post->getTitle() ?>');"
                       class="btn">DELETE!</a>
                </div>
            <?php endif; ?>
        </div>
    <?php endforeach; ?>
</div>