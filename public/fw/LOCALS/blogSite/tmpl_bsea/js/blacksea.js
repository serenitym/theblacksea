ivyMods.blogSite = {

    sel: {
       records: "*[class$=SGrecord] , *[class$=record]",
       recordArchive_content: "*[class~=SGrecord-archive] *[class$=content]"
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

    init: function (){
        this.writeLoginLink();
        this.showMoreText();
        this.enforceStyling();
    }
};

$(document).ready(function() {

    ivyMods.blogSite.init();

    var filter;
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

    $(".imageColumn.filter").click(function(){
        var filter = $(this).attr('id');
        if ($(".imageColumn.filter#" + filter).hasClass('selected')) {
            $("#" + filter + "_panel").hide();
        } else {
            $(".imageColumn.filter").removeClass('selected');
            $(".imageColumn.filter#" + filter).addClass('selected');
            $(".imageColumn.filter").removeClass('thickBorderBlue');
            $(".imageColumn.filter#" + filter).addClass('thickBorderBlue');
            $(".Name").removeClass('filterblue');
            $(".Name#" + filter + "_name").addClass('filterblue');
            $(".filter_panel").hide();
            $("#" + filter + "_panel").show();
        }

    });

    $(".imageColumn.filter").hover(function () {
        var filter = $(this).attr('id');
        if ($(".imageColumn.filter#" + filter).hasClass('selected')) {

        } else {
            $(".imageColumn.filter#" + filter).toggleClass("thickBorderBlue");
            $(".Name#" + filter + "_name").toggleClass('filterblue');
        }
    });









});

