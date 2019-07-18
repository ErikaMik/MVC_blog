<div class="wrapper" id="table">
    <table>
        <tr>
            <th>#</th>
            <th>Title</th>
            <th>Content</th>
            <th>Image</th>
        </tr>
            <?php foreach($this->posts as $post):;?>
                <tr>
                    <td><input name="post[]" type="checkbox" value="<?php echo $post->id;?>"></td>
                    <td><?php echo $post->title ?></td>
                    <td width="400px"><?php echo $post->content ?></td>
                    <td><img src="<?php echo $post->post_img ?>" width="150"></td>
                    <td><a href="<?php echo url('post/edit/'); echo $post->id ?>"');" class="btn">
                        EDIT</a></td>
                    <td><a href="<?php echo url('post/delete/'); echo $post->id ?>"
                           onClick="return confirm('Are you sure you want to delete blog post: <?php echo $post->title ?>');"
                           class="btn">DELETE!</a></td>
                </tr>
            <?php endforeach; ?>
    </table>
</div>
