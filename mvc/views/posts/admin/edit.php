<form method="post" action="http://194.5.157.97/php2/mvc/index.php/post/update" class="wrapper">
    <input type="text" name="title" placeholder="Title" required="required" value="<?php echo $this->post->getTitle()?>">
    <textarea name="content" placeholder="Insert post..." rows="20">
    <?php echo $this->post->getContent()?>
    </textarea>
    <input type="text" name="post_img" placeholder="Insert image URL" value="<?php echo $this->post->getImage()?>">

    <input type="hidden" name="id" value="<?php echo $this->post->getId()?>">
    <div>
        <button type="submit">Update blog</button>
    </div>
</form>