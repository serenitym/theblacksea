
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
    <div class="clearfix"></div>
    <!-- end topbar -->
    <div class="block space">
        <div style='width: 50%; float: right;'>

            <?php echo $core->Render_Module($core->feedback); ?>
        </div>
        <div class="clearfix"></div>
    </div>
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

