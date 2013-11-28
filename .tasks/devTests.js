head.js("http://libs.cartocdn.com/cartodb.js/v3/cartodb.js");
head.ready(function() {


art.insertHtml = function(){
	$("*[class^=EDeditor][class$=pulledQuotes]")
		.before(
		'<div class="center space" id="art-container-map">' +
		   '<div class="divider">&nbsp;</div>' +
		    '<div class="fullwidth"><!-- begin map -->' +
					'<div id="cartodb-map-fishy">&nbsp;</div> ' +
					'<div id="intro">' +
						' <div class="black_container">&nbsp;</div>' +
						' <div class="intro_container">&nbsp;</div>' +
						' <div class="title_container">Armenias Parliament tightens grips on fish-farming</div>' +
						' <div class="place_container">Zorak, Armenia</div>' +
						' <div class="authors_container">By Monica Ulmanu, Kristine Aghalaryan and Grisha Balasanyan</div>' +
						' <div class="lead_container">Members of Armenias Parliament and local Government officials have dived into the fish-farm business in hope of quick profits - as this map reveals.' +
						'</div>' +
						' <div class="show_container">Show the map</div>' +
				 ' </div>' +
				 '<div class="armenia_locator">' +
					'<img class="pull-right" src="http://illos.monicaulma.nu/blacksea/foto/locator_armenia.png" style="width: initial !important;" />' +
				 '</div>' +
			'</div>'+
		'</div>'
		);
}
art.init = function (){

      // initiate leaflet map
	art.map = new L.Map("cartodb-map-fishy", {scrollWheelZoom:false,
              center: [40.070584,44.325859],
              zoom: 12
      });

      L.tileLayer("https://dnv9my2eseobd.cloudfront.net/v3/cartodb.map-4xtxp73f/{z}/{x}/{y}.png", {opacity:0.75}).addTo(art.map);

      var layerUrl = "http://ulmonica.cartodb.com/api/v2/viz/9e885136-45a9-11e3-a07b-3085a9a956e8/viz.json";

      cartodb
          .createLayer(art.map, layerUrl)
          .addTo(art.map)
          .on("done", function(layer) {
                // change the query for the first layer
      }).on("error", function() {
        //log the error
      });
    }
art.binds = function(){
	$(".armenia_locator").hide();
	$(".show_container").click(function() {

	      $(".black_container").hide();

	      $(".intro_container").hide();

	      $(".title_container").hide();

	      $(".place_container").hide();

	      $(".authors_container").hide();

	      $(".lead_container").hide();

	      $(".show_container").hide();

	      $(".armenia_locator").show();

  });

}

art.insertHtml();
art.init();
art.binds();

});
