<div id="header">
    <div id="navBar">

        <div id="navbar-menu" class="">

            <?php

                echo $core->ctrlDisplay_fromObjRes($core->ivyMenu, 'superfish');
            ?>
        </div>
    </div>

</div>

<div class="containerMain" >

    <div id="mainPage" class='container_12 clearfix'>

        <?php

        # echo $core->$ob_name->modType."<br>";
         $obName = $core->type;

         echo $core->ctrlDisplay($core->$obName);
        //echo 'Page content';
        ?>
    </div>


</div>


<footer>
    <div id="footer-content">
            <ul>
                <li>
                    <a href="http://www.arcub.ro/" target="_blank">
                        <img src="fw/LOCALS/sitePrez/tmpl_tribalFest/css/img/logo_arcub.gif">
                    </a>
                </li>
                <li>
                    <a href="http://www.ambasada.ro/ambasada/2/274/slovenia.html" target="_blank">
                        <img src="fw/LOCALS/sitePrez/tmpl_tribalFest/css/img/ASR.jpg"> Ambasada Sloveniei
                    </a>
                </li>

            </ul>
    </div>
</footer>

