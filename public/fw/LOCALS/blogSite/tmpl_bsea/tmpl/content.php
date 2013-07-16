
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

<div class="fullwidth lightgrey"> <!-- begin footer -->
    <div class="block overflow footerText">
        The Black Sea by
        <a href="http://creativecommons.org/choose/theblacksea.eu" target="_blank">crji.org</a>
        is licensed under a
        <a href-"http://creativecommons.org/licenses/by-sa/3.0/deed.en_US" target="_blank">Creative Commons Attribution-ShareAlike 3.0 Unported License</a>
        if not otherwise stated. Based on a work at
        <a href="http://creativecommons.org/choose/theblacksea.eu" target="_blank">theblacksea.eu</a>.
        This web application is Free Software (<a href="http://www.gnu.org/licenses/agpl-3.0.html" target="_blank">AGPLv3+</a>),
        source code is <a href="http://git.ceata.org/cgit.cgi/open-media-challenge.git/" target="_blank">available</a>
        and waiting for contributions.
    </div>
</div>

<!--</div>-->
<!-- end mainContainer -->
