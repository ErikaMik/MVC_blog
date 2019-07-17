<!DOCTYPE html>
<html>
<head>
<!--    <link rel="stylesheet" type="text/css" media="screen" href="normalize.css">-->
    <link rel="stylesheet" type="text/css" href="http://194.5.157.97/php2/mvc/recourses/css/style.css">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://fonts.googleapis.com/css?family=Quattrocento&display=swap" rel="stylesheet">
    <title>Blogas</title>
</head>
<body>
<div class="wrapper" id="top">
    <div class="newwrapper">
        <div class="logo">
            <img src="https://www.bloggingpro.com/wp-content/uploads/2012/06/your-blog-logo.png">
        </div>
        <nav>
            <a href="<?php echo url('');?>">Home</a>
            <a href="<?php echo url('post/'); ?>">BLOG</a>
            <a href="<?php echo url('post/create'); ?>">Create post</a>
            <a href="<?php echo url('account/registration'); ?>">Register</a>
            <?php if($this->user): ?>
            <a href="<?php echo url('account/logout'); ?>">Log out</a>
            <?php else: ?>
            <a href="<?php echo url('account/login'); ?>">Log in</a>
            <?php endif; ?>
            <?php foreach($this->categories as $category):?>
                <a href="<?php echo url('category/show/').$category->slug;?>"><?php echo $category->name; ?></a>
            <?php endforeach; ?>
        </nav>
        <div>
            <?php if($this->user):?>
            Hi, <?php echo $this->user->name; ?>
            <?php endif; ?>
        </div>
        </div>
    </div>

