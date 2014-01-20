
ivyMods.set_iEdit.events = function(){

    iEdit.add_bttsConf({
        'membr':
        {
            modName: 'events',
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
            modName: 'events',
            saveBt:{atrValue:'save Member', methName:'saveMember'},
            edit:{atrValue:'edit Member'}
        }
        ,'ev' : {
            modName:'events',
            addBt:{atrValue: 'add Event', methName:'addEvent'},
            saveBt:{atrValue: 'save' , methName: 'saveEvent'},
            deleteBt:{atrValue: 'delete', methName:'deleteEvent'},
            edit:{atrValue:'edit event'}

        }

    });

};


ivyMods.events = {

    validForm_ev: false,

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

        $('input[name=signup_ev] , input[name=signup_ws]').on('click',function(event){

                var form =  $(this).parents('form.form-ev_signup');

                var sendData = form.collectData();
                    sendData['methName']    = "valid_signupForm";
                    // desi modName este luat din cadrul formului
                    // (aceasta atribuire este pentru transparenta)
                    sendData['modName']  = "events";
                    sendData['restoreCore'] = 1;

                event.preventDefault();

                $.post('procesSCRIPT.php', sendData, function(data){

                      if(typeof data != 'undefined' && data!='')
                      {
                          // daca unul din capuri este invalid automat captcha se va reseta
                          // iar userul va trebui sa il introduca din nou
                          // deoarece un captcha este valabil o singura data

                          form.find('input[name=captcha_code]').attr('value','');
                          ivyMods.events.regenerateCaptcha();

                          form.find('.formFBK').remove();
                          form.append(data);
                          //alert("here not valid data");
                      }
                      else {
                          form.submit();
                      }

                      // console.log('data = ' + data + 'typeof = ' + (typeof data) + ' validForm = ' + validForm);
                });



            });

        //$('*[class$=radio-varPrices] .radio-btn').first().attr('checked','checked');

        $('*[class$=radio-varPrices]').map(function(){
            $(this).find('.radio-btn').first().attr('checked','checked');
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