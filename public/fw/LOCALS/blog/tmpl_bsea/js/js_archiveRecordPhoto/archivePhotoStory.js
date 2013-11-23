/*if( typeof ivyMods.blog == 'undefined'  ) {
    ivyMods.blog = {};
}*/
$.extend ( true, ivyMods.blog ,
{
	// clasele si id-urile cu care se lucreaza
	css: {
		cls: {},
		ids: {
			galleryContainer: 'recordGallery'
		}
	},
	sel : {
		recordGallery: '#recordGallery'
	},
	// selectile jquery - pentru a minimiza cautarea in dom
	jq: {
		//recordGallery :{}
		//jqGalleryContainer: {}
		// article
	},

	/**
	 * redimensioneaza galeria la 100% din container width si
	 * 70% din width-ul preluat
	 *
	 */
	recordGallery_setMetrics: function(){
		var width = this.jq.article.width();
		var height = width*0.7;

		this.jq.recordGallery.width(width);
		this.jq.recordGallery.height(height);
	},

	archivePhoto_gallery: function(jqCont){
		/**
		 * indentifica continutul ( content )
		 * creaza deasupra lui un container pentru galerie
		 *
		 */
		// selecteaza asrticolul
		this.jq.article = $(this.sel.article);

		// adauga un container pentru galerie
		$(this.sel.sideContent)
			.before("<div id='"+this.css.ids.galleryContainer+"' ></div>");
		// retine selectia galeriei
		this.jq.recordGallery = this.jq.article.find(this.sel.recordGallery);
		// redimensioneaa galeria
		this.recordGallery_setMetrics();

		// redimensioneaza galeria la windowresize
		$(window).resize(function(){
			ivyMods.blog.recordGallery_setMetrics();
		});

		// ruleaza galeria pe containerul creat cu sursa datasi creata
		// in blogRecord.js ( see : function onload_article())
		Galleria.run(this.sel.recordGallery ,{
			 dataSource: '#'+jqCont.galleriaID
		 });
	},

   /**
    *  functie generalista pentru tipurile de articole
    *  apelata automat de onload_article();
    *  o astfel de functie poate fi creata si pentru alte tipuri
    *  de articole cu ar fi story , multimedia...etc
	*/
	manageArticle_dep : function(jqCont){
		if(jqCont.imgs.length >= 3){
			this.archivePhoto_gallery(jqCont);
		} else {
			jqCont.imgs.show();
		}

	}
});

