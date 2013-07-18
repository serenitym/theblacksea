
<!-- begin mainContainer -->
<div class="mainContainer">
	<div class="fullwidth topbar lightgrey space"> <!-- begin topbar -->
	<div class="block overflow">
		<div class="logo">The Black Sea&nbsp; <span class="blue"> Diving Deep into Stories</span></div>
            <!--<ul class="mainNav">
                <li class="navitem">archive</li>
                <li class="navitem">blog</li>
                <li class="navitem">about </li>
            </ul>-->

            <?php
                echo $core->Render_ModulefromRes($core->ivyMenu, 'superfish');
            ?>
	    </div>
	</div>
    <!-- end topbar -->
    <?php

        //echo $core->mgrName."<br>";
        $obName = $core->mgrName;
        /*echo "sitePrez - content.php : "
            .(is_object($core->$obName)
               ? 'este obiect <br>'
               : 'nu este obiect <br>');*/
        echo $core->Handle_Render($core->$obName);
     ?>
</div>

