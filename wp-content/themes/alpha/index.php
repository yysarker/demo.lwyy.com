<!doctype html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta name="viewport"
	      content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
	<meta http-equiv="X-UA-Compatible" content="ie=edge">
	<title><?php bloginfo('name'); ?></title>
</head>
<body>
    <div class="content">
        <h2>All Posts</h2>
        <hr/>
        <div class="allPost">
            <!--This is wordPress loop-->
            <?php
                if (have_posts()) {
                    while (have_posts()){
                        the_post();
                        echo "<h3>";
                            the_title();
                        echo "</h3>";
                    }
                }
            ?>
            <!--or we can write as like this-->
            <hr/>

            <?php if (have_posts()): while (have_posts()) : the_post(); ?>
                <h3><?php the_title(); ?></h3>
            <?php endwhile; else:?>
                <p>Your Post Not found.</p>
            <?php endif; ?>

        </div>
    </div>
</body>
</html>