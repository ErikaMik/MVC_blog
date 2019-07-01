<div class="posts-wrapper">
    <div class="singlepost-column">
        <h3><?php echo $this->post->getTitle() ?></h3>
        <img src="<?php echo $this->post->getImage() ?>">
        <?php echo$this->post->getContent() ?>
    </div>
</div>

