<script type="text/javascript" src="//use.typekit.net/dqe0pjz.js"></script>
<script type="text/javascript">try{Typekit.load();}catch(e){}</script>

<?php
$title = '';

if (isset($core->blog)
    && isset($core->blog->handler->record)
    && isset($core->blog->handler->title)
) {
    $title .=  $core->blog->handler->title . " - ";
} elseif ($_GET['idC'] == 86) {
    $title .=  'Blogs - ';
} elseif ($_GET['idC'] == 88) {
    $title .=  'Stories - ';
} else {
    $title .=  "";
}
$title .=  SITE_NAME;
?>
<title><?php echo $title; ?></title>
<meta property="og:title" content="<?php echo $title; ?>"/>

<link rel="shortcut icon" href="http://serenitymedia.ro/uploads/favicon.png" type="image/x-icon" />
