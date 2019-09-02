<div class="posts-wrapper">
    <div class="singlepost-column">
        <h3><?php echo $this->post->getTitle() ?></h3>
        <img src="<?php echo 'http://194.5.157.97/php2/mvc/uploads/'.App\Helper\ImageHelper::resizeImage($this->post->getImage(), 300, 200);?>">
        <?php echo $this->post->getContent() ?>
    </div>
</div>
<?php echo $this->form ?>
<div class="comments-wrapper">

</div>