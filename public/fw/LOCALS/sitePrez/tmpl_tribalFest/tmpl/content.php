<div id="header">
    <div id="navBar">

        <div id="navbar-menu" class="">

            <?php

                echo $core->ctrlDisplay_fromObjRes($core->ivyMenu, 'superfish');
            ?>
        </div>
    </div>

</div>

<div class="container-main" >

    <div id="mainPage" class='container_12 clearfix'>

        <?php
         //echo $core->ctrlDisplay_fromObj($core->feedback);

        # echo $core->$ob_name->modType."<br>";
         $obName = $core->type;

         echo $core->ctrlDisplay($core->$obName);
        //echo 'Page content';
        ?>
    </div>


</div>


<footer>
    <div id="footer-content">
            sponsor
    </div>
</footer>

