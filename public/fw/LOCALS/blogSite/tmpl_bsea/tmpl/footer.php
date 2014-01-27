
<!-- begin footer -->
<div class="fullwidth lightgrey">
    <div class="block overflow footerText">
        The Black Sea by
        <a href="http://creativecommons.org/choose/theblacksea.eu" target="_blank">crji.org</a>
        is licensed under a
        <a href="http://creativecommons.org/licenses/by-sa/3.0/deed.en_US" target="_blank">Creative Commons Attribution-ShareAlike 3.0 Unported License</a>
        if not otherwise stated. Based on a work at
        <a href="http://creativecommons.org/choose/theblacksea.eu" target="_blank">theblacksea.eu</a>.
        This web application is Free Software (<a href="http://www.gnu.org/licenses/agpl-3.0.html" target="_blank">AGPLv3+</a>),
        the source code is
        <a href="https://github.com/serenitym/theblacksea">available on GitHub</a>
        and waiting for contributions.
    </div>
</div>
<!-- end footer -->

<!-- end mainContainer -->
<script>
    head.ready(function() {
       var d = document;
       var s = 'script';
       var id = 'facebook-jssdk';
       // alert("Statusul lui liveEdit este " + fmw.liveEdit);
       if(fmw.liveEdit){
           return;
       }
        var js, fjs = d.getElementsByTagName(s)[0];
        if (d.getElementById(id)) return;
        js = d.createElement(s); js.id = id;
        js.src = "//connect.facebook.net/en_US/all.js#xfbml=1&appId=482365648543340";
        fjs.parentNode.insertBefore(js, fjs);
     }
  );
</script>

<?php if(defined('ENV') && ENV == 'production'): ?>

    <!-- Piwik -->
    <script type="text/javascript">
      var _paq = _paq || [];
      _paq.push(['trackPageView']);
      _paq.push(['enableLinkTracking']);
      (function() {
        var u=(("https:" == document.location.protocol) ? "https" : "http") + "://piwik.theblacksea.eu//";
        _paq.push(['setTrackerUrl', u+'piwik.php']);
        _paq.push(['setSiteId', 1]);
        var d=document, g=d.createElement('script'), s=d.getElementsByTagName('script')[0]; g.type='text/javascript';
        g.defer=true; g.async=true; g.src=u+'piwik.js'; s.parentNode.insertBefore(g,s);
      })();



    </script>
    <noscript><p><img src="http://piwik.theblacksea.eu/piwik.php?idsite=1" style="border:0" alt="" /></p></noscript>
    <!-- End Piwik Code -->

<?php endif; ?>
