<div id="header">
    <div class="container_12">
        <div id="logo" class="grid_5 alpha">
        <a href="<?php echo PUBLIC_URL; ?>">
        <img src="<?php echo tmpl_url; ?>/css/img/logo_prographic.png"
             alt="Prographic" />
        </a>
        </div>
        <div id="navbar" class="grid_7 omega">
        <!--
            <div id="language_selector">
                <a href="/ro" class="current">RO</a>
                <span>/</span>
                <a href="/en" class="">EN</a>
            </div>
        -->
            <?php
                echo $core->LANG->createSelector(
                    'div',
                    'language_selector',
                    '<span>/</span>'
                );
                echo $core->Render_ModulefromRes($core->ivyMenu, 'superfish');
            ?>
        </div>
    </div>
    <div class="container_12">
       <?php
            echo $core->childrenDisplay->DISPLAY_mainChildren();
        ?>
    </div>
</div>

<div class="container-main" >

    <div id="mainPage" class='container_12 clearfix'>

        <?php
         echo $core->Render_Module($core->feedback);

         $obName = $core->mgrName;
        #<!--src="fw/LOCALS/newsPaper/tmpl_blackSea/css/img/logo_color.png"-->

        # echo $core->$ob_name->modType."<br>";
         echo $core->Handle_Render($core->$obName);
        //echo 'Page content';
        ?>
    </div>

    <footer class="container_12">
        <div id="social">
           <a href="http://facebook.com"  target="_blank" class="facebook"> </a>
           <a href="http://pinterest.com" target="_blank" class="pinterest"></a>
           <a href="http://twitter.com"   target="_blank" class="twitter">  </a>
           <a href="http://linkedin.com"  target="_blank" class="linkedin"> </a>
        </div>
        <div id="copyright">
            <span>
                <span class="pro">pro</span>graphic
                architecture studio &copy; <?php print date('Y'); ?>
            </span>
        </div>
    </footer>
</div>

