
ivyMods.set_iEdit.events = function(){

    iEdit.add_bttsConf({
        'membr':
        {
            moduleName: 'events',
            addBt:{status: false},
            saveBt:{status: false},
            deleteBt:{atrValue: 'delete Member', methName:'deleteMember'}

            ,extraBts:{
                addMember: {

                    callBack: "ivyMods.events.showAddMember();",
                    attrValue: "addMember"
                }
            }
        }
        ,'sgMbr':{
            moduleName: 'events',
            saveBt:{atrValue:'save Member', methName:'saveMember'},
            edit:{atrValue:'edit Member'}
        }
        ,'ev' : {
            moduleName:'events',
            addBt:{atrValue: 'add Event', methName:'addEvent'},
            saveBt:{atrValue: 'save' , methName: 'saveEvent'},
            deleteBt:{atrValue: 'delete', methName:'deleteEvent'},
            edit:{atrValue:'edit event'}

        }

    });

};


ivyMods.events = {


    showAddMember: function(){

        var form_addMember = $('*[class^=cont-addMember]');
        if(form_addMember.is(':visible')) form_addMember.slideUp();
        else form_addMember.slideDown();


    },

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

        $('.usrView-evs_ws .ws').hoverIntent({
            over: ivyMods.events.show_ws,
            out: ivyMods.events.hide_ws
        });

    }

    // signup workshops
    ,show_sgup : function(idENT_ev){

          $('#'+idENT_ev).find('input[name=go_signup_ev]').hide();
          $('#sgup_'+idENT_ev).slideDown();

    }
    ,close_sgup : function(idENT_ev){

          $('#'+idENT_ev).find('input[name=go_signup_ev]').show();
          $('#sgup_'+idENT_ev).slideUp();

    }

};


$(document).ready(function(){


    ivyMods.events.binds();

});