require("./bootstrap");
const Handlebars = require("handlebars");

$(document).ready(function() {
	// mappa
	if ($('#map').length != 0) {
		var ttMap = generateTomTomMap();
		generateMarker(ttMap);
	}
	////////
	var oldquery;
	$("#address").keyup(function(event) {
		var query = event.target.value;
		oldquery = query;
		setTimeout(function() {
			if (query == oldquery) {
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
		$("#ricerca").removeAttr("disabled");
		$("#ricerca").removeClass("btn-outline-secondary");
		$("#ricerca").addClass("btn-success");
	});
	$('#address').on('input', function () {
		$('#ricerca').prop('disabled', true);
		$("#ricerca").addClass("btn-outline-secondary");
		$("#ricerca").removeClass("btn-success");
	});
	// filtro dei servizi
	$(".checkbox").change(function() {
		var services_array = $("input[type=checkbox]:checked.checkbox").map(function() {return $(this).val()}).get();
		$.ajax({
			url: "api/filtered",
			method: "POST",
			data: { 'services': services_array, 'centerLongLat': [$("#map").data("lon"), $("#map").data("lat")]},
			dataType: "json",
			success: function (data, message, xhr) {
				console.log(data);
				if (xhr.status == 200) {
					$("#apartments").empty();
					$("div.messageResult").empty();
					var template = Handlebars.compile($("#entry-template").html());
					for (let index = 0; index < data.results.length; index++) {
						$("#apartments").append(template(data.results[index]));
					}
					generateMarker(ttMap);
					if (!data.results.length) {
						$(".messageResult").append('<h2>La ricerca non ha prodotto risultati</h2>');
					}
				} else {
					$(".messageResult").append('<h2>Errore server APi</h2>');
				}
			},
			error: function() {
				$(".messageResult").append('<h2>Impossibile effettuare la richiesta</h2>');
			}
		});
	});
});

function generateTomTomMap() {
	var map = tt.map({
		container: 'map',
		key: 'z4n3yxl4X8bvK1BA6YlSAaYcV7OTbkZc',
		style: 'tomtom://vector/1/basic-main',
		center: [$("#map").attr("data-lon"), $("#map").attr("data-lat")],
		zoom: 10
	});
	return map;
}

function generateMarker(map) {
	$("div.markerHome").remove();
	apartmentArray = [];
	var isShow;
	$(".apartment-show").length == 1 ? isShow = true : isShow = false;
	if (isShow) {
		apartmentArray.push({
			'longitude': $(".coordinates").data('lon'),
			'latitude': $(".coordinates").data('lat'),
		});
	} else {
		for (let i = 0; i < $(".apartment").length; i++) {
			apartmentArray.push({
				'show': $(".apartment .imgdiv a")[i].getAttribute("href"),
				'title': $(".apartment .image_home")[i].getAttribute('alt'),
				'cover_img': $(".apartment .image_home")[i].getAttribute('src'),
				'longitude': $(".apartment .coordinates")[i].getAttribute('data-lon'),
				'latitude': $(".apartment .coordinates")[i].getAttribute('data-lat'),
			});
		}
	}
	apartmentArray.forEach(apartment => {
		var element = document.createElement('div');
		element.classList.add("markerHome");
		var marker = new tt.Marker({element: element}).setLngLat([apartment.longitude, apartment.latitude]).addTo(map);
		if (!isShow) {
			var popupOffsets = {
				top: [0, 0],
				bottom: [0, -40],
				left: [25, -35],
				right: [-25, -35]
			}
			var htmlApt = "<a style='text-decoration: none; color:#000;' href='" +
				apartment.show +
				"'><div style='display:flex; flex-direction: column; width:220px; height:180px;'><b>" +
				apartment.title +
				"</b><img style='width:220px; background-size: cover;' src='" +
				apartment.cover_img +
				"'></div></a>";
			var popup = new tt.Popup({ offset: popupOffsets }).setHTML(htmlApt);
			marker.setPopup(popup);
		}
	});
}