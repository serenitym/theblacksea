
$(document).ready(function() {
var place;
var filter;
var PanelOpen;
var ShareClicked;
var moretext;
var PanelOpen = true;
var ShowText=false;
var ShareClicked=false;
var map;


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
  		}
 else {
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

  	  /*
	$(".authorImg").hover(
  		function(){
  		author = $(this).attr('id');
  		console.log(author);
  		$("#"+author+"_q").show();
  		$(".authorImg").hide();
  		},
  		function () {
  	 	author = $(this).attr('id');
  		$("#"+author+"_q").hide();
  		$(".authorImg").show();
  		}
  	);
*/

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

$(".imageColumn.filter").click(
	function(){
	filter = $(this).attr('id');
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

$(".imageColumn.filter").hover(
		function () {
			filter = $(this).attr('id');
			if ($(".imageColumn.filter#" + filter).hasClass('selected')) {} else {
  				$(".imageColumn.filter#" + filter).toggleClass("thickBorderBlue");
  				$(".Name#" + filter + "_name").toggleClass('filterblue');
  				}
  				}
	  		)

/*
$("#chisinau_map").hover(
function () {
    $("#chisinau_place").show();
  },
  function () {
    $("#chisinau_place").hide();
  }
);

$("#baku_map").hover(
function () {
    $("#baku_place").show();
  },
  function () {
    $("#baku_place").hide();
  }
);
*/


var bsea = function(){

    $(".showMore").click(function ()
    {

        var moretext=$(this).attr('id');
        var jqMoretext = $("#"+moretext+"_text");

        var visibleStat = jqMoretext.is(':visible');

        if (visibleStat ==true) {

            jqMoretext.hide();
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
            jqMoretext.show();
        }

    });

}();




});

