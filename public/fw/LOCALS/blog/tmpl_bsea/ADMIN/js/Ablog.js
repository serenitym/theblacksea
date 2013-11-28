if(typeof ivyMods.blogConf == 'undefined') {
	ivyMods.blogConf = {
		article_pub: false,
		publishStatus: false
	};

}

ivyMods.set_iEdit.blog = function(){

	var extraHtml_Record = [
                "<span>" +
                    "<input type='button' value='more fields'  class='iedit-btt' " +
                    " onclick='fmw.toggle(\"form[id^=EDITform] .admin-extraFields\"); return false;' />" +
                "</span>"
                ,"<span>" +
                    "<input type='button' value='settings' class='iedit-btt' " +
                    " onclick='fmw.toggle(\"form[id^=EDITform] .admin-extraSettings\"); return false;' />" +
                "</span>"
                ,"<span>" +
                    "<input type='hidden' name = 'action_methName'  value='deleteRecord' />" +
                    "<input type='submit' name = 'deleteRecord'  value='delete article' class='iedit-btt' " +
			               " onclick = 'return ivyMods.blog.confirmDelete();' />" +
                "</span>"
            ];

	//publish Buttons
/*
	console.log("article_pub = " + ivyMods.blogConf.article_pub
						+ "publishStatus" + ivyMods.blogConf.publishStatus);
*/
	//daca am permisiuni de publicare
	if(ivyMods.blogConf.article_pub) {

		//console.log("Am permisiuni de publish");
		// daca este publicat deja sau nu
		 var publishButton = ivyMods.blogConf.publishStatus
			 ? 'unpublish' : 'publish';


	    extraHtml_Record.push(
		    "<span>" +
               "<input type='hidden' name='action_methName' value='"+publishButton+"'>" +
               "<input type='submit' name='publishStat' value='"+publishButton+"' />" +
          "</span>"
	    );

	} else {
		//console.log("NU Am permisiuni de publish ");
	}


	// configul butoanelor de admin pentru EDITmode
   iEdit.add_bttsConf({
        'SGrecord': {
            modName: 'blog, handler',
            edit: {
                attrValue : 'edit article',
                callback: { fn: ivyMods.blog.adminCallback,
                            context: ivyMods.blog
                            //,args : ''
                           }
            },

            saveBt: {attrValue : 'save article', methName: 'updateRecord'}
           ,extraHtml: extraHtml_Record
        },
        'record' : {
           modName: 'blog, handler',
           addBt : { status : false,  methName: 'addRecord', atrValue: 'add Record', style :" background-color: #D9E9F1;'  "},
           saveBt: { status : false},
           deleteBt:{attrValue: 'delete', methName: 'deleteRecord'},
           edit: {attrValue: 'edit Record'}
        },
        'allrecords': {
            extraButtons: {
               addRecord : {
                   callbackFull : "fmw.toggle('#form-addRecord'); return false; ",
                   attrValue : 'add article',
                   attrName: 'addRecord',
                   attrType:  'button'
               }
            }
        },

        'recordHome' :{
           addBt: {status: false},
           saveBt:{status:false}
        },

        'formatContainer':{
            modName: 'blog',
            saveBt: { async: new fmw.asyncConf({
                      dataSend: {modName: 'blog', methName: 'saveFormat'},
                      /* callBack: {fn: ivyMods.blog.saveTest},*/
                      restoreCore: true })
            },
            addBt: { async: new fmw.asyncConf({
                     dataSend: {modName: 'blog', methName: 'addFormat'},
                     restoreCore: true})
            },
	        deleteBt: { async: new fmw.asyncConf({
                       dataSend: {modName: 'blog', methName: 'deleteFormat'},
                       restoreCore: true })
           }

        },
        'folder':{
            modName: 'blog',
            saveBt: { async: new fmw.asyncConf({
                      dataSend: {modName: 'blog', methName: 'saveFolder'},
                      restoreCore: true })
            },
            addBt: { async: new fmw.asyncConf({
                     dataSend: {modName: 'blog', methName: 'addFolder'},
                     restoreCore: true })
            },
	        deleteBt: { async: new fmw.asyncConf({
                       dataSend: {modName: 'blog', methName: 'deleteFolder'},
                       restoreCore: true })
           }
        }
    });
};

if( typeof ivyMods.blog!= 'undefined'  ) {

    $.extend(true, ivyMods.blog, {

        sel: {
            blogFormats: "*[$=formats]",
            blogFormat: "*[$=format-container]",
            blogFormat_name: "format-container",
            blogSettings: '.blogSettings',
	         adminAuthors: 'form #adminAuthors'
        },

	     confirmDelete: function(){
		     var confirmation = confirm("Are you sure you want to delete this article ?");

		     if(!confirmation) {
			     return false;
		     }
	     },
        adminAuthors: function() {
            // via asset tokeninput
            if(typeof this.authors != 'undefined') {
                console.log('adminAuthors pt selectorul = '
	                + this.sel.adminAuthors
	                +' bucati '+$(this.sel.adminAuthors).length);

                $(this.sel.adminAuthors).tokenInput(
                    fmw.ajaxProxy,
                    {   prePopulate: this.authors,
                        dataSent : {'ajaxReqFile' : 'MODELS/blog/ADMIN/getAuthors.php'},
                        minChars : 3,
                        preventDuplicates: true
                    }
                );
            } else {
                console.log("adminAuthors a fost apelata dar se pare ca sunt probleme");
            }
        },
	    // rescrisa in photoStory pt adaugare de functionalitate
	     adminCallback : function(){

		     this.adminAuthors();

		     /**
		      * Remove all gallery stuff
		      */
		     console.log("Here in adminCallback");
		      $('form *[id^=gallery-container]').remove();

	     },
        popUpblogSettings: function(){


            fmw.popUp.init({
                dataSend : {
                    modName: 'blog',
                    methName: 'Set_dataBlogSettings'
                },
                headerName: 'blog settings',
                callbackFn: {
                    fn: ivyMods.blog.blogSettings_liveEdit,
                    context: ivyMods.blog
                },
                widthPop: '400',
	             closeBtn: 'submit'
            });

        },

        /*saveTest: function(Name, id, data){
            console.log( "S-a produs un post cu \n"+
                "Name = "+ Name + "\n" +
                "id = "+ id + "\n"
               // + "data = "+data + "\n"
            );
        },*/

        blogSettings_liveEdit: function(){

            iEdit.init.start_iEdit(this.sel.blogSettings);
        },
        Ainit: function(){
            if(fmw.isset(fmw.getData['blogSettings']) && fmw.isset(iEdit)) {
                this.popUpblogSettings();
            }
        }
    });
}


$(document).ready(function(){
    ivyMods.blog.Ainit();
});
