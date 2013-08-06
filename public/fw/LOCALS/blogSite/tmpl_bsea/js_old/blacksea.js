$(document).ready(function() {
var place;
var filter;
var PanelOpen;
var ShareClicked;
var moretext;
PanelOpen = true;
ShowText=false;
ShareClicked=false;

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
  		place = $(this).attr('id');
  		$("#"+place+"_place").show();
  		},
  		function () {
  	 	place = $(this).attr('id'); 
  		$("#"+place+"_place").hide();
  		}	
  	);
  
  $(".mainFeaturedImg").hover(
  function(){
  	number=$(this).attr('id');
  	$("#"+number+"_Thumb").show();
  		},
  		function () {
  	 	number = $(this).attr('id'); 
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

	
$(".showMore").click(function () {
	moretext=$(this).attr('id');
if (ShowText ==true) {
  		$("#"+moretext+"_text").slideUp();
  		$(this).html("More");
  		ShowText=false;
  		}
 else {
 		$("#"+moretext+"_text").slideDown();
  		$(this).html("Less");
  		ShowText=true;
  		} 		  		

  });
   		
   });
  
 