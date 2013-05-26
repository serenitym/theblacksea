ivyMods.events = {

    //document.getElementById('captcha').src = 'assets/securimage/securimage_show.php?sid=' + Math.random(); this.blur(); return false
    regenerateCaptcha :function(){
        $('.captcha').attr('src','assets/securimage/securimage_show.php?sid=' + Math.random());
        return false;
    },

    binds : function(){

        $('.evs_ws .ev').on('mouseover', function(){
            $(this).find('*[class^=ev-fullDescription]').slideDown();
        });

        $('.evs_ws .ev').on('mouseout', function(){
            $(this).find('*[class^=ev-fullDescription]').slideUp();
        });

    }

    ,show_sgup : function(idENT_ev){

          $('#'+idENT_ev).find('input[name=go_signup_ev]').hide();
          $('#sgup_'+idENT_ev).show();

    }
    ,close_sgup : function(idENT_ev){

          $('#'+idENT_ev).find('input[name=go_signup_ev]').show();
          $('#sgup_'+idENT_ev).hide();

    }

};


$(document).ready(function(){


    ivyMods.events.binds();

});