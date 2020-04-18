require("./bootstrap");
const Handlebars = require("handlebars");

$(document).ready(function() {
	var oldquery;
	$("#address").keyup(function(event) {
		var query = event.target.value;
		oldquery = query;
		setTimeout(function() {
			if (query == oldquery) {
				console.log(query);
				$.ajax({
					url:
						"https://api.tomtom.com/search/2/search/" +
						query +
						".json?",
					method: "GET",
					data: {
						'typeahead': true,
						'lat': 42.66,
						'lon': 12.66,
						'countrySet': "IT",
						'language': "it-IT",
						'idxSet': "Geo,Str,PAD",
						'entityType': "CountrySubdivision,Municipality",
						'key': "z4n3yxl4X8bvK1BA6YlSAaYcV7OTbkZc"
					},
					success: function(response) {
						console.log(response);
						var suggestions = [];
						for (var i = 0; suggestions.length < 5 && response.results[i]; i++) {
							suggestions.push({
								'address': response.results[i].address.freeformAddress,
								'lat': response.results[i].position.lat,
								'lon': response.results[i].position.lon
							});
						}
						$(".dropdown-address ul").html("");
						$(".dropdown-address").removeClass("hidden");
						for (var i in suggestions) {
							$(".dropdown-address ul").append("<li data-latitude='" + suggestions[i].lat + "' data-longitude='" + suggestions[i].lon + "'>" + suggestions[i].address + "</li>");
						}
					},
					error: function() {
						console.log("error");
					}
				});
			}
		}, 200);
	});
	$(document).on("click", function() {
		$(".dropdown-address").addClass("hidden");
	});
	$(document).on("click", ".dropdown-address ul li", function() {
		$("#address").val($(this).text());
		$("#latitude").val($(this).data("latitude"));
		$("#longitude").val($(this).data("longitude"));
		if ($("#latitude").val().length !== 0) {
			$("#ricerca").removeAttr("disabled");
			$("#ricerca").removeClass("btn-outline-secondary");
			$("#ricerca").addClass("btn-success");
		}
	});
	// filtro dei servizi
	$(".checkbox").change(function() {
		var services_array = $("input[type=checkbox]:checked.checkbox").map(function() {return $(this).val()}).get();
		$.ajax({
			url: "api/filtered",
			method: "POST",
			data: { 'services': services_array },
			dataType: "json",
			success: function (data, message, xhr) {
				if (xhr.status == 200) {
					$("#apartments").empty();
					var template = Handlebars.compile($("#entry-template").html());
					for (let index = 0; index < data.results.length; index++) {
						var payload = data.results[index];
						payload["cover_img_hb"] = "/storage/" + data.results[index].cover_img;
						payload["show_route"] = "/apartment/" + data.results[index].id;
						console.log(payload);
						$("#apartments").append(template(payload));
					}
					generateMarker(map);
				}
			},
			error: function() {
				console.log("error");
			}
		});
	});
	// mappa
	var latitude = $(".map").attr("data-lat");
	var longitude = $(".map").attr("data-lon");
	var center = [longitude, latitude];
	var map = tt.map({
		key: "z4n3yxl4X8bvK1BA6YlSAaYcV7OTbkZc",
		container: "map",
		style: "tomtom://vector/1/basic-main",
		center: [longitude, latitude],
		zoom: 10
	});
	var config = {
		key: "z4n3yxl4X8bvK1BA6YlSAaYcV7OTbkZc",
		style: "tomtom://vector/2/relative",
		refresh: 30000
	};
	map.on("load", function() {
		map.addTier(new tt.TrafficFlowTilesTier(config));
	});
	map.addControl(new tt.FullscreenControl());
	map.addControl(new tt.NavigationControl());
	generateMarker(map);
});

function onDragEnd() {
	var lngLat = marker.getLngLat();
	lngLat = new tt.LngLat(
		roundLatLng(lngLat.lng),
		roundLatLng(lngLat.lat)
	);
	popup.setHTML(lngLat.toString());
	popup.setLngLat(lngLat);
	marker.setPopup(popup);
	marker.togglePopup();
}

function generateMarker(map) {
	for (var z = 0; z < $(".coordinates").length; z++) {
		var latitude2 = $(".coordinates")[z].getAttribute("data-lat");
		var longitude2 = $(".coordinates")[z].getAttribute("data-lon");
		var marker = new tt.Marker({draggable: false}).setLngLat([longitude2, latitude2]).addTo(map).on("dragend", onDragEnd);
		}
}