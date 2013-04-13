<div id="topbar">
  <div class="container">
    <?php
    if(authCommon::isAuth()) {
        echo $core->ctrlDisplay_fromObj($core->user);
    }
    else
       echo $core->ctrlDisplay_fromObj($core->user,'loginform');

    ?>
  </div>
</div>

<div class="container" style="/*padding: 0px 50px;background: rgba(255, 255, 255, 0.5);*/">

  <!-- header start -->
  <div class="container">
    <img class="logo" src="fw/LOCALS/newsPaper/tmpl_blackSea/css/img/logo_color.png" alt="" />
  </div>
    <?php echo $core->MENUhorizontal->DISPLAY(1,1); ?>
  <!-- header stop -->

  <!-- content start -->
  <div class="container main-container" >
   <?php
        $ob_name = $core->type;
        echo $core->ctrlDisplay_fromObj($core->$ob_name);
    ?>
  </div>
  <!-- content stop -->
</div>

  <!-- footer start -->
  <footer>
    <div class="container">
      <img class="footerlogo" src="fw/LOCALS/newsPaper/tmpl_blackSea/css/img/logo_monocrom.png" alt="" />
    </div>
  </footer>
  <!-- footer stop -->
