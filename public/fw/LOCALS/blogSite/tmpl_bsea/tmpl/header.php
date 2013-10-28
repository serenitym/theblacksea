<script type="text/javascript" src="//use.typekit.net/dqe0pjz.js"></script>
<script type="text/javascript">try{Typekit.load();}catch(e){}</script>

<title>
    <?php
        if(isset($core->blog) && isset($core->blog->handler->record)) {
            echo $core->blog->handler->title." - ";
        } else {
            echo "No title";
        }
        echo SITE_NAME;
    ?>
</title>

<link rel="shortcut icon" href="http://serenitymedia.ro/uploads/favicon.png" type="image/x-icon" />
