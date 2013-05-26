
ivyMods.set_iEdit.events = function(){

    iEdit.add_bttsConf({
        'membr':
        {
            moduleName: 'events',
            addBt:{status: false},
            saveBt:{status: false},
            deleteBt:{atrValue: 'delete Member'}

        }
    });

};


ivyMods.events = {

    //document.getElementById('captcha').src = 'assets/securimage/securimage_show.php?sid=' + Math.random(); this.blur(); return false
    regenerateCaptcha :function(){
        $('.captcha').attr('src','assets/securimage/securimage_show.php?sid=' + Math.random());
        return false;
    },

    // show hide workshops
    show_ws: function(){
        $(this).find('*[class^=ev-fullDescription]').slideDown();

    },
    hide_ws: function(){
        $(this).find('*[class^=ev-fullDescription]').slideUp();

    },
    binds : function(){

        $('.evs_ws .ev').hoverIntent({
            over: ivyMods.events.show_ws,
            out: ivyMods.events.hide_ws
        });

    }

    // signup workshops
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