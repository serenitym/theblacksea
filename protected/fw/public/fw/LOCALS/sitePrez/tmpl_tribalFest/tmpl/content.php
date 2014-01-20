<div id="header">
    <div id="navBar">

        <div id="navbar-menu" class="">

            <?php

                echo $core->Render_ModulefromRes($core->ivyMenu, 'superfish');
            ?>
        </div>
    </div>

</div>

<div class="containerMain" >

    <div id="mainPage" class='container_12 clearfix'>

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


</div>


<footer>
    <div id="footer-content">
            <ul>
                <li>
                    <a href="http://www.arcub.ro/" target="_blank"
                        title="Centrul de Proiecte Culturale al Primăriei Municipiului București">
                        <img src="fw/LOCALS/sitePrez/tmpl_tribalFest/css/img/logo_arcub.gif">
                    </a>
                </li>
                <li>
                    <a href="http://www.oriens.ro" target="_blank"
                        title="Oriens">
                        <img src="fw/LOCALS/sitePrez/tmpl_tribalFest/css/img/ORIENS.png">
                    </a>
                </li>
                <li>
                    <a href="https://www.facebook.com/CityPuzzleApp?fref=ts" target="_blank"
                        title="City Puzzle">
                        <img src="fw/LOCALS/sitePrez/tmpl_tribalFest/css/img/greenlogo.png">
                    </a>
                </li>
                <li>
                    <a href="http://www.hagalla.de/" target="_blank"
                        title="Hagalla">
                        <img src="fw/LOCALS/sitePrez/tmpl_tribalFest/css/img/hagalla.png">
                    </a>
                </li>
                <li>
                    <a href="http://www.world-of-orient.de/en/tribal/" target="_blank"
                        title="World of Orient">
                        <img src="fw/LOCALS/sitePrez/tmpl_tribalFest/css/img/tribal_logo.png">
                    </a>
                </li>
<!--
                <li>
                    <a href="http://www.ambasada.ro/ambasada/2/274/slovenia.html" target="_blank">
                        <img src="fw/LOCALS/sitePrez/tmpl_tribalFest/css/img/ASR.jpg">
                        <span style="float: right; margin-left: 10px;">
                            Ambasada <br> Sloveniei
                        </span>
                    </a>
                </li>
-->
            </ul>
    </div>
</footer>

<!-- Piwik -->
<script type="text/javascript">
  var _paq = _paq || [];
  _paq.push(["trackPageView"]);
  _paq.push(["enableLinkTracking"]);

  (function() {
    var u=(("https:" == document.location.protocol) ? "https" : "http") + "://piwik.serenitymedia.ro/";
    _paq.push(["setTrackerUrl", u+"piwik.php"]);
    _paq.push(["setSiteId", "7"]);
    var d=document, g=d.createElement("script"), s=d.getElementsByTagName("script")[0]; g.type="text/javascript";
    g.defer=true; g.async=true; g.src=u+"piwik.js"; s.parentNode.insertBefore(g,s);
  })();
</script>
<!-- End Piwik Code -->
