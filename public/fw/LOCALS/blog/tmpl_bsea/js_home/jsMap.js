if( typeof ivyMods.blog == 'undefined'  ) {
    ivyMods.blog = {};
}
$.extend ( true, ivyMods.blog ,
{
	sel: {
		cartoDb: "#cartodb-map"
	},
	cartoDb_smallSize: {height: '250px', background: '#000'},
	cartoDb_fullSize: {height: '550px', background: '#333'},

	cartoDb_init: function(){
      // initiate leaflet map
       var map = new L.Map('cartodb-map', {scrollWheelZoom:false,
       	        center: [44.016521,35.264397],
         zoom: 6
       })

       L.tileLayer('https://dnv9my2eseobd.cloudfront.net/v3/cartodb.map-4xtxp73f/{z}/{x}/{y}.png', {opacity:0.75}).addTo(map);

       var layerUrl = 'http://ulmonica.cartodb.com/api/v2/viz/a7ed9fa6-f9e6-11e2-91a0-3085a9a956e8/viz.json';

       cartodb.createLayer(map, layerUrl)
        .addTo(map)
        .on('done', function(layer) {
         // change the query for the first layer

       }).on('error', function() {
         //log the error
       });

		//resize map
		this.cartoDb_resize();

	},
	cartoDb_resize: function(){

		var cartoDb = $(ivyMods.blog.sel.cartoDb);
		setTimeout(function(){
			cartoDb.animate( ivyMods.blog.cartoDb_smallSize,1000);
		},2500);

		//binds for resizing
		cartoDb
			.hoverIntent({
				over: function(){
					cartoDb.animate( ivyMods.blog.cartoDb_fullSize,700);

				},
				out: function(){
					cartoDb.animate( ivyMods.blog.cartoDb_smallSize,700);

				}
			});
	}
});

$(document).ready(function() {
   ivyMods.blog.cartoDb_init();


});