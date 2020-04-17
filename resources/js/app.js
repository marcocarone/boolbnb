require('./bootstrap');

$(document).ready(function() {

    var oldquery;
    $("#address").keyup(function(event) {
        var query = event.target.value;
        oldquery = query;
        setTimeout(function() {
            if (query == oldquery) {
                console.log(query);
                $.ajax({
                    url: "https://api.tomtom.com/search/2/search/" + query + ".json?",
                    method: "GET",
                    data: {
                        "typeahead": true,
                        "lat": 42.66,
                        "lon": 12.66,
                        "countrySet": "IT",
                        "language": "it-IT",
                        "idxSet": "Geo,Str,PAD",
                        "entityType": "CountrySubdivision,Municipality",
                        "key": "UFC7enGQTVyFY9pIpGvZvOiXIxQXpx1M"
                    },
                    success: function(response) {
                        console.log(response);
                        var suggestions = [];
                        for (var i = 0; suggestions.length < 5 && response.results[i]; i++) {
                            suggestions.push({
                                "address": response.results[i].address.freeformAddress,
                                "lat": response.results[i].position.lat,
                                "lon": response.results[i].position.lon
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
        }, 600);
    });
    $(document).on("click", function() {
        $(".dropdown-address").addClass("hidden");
    });
    $(document).on("click", ".dropdown-address ul li", function() {
        $('#address').val($(this).text());
        $('#latitude').val($(this).data('latitude'));
        $('#longitude').val($(this).data('longitude'));
    });

    var latitude = $(".map").attr("data-lat");
    var longitude = $(".map").attr("data-lon");
    console.log(longitude);
    var center = [longitude, latitude];
    var map = tt.map({
        key: 'UFC7enGQTVyFY9pIpGvZvOiXIxQXpx1M',
        container: 'map',
        style: 'tomtom://vector/1/basic-main',
        center: [longitude, latitude],
        zoom: 10
    });

    var config = {
        key: 'UFC7enGQTVyFY9pIpGvZvOiXIxQXpx1M',
        style: 'tomtom://vector/2/relative',
        refresh: 30000
    };

    map.on('load', function() {
        map.addTier(new tt.TrafficFlowTilesTier(config));
    });

    map.addControl(new tt.FullscreenControl());
    map.addControl(new tt.NavigationControl());

    for (var z = 0; z < $(".coordinates").length; z++) {
        // console.log( $(".coordinates")[z].getAttribute("data-lat"));

        var latitude2 = $(".coordinates")[z].getAttribute("data-lat");
        var longitude2 = $(".coordinates")[z].getAttribute("data-lon");

        // marker mappa
        var marker = new tt.Marker({
            draggable: false
        }).setLngLat([longitude2, latitude2]).addTo(map);

        marker.on('dragend', onDragEnd);
    }


    function onDragEnd() {
        var lngLat = marker.getLngLat();
        lngLat = new tt.LngLat(roundLatLng(lngLat.lng), roundLatLng(lngLat.lat));

        popup.setHTML(lngLat.toString());
        popup.setLngLat(lngLat);
        marker.setPopup(popup);
        marker.togglePopup();
    }




});
