<!DOCTYPE html>
<html>
<head>
    <link rel="stylesheet" type="text/css" media="screen" href="normalize.css">
    <link rel="stylesheet" type="text/css" href="http://194.5.157.97/php2/mvc/recourses/css/style.css">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://fonts.googleapis.com/css?family=Quattrocento&display=swap" rel="stylesheet">
    <script src="http://194.5.157.97/php2/mvc/recourses/js/jquery.js"></script>
    <script src="http://194.5.157.97/php2/mvc/recourses/js/functions.js<?php echo '?time='.date('c')?>"></script>
    <script src="https://cdn.jsdelivr.net/jquery.validation/1.16.0/jquery.validate.min.js"></script>
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
            <a href="<?php echo url('search/'); ?>">Search Posts</a>
            <a href="<?php echo url('uzduotis/create'); ?>">Uzduotis</a>
        </nav>
        <div>
            <?php if($this->user):?>
            Hi, <?php echo $this->user->name; ?>
            <?php endif; ?>
        </div>

        <div class="dropdown">
            <div class="dropbtn">Categories</div>
            <div id="myDropdown" class="dropdown-content">
                <?php foreach($this->categories as $category):?>
                    <a href="<?php echo url('category/show/').$category->slug;?>"><?php echo $category->name; ?></a>
                <?php endforeach; ?>
            </div>
        </div>

    </div>
    <div class="msg-block"></div>
</div>
<div class="main">


