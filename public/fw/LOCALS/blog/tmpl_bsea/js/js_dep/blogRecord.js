if( typeof ivyMods.blog == 'undefined'  ) {
    ivyMods.blog = {
	    conf: { templateFile: ''}
    };
}

var disqus_shortname = 'blacksea-beta'; // required: replace example with your forum shortname

$.extend ( true, ivyMods.blog ,
{
	limitSet : 10,
	css: {
		cls: {
			picCaption: 'storyCaption'
		},
		ids: {}
	},
    sel: {
        basePathPic : "/RES/uploads/images/",
        thumbPathPic : "/RES/uploads/.thumbs/images/",
        colectorPics : '*[class$=thumbRecordPics]',
	     sideContent:      "*[class$=pulledQuotes]",
        imgs:          '*[class$=lead] img, *[class$=content] img',
        iframes:       '*[class$=lead] iframe, *[class$=content] iframe',
        article:       'div[class$=SGrecord]',
        articlesBlog:  'div[class~=blogPrevRec]',
	     blogSet:       function(blogSet){return '*[class^=blogSet_'+blogSet+'] '; },
      //  gallery :      '*[class$=thumbRecordPics] a.fancybox',
        galleria :      '*[class$=thumbRecordPics]',
        liveEdit:      '.ELMcontent',
        adminAuthors: 'form #adminAuthors',
	     getNext_blogRecords: "input[class$=getNext_blogRecords]",
	     content: "*[class$=content]"

    },
    jqCont: {
	   htmlThumbPics: '',
      jq: {},
      jqImgs : {},
      ColectorPics: {},
      galleriaID : {},
      liveEditStat: {},
	   recordPics : []
    },

	asyncRecords : new fmw.asyncConf({
		restoreCore: true,
		dataSend: {
			modName: 'blog, handler',
			methName: 'blog_renderData'
		}
	}),
    // ========================[ event Callbacks ]==============================
	/**
	 * Incarcare asincron a articolelor din blog
	 * Probabil aceste metode ar trebui sa stea in alt js specific doar
	 * templateului de blogRecords
	 */
    bind_getNext_blogRecords: function(){

	      var loadButton = $(this.sel.getNext_blogRecords);

			loadButton.on('click', function(){

				// atentie se poate culege un vector cu toate datele
				var limitStart = $(this).data('blogLimitstart');
				var limitEnd   = $(this).data('blogLimitend');


				ivyMods.blog.asyncRecords
					.fnpost({"limitStart" : limitStart})
					.done(function(data){


						limitStart += 10;
						loadButton.data('blogLimitstart', limitStart);
						loadButton.parent().before(data);
						ivyMods.blog.onload_articlesBlog(limitStart);

						console.log('limit start = '+limitStart + ' limit end = '+limitEnd);
						if(limitStart >= limitEnd) {
							loadButton.next('input[class$=go-topPage]').css('display', 'block');
							loadButton.remove();
						}
					});
				return false;
			});

     },

    // ========================[ thumbnails - galleria ]========================
	//#1
    get_tmplThumbPics_galleria : function(recordPics) {

	    /**
	     * <div id="galleria">
	         <a href="/img/large1.jpg"><img src="/img/thumb1.jpg" data-title="My title" data-description="My description"></a>
	         <a href="/img/large2.jpg"><img src="/img/thumb2.jpg" data-title="Another title" data-description="My <em>HTML</em> description"></a>
	     </div>

	     using:
	     recordPics.push( {srcBig: srcBig, src: src, alt: alt} );

	     */
    	  var htmlPics = '';
	     var indexImage = 0;
        for( var key in recordPics) {
            htmlPics += "<a class='container-photoThumbs' " +
                            "' href='" + recordPics[key].srcBig + "'" +
                            " data-index-image='"+indexImage+"'"+
	                      ">" +
                                "<img class='photoThumbs' " +
                                    "src='" + recordPics[key].src + "'" +
                                    "data-title='" + recordPics[key].alt + "' " +
                                 //   "data-description='" + recordPics[key].alt + "' " +
	                              "/>" +
                        "</a>" ;
	        indexImage++;
        }
        //alert(htmlPics);
        return htmlPics;
    },
    //#2
    set_thumbPics_galleria: function(jqCont){

	     // seteaza html-ul pozelor
       var htmlThumbPics = this.get_tmplThumbPics_galleria(jqCont.recordPics);

        // ascunde pozele care trec de 9
        jqCont.colectorPics
	        .append(htmlThumbPics).find('*[class^=container-photoThumbs]:gt(8)').hide();

    },

	 createGalleria: function(jqCont){

		 jqCont.colectorPics.find("a").on('click', function(){

			 // =========================[ construieste dom-ul pt galleria ]=======
			 /**
			  * Testeaza si retine cea mai mare inaltime
			  * ( intre cea a browserului si cea a lui body)
			  * @type {Number}
			  */
			 var windowHeight = window.innerHeight;
			 var bodyHeight = $('body').height();
			 var canvasHeight = windowHeight > bodyHeight ? windowHeight : bodyHeight;

			 /**
			  * Adauga partea de dom in care va sta galleria
			  */
			 $('body').append(
             "<div id='galleria-container'>" +
	             "<div id='galleria-canvas' style='height: "+canvasHeight+"px; '></div>" +
                "<div id='galleria' ></div>" +
             "</div>"
          );


			 //==============================[ start galleria ]====================
			 /**
			  * Apeleaza si configureaza galeria
			  * - sa porneasca de la imaginea care a fost apasata
			  * - sa preia imaginile sursa din containerul de imagini sursa
			 * */
			 var indexImage = $(this).data('indexImage');
			 //console.log('createGalleria - indexImage = '+indexImage);
			 Galleria.configure({
				 show: indexImage
			 });
			 Galleria.run('#galleria',{
				 dataSource: '#'+jqCont.galleriaID
			 });


			 //==========================[ seteaza pozita si dimensiunea pt galleria]=

			 var jqGalleria = $('#galleria');
			 var marginLeft = jqGalleria.width() / 2;
			 // pozitia scroll-ui
          //$('#topbar-bsea').position().top;
			 var scrollTop = $(window).scrollTop();
			 var top = (window.innerHeight - jqGalleria.height()) / 2 + scrollTop - 50;
			 jqGalleria.css('margin-left', marginLeft);
			 jqGalleria.css('top', top);

			 // adauga butonul de closeGalleria care va face remove la tot domul de galleria
			 jqGalleria.prepend(
				 "<div class='ivy-closeButton-canvas'>" +
					 "<input type='button' class='ivy-light' value='close' id='galleria-close'" +
					 " onclick=\"$('#galleria-container').remove();\">" +
				 "</div>"
			 );

			 // stop from bubbling
			 return false;
		 });
	 },
	 set_containerPics_galleria: function(jqCont){
	     //thumb pics
	     this.set_thumbPics_galleria(jqCont);
	     this.createGalleria(jqCont);
	 },

    //=======================[ container pics ]=================================
    //#1
	 /**
	 * returneaza un array cu datele despre imaginile gasite in content
	 * @param jqCont
	 * @returns {Array}
	 */
    get_RecordPics: function(jqCont){

        var recordPics = new Array();
        var src = '';
        var alt = '';
        var srcBig = '';

        jqCont.imgs.map(function()
        {
            //console.log(" img = "+ $(this).attr('src'));
	         srcBig = $(this).attr('src');
            src    = srcBig.replace(ivyMods.blog.sel.basePathPic,ivyMods.blog.sel.thumbPathPic);
            alt    = $(this).attr('alt');

            recordPics.push( {srcBig: srcBig, src: src, alt: alt} );
        });
        /*var test = '';
        alert(recordPics.length);
        for( var key in recordPics) test += recordPics[key]+'\n\n';
        alert(test);
        */

        return recordPics;

    },
    //#1
	/**
	 * pune aturile imaginilor ca si captions
	 * accordtin to design si doar daca nu suntem in liveEdit mode
	 * @param jqCont
	 */
    captionContentPics: function(jqCont){

        if(jqCont.liveEditStat == 0) {
            jqCont.imgs.map(function(){
                var caption = $(this).attr('alt');
	             var ivyBlog = ivyMods.blog;
                if(caption) {
                    $(this).after(
	                    "<div class='"+ivyBlog.css.cls.picCaption+"'>"
	                        +caption
	                    +"</div>"
                    );
                }
            });
        }
    },

    resize_iframes: function(jqCont){

	    var containerWidth = jqCont.jq.width();
	    var width = 560;
       var height = 315;
       var proportion =   height/width;

       jqCont.iframes.map(function(){
	        $(this).width(containerWidth);
           $(this).height(containerWidth * proportion);
	        $(this).addClass('pull-right');
           /* console.log(
                  "container = " + containerWidth
                + "\n height = " + (containerWidth * proportion)
                +"\n"
            );*/
       });
    },
    //#1
    resizeContentPics: function(jqCont){
        var containerWidth = jqCont.jq.width();
        //console.log("containerWidth " + containerWidth );
        jqCont.imgs.map(function()
        {
            //console.log("imagine width " + $(this).attr('src') + ' = ' + $(this).width());
            $(this).css('height','initial');
	         $(this).width(containerWidth);
	         $(this).addClass('pull-right');

        });
    },

    /**
     * datele din si despre containerul ales
     *
     * 1.jq = jq pentru container
     * 2. imgs = jq pentru imaginile din container (cele mari )
     * 3. colectorPics = jq pentru elementul care contine thumbnailurile
     * 4. gallery = jq pentru elementele care trebuie sa fie in gallery
     * 5. liveEditStat = daca ne aflam sau nu in live-edit
     * @param jqContainer
     * @returns {{}}
     */
    get_containerData : function(jqContainer){

        var jqCont = {};

        jqCont.jq           =  jqContainer;
	    // imaginile din interiorul contentului si leadului
        jqCont.imgs         =  jqContainer.find(this.sel.imgs);
	    // iframeurile din content si lead ex: youtube etc..
        jqCont.iframes      =  jqContainer.find(this.sel.iframes);
	    // unde anume vor fi puse imaginile thumbnal
        jqCont.colectorPics =  jqContainer.find(this.sel.colectorPics);
       // jqCont.gallery    =  jqContainer.find(this.sel.gallery);
	    // id-ul galleriei din cadrul containerului
        jqCont.galleriaID   =  jqContainer.find(this.sel.galleria).attr('id');
        jqCont.liveEditStat =  jqContainer.find(this.sel.liveEdit).length;
  	     // preia json cu pozele pt galerie
	     jqCont.recordPics   =  this.get_RecordPics(jqCont);

        return jqCont;


    },

	 //==========================================================================

	 gallery_metrics: function(article){
		var  metrics = {};
		metrics.width  = article.width();
		metrics.height = metrics.width*0.7;
		if(metrics.width && metrics.height) {
			return metrics;

		} else{
			return false;
		}


	},
    gallery_refreshMetrics: function(article){

		var metrics = this.gallery_metrics(article);
		$('*[id^=gallery-container-]').map(function(){
			$(this).widthHeight(metrics.width, metrics.height);
		});
	},
	 galleries_article: function(jqCont, jqContent){

		var counter = 1;
		var metrics = this.gallery_metrics(jqContent);
		if(!metrics) return ;

		console.log("Metrics for "+jqCont.galleriaID +" width + height =   "+metrics.width+' '+ metrics.height);

		 jqCont.jq.find('.gallery').map(function(){
			 var idGallerySub = 'gallery-container-'+jqCont.galleriaID+'-'+counter;
			$(this).clone()
				.attr('id', idGallerySub)
				.removeClass('gallery')
					.insertBefore($(this));

			 // resize gallery
			$('#'+idGallerySub).widthHeight(metrics.width, metrics.height);

			 //refresh gallery size
			$(window).resize(function(){
				ivyMods.blog.gallery_refreshMetrics(jqContent);
			});
			 //run gallery
			Galleria.run('#'+idGallerySub);
			counter++;
		});
	 },
	//comentarii
    disqus_add: function(){
        var dsq = document.createElement('script'); dsq.type = 'text/javascript'; dsq.async = true;
        dsq.src = '//' + disqus_shortname + '.disqus.com/embed.js';
        (document.getElementsByTagName('head')[0] || document.getElementsByTagName('body')[0]).appendChild(dsq);
    },

	 contSize: {
		 //templateFileName: function(jqcont) {return containerul de referinta pt galleria}
		 'archiveRecord' : function(jqCont){return jqCont.jq;},
		 'blogRecord' : function(jqCont){return jqCont.jq.find('*[class$=content]');}
	 },
    onload_article: function(){

        // prepare article
        var article = $(this.sel.article)
        if(!article.exists()) {
	        return ;
        }

        // ia datele despte articol
        var jqCont = this.get_containerData(article);
        // incarca galleria
        Galleria.loadTheme('/assets/galleria/themes/classic/galleria.classic.min.js');

       /**
        * daca imaginile gasite sunt > 3 atunci  le facem thumbnailuri si gallery
        * #1 - altfel va fi un spatiu gol daca nu sunt poze
        * #2 - seteaza galeia cu adaugare de thumbnailuri , si create galeria
        */
        if(jqCont.imgs.length >= 3){
            // #1
           jqCont.colectorPics.addClass('space');
           // #2
            this.set_containerPics_galleria(jqCont);
        }

         /**
        * daca exista o astfel de functie declara printr-un js inclus
        * va fi apelata ( aici ex: in archivePhotoStory.js
        */
         if(typeof this.manageArticle == 'function') {
            this.manageArticle(jqCont);
         }

        // manage galleries inside article
        this.galleries_article(jqCont, this.contSize[this.conf.templateFile](jqCont));

        // set caption for photos from alt atribute
        this.captionContentPics(jqCont);

        //resizing pics - so they mach the design
        this.resizeContentPics(jqCont);

        //resizing iframes
        if(jqCont.iframes.length) {

            this.resize_iframes(jqCont);
            $(window).resize(function() {
                ivyMods.blog.resize_iframes(jqCont);

            });
        }
        $(window).resize(function() {
             ivyMods.blog.resizeContentPics(jqCont);
        });

       // adauga api-ul de commenturi
       this.disqus_add();
    },
	onload_article2: function(){
       // prepare article
        var article = $(this.sel.article)
        if(!article.exists()) {
	        return ;
        }

        // ia datele despte articol
		 var jqCont = new ivyMods.blogArticle(article);
        // incarca galleria
        Galleria.loadTheme('/assets/galleria/themes/classic/galleria.classic.min.js');

       /**
        * daca imaginile gasite sunt > 3 atunci  le facem thumbnailuri si gallery
        * #1 - altfel va fi un spatiu gol daca nu sunt poze
        * #2 - seteaza galeia cu adaugare de thumbnailuri , si create galeria
        */
        if(jqCont.imgs.length >= 3){
            // #1
           jqCont.colectorPics.addClass('space');
           // #2
	        jqCont.galleria.set_containerPics();
        }

         /**
        * daca exista o astfel de functie declara printr-un js inclus
        * va fi apelata ( aici ex: in archivePhotoStory.js
        */
         if(typeof this.manageArticle == 'function') {
            this.manageArticle(jqCont);
         }

        // manage galleries inside article
		  jqCont.galleria.article( this.contSize[this.conf.templateFile](jqCont));

        // set caption for photos from alt atribute
		  jqCont.captionContentPics();

        //resizing pics - so they mach the design
        this.resizeContentPics(jqCont);

        //resizing iframes
        if(jqCont.iframes.length) {

	        jqCont.resize_iframes();
            $(window).resize(function() {
	            jqCont.resize_iframes();

            });
        }
        $(window).resize(function() {
	        jqCont.resizeContentPics();
        });

       // adauga api-ul de commenturi
       this.disqus_add();
	},

	onload_articlesBlog: function(blogSet){

 		// blogset = setul de articole , see: blogRecords.html
		 var articlesBlog = $(this.sel.blogSet(blogSet)+this.sel.articlesBlog);
       if(articlesBlog.length == 0) {
	       return ;
       }
       Galleria.loadTheme('/assets/galleria/themes/classic/galleria.classic.min.js');

       articlesBlog.map(function()
       {
          var jqCont = ivyMods.blog.get_containerData($(this));

	       /**
	        * daca imaginile gasite sunt > 3 atunci le facem thumbnailuri si gallery
	        */
           if(jqCont.imgs.length >= 3){
	           ivyMods.blog.set_containerPics_galleria(jqCont);
           }

           // manage galleries inside article
           jqCont.jq
              .find('.blogPrev-content')
                 .on('showMore.gallery',function(){
                    //alert('galleries_articlesBlog '+jqont.galleriaID);
                    $(this).off('showMore.gallery');
                    ivyMods.blog.galleries_article(jqCont, $(this));
                 });

           // set caption for photos
           ivyMods.blog.captionContentPics(jqCont);

           //resizing iframes
           if(jqCont.iframes.length) {
               ivyMods.blog.resize_iframes(jqCont);
           }
       });

	 },
	onload_articlesBlog2: function(blogSet){

      // blogset = setul de articole , see: blogRecords.html
		 var articlesBlog = $(this.sel.blogSet(blogSet)+this.sel.articlesBlog);
       if(articlesBlog.length == 0) {
	       return ;
       }
       Galleria.loadTheme('/assets/galleria/themes/classic/galleria.classic.min.js');

       articlesBlog.map(function()
       {
          var jqCont = new ivyMods.blogArticle($(this));

	       /**
	        * daca imaginile gasite sunt > 3 atunci le facem thumbnailuri si gallery
	        */
           if(jqCont.imgs.length >= 3){
	           jqCont.galleria.set_containerPics();
           }

           // manage galleries inside article
           jqCont.jq
              .find('.blogPrev-content')
                 .on('showMore.gallery',function(){
                    //alert('galleries_articlesBlog '+jqont.galleriaID);
                    $(this).off('showMore.gallery');
		           jqCont.galleria.article( $(this));
                 });

           // set caption for photos
           jqCont.captionContentPics();

           //resizing iframes
           if(jqCont.iframes.length) {
	           jqCont.resize_iframes();
           }
       });

	 },
	onload_articles : function(){
		 this.onload_articlesBlog2('unpublished');
	    this.onload_articlesBlog2(10);
	    this.bind_getNext_blogRecords();
	},

    tmplManager: {
	   'blog' : 'onload_articles' ,
	   'blogRecord' : 'onload_article2',
	   'archiveRecord' : 'onload_article2'
    },
    init: function(){
	    //alert('blogRecord.js templateFile = ' + this.conf.templateFile);
	    /**
	     * templateFile could be:
	     *  - blog
	     * archive
	     *  - blogRecord
	     *  - archiveRecord
	     */

	    //console.log('managerul = '+this.tmplManager[this.conf.templateFile]);

	    /**
	     * apeleaza functiile in functie de templateFileul afisat
 	     * @type {string}
	     */
	    var manager = '';
	    eval('manager = this.'+this.tmplManager[this.conf.templateFile]);
	    if(typeof manager == 'function') {
		    manager.call(this);
	    }

    }
}
);

$(document).ready(function(){
    ivyMods.blog.init();
});
