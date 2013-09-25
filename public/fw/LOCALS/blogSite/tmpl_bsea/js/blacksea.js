ivyMods.set_iEdit.blogSite = function(){

	var pageDescSettings = {
		modName: 'blogSite',
		saveBt: {
			attrValue: "save description",
			methName: "save_descPage"
		}
	};

	iEdit.add_bttsConf( {
		aboutDesc:  pageDescSettings,
		blogDesc: pageDescSettings,
		archiveDesc: pageDescSettings,
		sponsorsDesc: pageDescSettings,
		awardsDesc: pageDescSettings


	});
}


ivyMods.blogSite = {

    sel: {
       records: "*[class$=SGrecord] , *[class$=record]",
       recordArchive_content: "*[class~=SGrecord-archive] *[class$=content]",
	    selectedFilters : 'filters-selected',
	    hoverFilters : 'filters-hover',
	    filtersPanel: function(filterId) {return "#" + filterId + "_panel"; }
    },
    enforceStyling: function(){

        //toate elementele vor fi stripuite de style
        $(this.sel.records)
            .find('*[class$=content], *[class$=lead], *[class$=blogPrev-lead], *[class$=blogPrev-content]')
            .find('*').attr("style",'');

        /*var recordArchive_content = $(this.sel.recordArchive_content);
        var maxWidth = recordArchive_content.width();
        recordArchive_content.find('img, iframe').map(function(){
                $(this).attr('style', "width = "+maxWidth+"px !important;");
        });*/


    },
    writeLoginLink: function (){
        var el = $("div.footerText");
        el.html(el.html() + "<a href='/?login'>Login</a>");
    },
    showMoreText: function(){
        $(".showMore").live('click',function ()
        {

            var moretext=$(this).attr('id');
            var jqMoretext = $("#"+moretext+"_text");

            var visibleStat = jqMoretext.is(':visible');

            if (visibleStat ==true) {

                jqMoretext.slideUp();
                $(this).html("More");

                var scrollAt = $(this).data('scrollat')
                //console.log("scrollAt "+scrollAt );

                $(window).scrollTop(scrollAt);

            } else {

                var scrollAt = $(window).scrollTop();

                //console.log("scrollAt "+scrollAt );
                $(this)
                    .html("Less")
                    .data('scrollat', scrollAt);
                jqMoretext.slideDown();
            }

        });
    },
    resizeImg: function(jqImg, proportion){
	     var h = jqImg.height();
        var w = jqImg.width();

	    var newH = w / proportion;

        //if (h > w) {}
	    //console.log("poze gasite "+ jqImg.attr('src') + ' height = ' + h);
	    //console.log("poze gasite "+ jqImg.attr('src') + ' width = ' + w);

	    jqImg.parent().css('height', newH + 'px');
	    //console.log("poze gasite "+ jqImg.attr('src') + ' height = ' + newH + '\n');

    },
	 resizeImgs: function(){
		 $('.mainFeaturedImg > a > img').each(function(){
		    ivyMods.blogSite.resizeImg($(this), 248/152);
	    });

		 $('.mainFeaturedImg-profilePhoto   img').each(function(){
		    ivyMods.blogSite.resizeImg($(this), 219/125);
	    });

	 },

	 // filters - archive
	 removeallFilters: function(){
		 $(".imageColumn.filter").removeClass(this.sel.selectedFilters);
		 $(".imageColumn.filter").removeClass(this.sel.hoverFilters);
		 $(".filter_panel").hide();

	 },
	 selectFilter : function(jqFilter){
		 this.removeallFilters();
		 jqFilter.addClass(this.sel.selectedFilters);
		 var filterId = jqFilter.attr('id');
		 $(this.sel.filtersPanel(filterId)).show();

	 },
	 hoverFilter: function(jqFilter){
        if (jqFilter.hasClass(this.sel.selectedFilters)) {

        } else {
	        jqFilter.toggleClass(this.sel.hoverFilters);
        }
	 },
	 bindsFilters: function(){

		 this.selectFilter($('.'+this.sel.selectedFilters));
		 $(".imageColumn.filter").click(function(){
			 ivyMods.blogSite.selectFilter($(this));
		 });

		 $(".imageColumn.filter").hover(function () {
            ivyMods.blogSite.hoverFilter($(this));
	     });

	 },

	/**
	 * stick bar ( use asset sticky.js)
	 * for css details look in blogSite.css
	 *
	 * @param selector - selectorul pe care se face sticky
	 * @param replaceClass - pt wraperul stickerului ,
	 * se va pune doar cand se face sticky
	 */
	stickyBar: function(selector, stickyClass) {

		var jqSelector = $(selector);
		if(jqSelector.length) {
			jqSelector.sticky({
					getWidthFrom: $('#sticky-container'),
					wrapperClassName: 'wrapSticky',
					className: stickyClass,
					topSpacing: 35
				});
		}

	},
	stickBars : function(){

		this.stickyBar('#sticky-archive', 'sticked-archive');
		this.stickyBar('#sticky-blog', 'sticked-blog');


		$('.topbar').sticky({
			getWidthFrom: $('body'),
			wrapperClassName: 'wrapSticky-topbar',
			className: 'sticked-topbar',
			topSpacing: 0

		});
	},

   init: function (){
        this.writeLoginLink();
        this.showMoreText();
        this.enforceStyling();

        this.resizeImgs();

	     $(window).resize(function() {
		     ivyMods.blogSite.resizeImgs();
	     });

	     this.bindsFilters();

	     // daca a fost inclus pluginul de sticky bar
	     if(typeof  $.fn.sticky == 'function') {
	   	   this.stickBars();
		  }
    }
};

$(document).ready(function() {

    ivyMods.blogSite.init();

    var PanelOpen = true;

    setTimeout(function(){
            $(".manifesttext").slideUp();
            $(".controlmanifest").html("Show manifesto");
            PanelOpen=false;
            }, 1000);

    setTimeout(function(){
            $("#chisinau").css("display", "block");
            }, 2000);

    setTimeout(function(){
            $("#baku").css("display", "block");
            }, 2700);

    $(".controlmanifest").click(function () {

        if (PanelOpen ==true) {
            $(".manifesttext").slideUp();
            $(this).html("Show manifesto");
            PanelOpen=false;
            $(".onTheMap").css("display","block");
        } else {
            $(".manifesttext").slideDown();
            $(this).html("Close manifesto");
            PanelOpen=true;
            $(".onTheMap").css("display","none");
            }

    });

  	$(".onTheMap").hover(
  		function(){
  		    var place = $(this).attr('id');
  		    $("#"+place+"_place").show();
  		},
  		function () {
            var place = $(this).attr('id');
  		    $("#"+place+"_place").hide();
  		}
  	);

  $(".mainFeaturedImg").hover(
     function(){
        var number=$(this).attr('id');
        $("#"+number+"_Thumb").show();
      },
  	  function () {
  	 	var number = $(this).attr('id');
  		$("#"+number+"_Thumb").hide();
  }
  );

});

