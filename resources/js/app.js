require("./bootstrap");
const Handlebars = require("handlebars");
var Chart = require('chart.js');
var moment = require('moment');
var daterangepicker = require("daterangepicker")

// preload della pagina
$(window).on('load', function() {
    $('.preloader').delay(500).fadeOut(700);
});

// funzioni per Header
// menu header scorrimento
$(window).scroll(function() {
    var scroll = $(window).scrollTop();
    if (scroll >= 350) {
        $(".top-header").addClass("fix");
        $(".top-header").addClass("fade-in-top");
        $(".top-header__wrapper").css("border-bottom", "none");
    } else {
        $(".top-header").removeClass("fix");
        $(".top-header").removeClass("fade-in-top");
    }
});

$(document).ready(function() {
moment.locale('it');

    // cambio box checked in pagamenti

    $('.payment-box-checked').on('change', function() {
        if ($(this).parent().parent().hasClass("box-checked") == false) {
            $(".left").find(".box-spec").removeClass("box-checked");
            $(".box-spec").find("h4").removeClass("white-text");
            $(".box-spec").parent().find("h2").removeClass("white-text");
            $(this).parent().parent().addClass("box-checked");
            $(this).parent().parent().find("h4").addClass("white-text");
            $(this).parent().parent().find("h2").addClass("white-text");
        }
    });



    viewMobileMenu($(".parent__drop-down"), $(".drop-down"), $(".close-menu"))
    getWidth($(".drop-down"), $(".parent__drop-down"), $(".close-menu"))


    viewMobileMenu($(".login-menu"), $(".login-menu__drop-down"), $(".close-login-menu"))
    getWidth($(".login-menu__drop-down"), $(".login-menu"), $(".close-login-menu"))

    toggleMenu($(".parent__drop-down"), $(".login-menu__drop-down"), $(".login-menu"), $(".close-login-menu"))
    toggleMenu($(".login-menu"), $(".drop-down"), $(".parent__drop-down"), $(".close-menu"))

    function toggleMenu(parent1, parent2, dropDown, closeMenu) {
        parent1.click(
            function() {
                if (parent2.hasClass("active") == true) {
                    parent2.removeClass("active");
                    dropDown.removeClass("d-none");
                    closeMenu.addClass("d-none");
                }
            });
    }

    function viewMobileMenu(parent, dropMenu, closeMenu) {
        parent.click(
            function() {
                dropMenu.addClass("active");
                parent.addClass("d-none");
                closeMenu.removeClass("d-none");

            });
        closeMenu.click(
            function() {
                dropMenu.removeClass("active");
                parent.removeClass("d-none");
                closeMenu.addClass("d-none");
            })
    }

    // fine menu a tendina
    function getWidth(drop, parentDrop, closeMenu) {
        var width = $(window).width();
        $(window).on('resize', function() {
            if ($(this).width() !== width) {
                width = $(this).width();
                if (width > 1024) {
                    drop.removeClass("active");
                    parentDrop.removeClass("d-none");
                    closeMenu.addClass("d-none");
                }
            }
        });
    }

    // ---------------
    //-----------------------




    function readURL(input) {
        if (input.files && input.files[0]) {
            var reader = new FileReader();

            reader.onload = function(e) {
                $('#blah').attr('src', e.target.result);
            }

            reader.readAsDataURL(input.files[0]);
        }
    }

    $("#validatedCustomFile").change(function() {
        readURL(this);
    });



    simulationCreateAppartment($("#bath-create"), $("#bath-append"));
    simulationCreateAppartment($("#room-create"), $("#room-append"));
    simulationCreateAppartment($("#mq-create"), $("#mq-append"));
    simulationCreateAppartment($("#price"), $("#price-append"));
    simulationCreateAppartment($("#address"), $("#address-append"));
    simulationCreateAppartment($("#create-title"), $("#title-append"));

    function simulationCreateAppartment(id, idAppend) {
        id.on('keyup mouseup mousemove', function() {
            var value = id.val();
            idAppend.text(value);
        });
    }




    // ---------------
    //-----------------------
    //-----------------------


    // contatore visualizzazioni in show apartment
    $('.count').each(function() {
        $(this).prop('Counter', 0).animate({
            Counter: $(this).text()
        }, {
            duration: 2000,
            easing: 'swing',
            step: function(now) {
                $(this).text(Math.ceil(now));
            }
        });
    });

    // mappa
    if ($('#map').length != 0) {
        var ttMap = generateTomTomMap();
        generateMarker(ttMap);
        idCircle;
    }

    // datarangepicker statistics
    if ($('#myChart').length != 0) {
      dataRangePickerGenerator();
      ///////////////////////////////
      apiCallStatistics(moment().subtract(29, 'days').format('L'), moment().format('L'), true);
      ///////////////////////////////
      $('#reportrange').on('apply.daterangepicker', function (ev, picker) {
        let start = $.trim(ev.target.outerText.split('-')[0]);
        let end = $.trim(ev.target.outerText.split('-')[1]);
        apiCallStatistics(start, end, false);
      });
    }
    ////////
    var oldquery;
    $("#address").keyup(function(event) {
        var query = event.target.value;
        oldquery = query;
        setTimeout(function() {
            if (query == oldquery) {
                $.ajax({
                    url: "https://api.tomtom.com/search/2/search/" +
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
                        'key': "MWVEigyGPAZjHyTOtDdAT88VGn5lldaS"
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
        $("#ricerca").removeClass("search__btn-disabled");
        $("#ricerca").addClass("search__btn");
    });
    $('#address').on('input', function() {
        $('#ricerca').prop('disabled', true);
        $("#ricerca").addClass("search__btn-disabled");
        $("#ricerca").removeClass("search__btn");
    });
    //////////////////////////////////////////////
    // filtri
    // cambio il valore del contatore stanze
    $('#rooms_counter').on("click", function(e) {
        var rooms_counter = parseInt($('#rooms_number').text());
        if ($(e.target).hasClass("rooms_minus")) {
            $(".rooms_plus").prop('disabled', false);
            if (rooms_counter > 1) {
                $('#rooms_number').text(rooms_counter - 1);
            }
            if (rooms_counter <= 2) {
                $(".rooms_minus").prop('disabled', true);
            }
            apiCallFilter(ttMap);
        }
        ///////////////////////
        if ($(e.target).hasClass("rooms_plus")) {
            $(".rooms_minus").prop('disabled', false);
            if (rooms_counter < 12) {
                $('#rooms_number').text(rooms_counter + 1);
            }
            if (rooms_counter >= 11) {
                $(".rooms_plus").prop('disabled', true);
            }
            apiCallFilter(ttMap);
        }
    });
    // cambio il valore del contatore bagni
    $('#baths_number').on("click", function(e) {
        var baths_counter = parseInt($('#baths_counter').text());
        if ($(e.target).hasClass("baths_minus")) {
            $(".baths_plus").prop('disabled', false);
            if (baths_counter > 1) {
                $('#baths_counter').text(baths_counter - 1);
            }
            if (baths_counter <= 2) {
                $(".baths_minus").prop('disabled', true);
            }
            apiCallFilter(ttMap);
        }
        ///////////////////////
        if ($(e.target).hasClass("baths_plus")) {
            $(".baths_minus").prop('disabled', false);
            if (baths_counter < 3) {
                $('#baths_counter').text(baths_counter + 1);
            }
            if (baths_counter >= 2) {
                $(".baths_plus").prop('disabled', true);
            }
            apiCallFilter(ttMap);
        }
    });
    // scrivo il raggio nel contatore e aggiorno la mappa
    $("#distance").change(function() {
        $('#distance-value').text($(this).val());
        ttMap.removeLayer(idCircle);
        generateCircleRadius(ttMap);
    });
    $(".change-filter").change(function() {
        apiCallFilter(ttMap);
    });
    /////////////////////////////////////////
    // cambio icona marker per app in hover
    $(".apartment").on({
        mouseenter: function() {
            var thisId = $(this).data('id');
            $('.markerHome[data-id="' + thisId + '"]').addClass('selected-marker');
        },
        mouseleave: function() {
            var thisId = $(this).data('id');
            $('.markerHome[data-id="' + thisId + '"]').removeClass('selected-marker');
        }
    });
    //////////////////////////////////////
});

function generateTomTomMap() {
    var centerLat = parseFloat($("#map").attr("data-lat"));
    var centerLon = parseFloat($("#map").attr("data-lon"));
    var map = tt.map({
        container: 'map',
        key: 'MWVEigyGPAZjHyTOtDdAT88VGn5lldaS',
        style: 'tomtom://vector/1/basic-main',
        center: [centerLon, centerLat],
        zoom: 10
    });
    map.addControl(new tt.FullscreenControl());
    map.addControl(new tt.NavigationControl());
    generateCircleRadius(map);
    return map;
}

function generateMarker(map) {
    $("div.markerHome").remove();
    $("div.mapboxgl-popup").remove();
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
        if (!isShow) {
            element.setAttribute('data-id', apartment.show.split('/').reverse()[0]);
        }
        var marker = new tt.Marker({
            element: element
        }).setLngLat([apartment.longitude, apartment.latitude]).addTo(map);
        if (!isShow) {
            var popupOffsets = {
                top: [0, 0],
                bottom: [0, -40],
                left: [25, -35],
                right: [-25, -35]
            }
            var htmlApt = "<a style='text-decoration: none; color:#000;' href='" +
                apartment.show +
                "'><div style='display:flex; flex-direction: column; width:220px; height:180px;'><b style='padding:5px'>" +
                apartment.title +
                "</b><img style='width:220px; background-size: cover;' src='" +
                apartment.cover_img +
                "'></div></a>";
            var popup = new tt.Popup({
                offset: popupOffsets
            }).setHTML(htmlApt);
            marker.setPopup(popup);
        }
    });
}

function apiCallFilter(map) {
    var centerLat = parseFloat($("#map").attr("data-lat"));
    var centerLon = parseFloat($("#map").attr("data-lon"));
    var services_filter = $("input[type=checkbox]:checked.checkbox").map(function() {
        return $(this).val()
    }).get();
    var distance_filter = parseInt($("#distance").val());
    var baths_counter = parseInt($('#baths_counter').text());
    var rooms_counter = parseInt($('#rooms_number').text());
    $.ajax({
        url: "api/filtered",
        method: "POST",
        data: {
            'services': services_filter,
            'baths': baths_counter,
            'rooms': rooms_counter,
            'distance': distance_filter,
            'centerLongLat': [centerLon, centerLat],
        },
        dataType: "json",
        success: function(data, message, xhr) {
            if (xhr.status == 200) {
                $("#apartments").empty();
                $("div.messageResult").empty();
                var template = Handlebars.compile($("#entry-template").html());
                for (let index = 0; index < data.results.length; index++) {
                  if (data.results[index].sponsored) {
                      $("#apartments").append(template(data.results[index]));
                  }
                }
                for (let index = 0; index < data.results.length; index++) {
                  if (!data.results[index].sponsored) {
                      $("#apartments").append(template(data.results[index]));
                  }
    
                }
                generateMarker(map);
                if (!data.results.length) {
                    $("div.messageResult").empty();
                    $(".messageResult").append('<h2>La ricerca non ha prodotto risultati</h2>');
                }
            } else {
                $("div.messageResult").empty();
                $(".messageResult").append('<h2>Errore server APi</h2>');
            }
        },
        error: function() {
            $("div.messageResult").empty();
            $(".messageResult").append('<h2>Impossibile effettuare la richiesta</h2>');
        }
    });
}

function generateCircleRadius(map) {
    var centerLat = parseFloat($("#map").attr("data-lat"));
    var centerLon = parseFloat($("#map").attr("data-lon"));
    var radius = parseInt($('#distance-value').text());
    //cal per raggio a 128 punti
    var rad = 3.14159265359;
    var radLat = radius / 111.1896;
    var radLon = radius / 82.633;
    var coordinates = [];
    idCircleTemp = Date.now().toString();
    idCircle = idCircleTemp;
    for (let index = 0; index < 512; index++) {
        coordinates.push([centerLon + radLon * Math.cos(rad * index / 256), centerLat + radLat * Math.sin(rad * index / 256)])
    }
    map.once('idle', function() {
        map.addLayer({
            'id': idCircleTemp,
            'type': 'fill',
            'source': {
                'type': 'geojson',
                'data': {
                    'type': 'Feature',
                    'geometry': {
                        'type': 'Polygon',
                        'coordinates': [coordinates]
                    }
                }
            },
            'layout': {},
            'paint': {
                'fill-color': '#db356c',
                'fill-opacity': 0.13,
                'fill-outline-color': '#db356c'
            }
        });
    });
}



function apiCallStatistics(startdate, enddate, first = false) {
	var apartmentId = parseInt($("#apartment-id").attr("data-id"));
	$.ajax({
		url: location.origin + "/api/statistics",
		method: "POST",
		data: { 'apartmentId': apartmentId, 'startDate': startdate, 'endDate': enddate },
		dataType: "json",
		success: function (data, message, xhr) {
			if (xhr.status == 200) {
				$("div.messageResult").empty();
				var labelsCharts = [];
				var dataCharts = [];
				for (let i = 0; i < data[0].length; i++) {
					labelsCharts.push(moment(data[0][i].date).format('L'));
					dataCharts.push(data[0][i].views);
				}
				if (first) {
					generateChart(labelsCharts, dataCharts, dataCharts.reduce((a, b) => a + b, 0));
				} else {
					removeChartData(myChart);
					addChartData(myChart, labelsCharts, dataCharts, dataCharts.reduce((a, b) => a + b, 0));
				}
			} else {
				$("div.messageResult").empty();
				$(".messageResult").append('<h2>Non è stato possibile elaborare i dati</h2>');
			}
		},
		error: function () {
			$("div.messageResult").empty();
			$(".messageResult").append('<h2>Impossibile effettuare la richiesta</h2>');
		}
	});
}

function generateChart(labels, data, totalviews) {
	var ctx = document.getElementById('myChart');
	myChart = new Chart(ctx, {
		type: 'bar',
		data: {
			labels: labels,
			datasets: [{
				label: 'Visualizzazioni Totali: ' + totalviews,
				data: data,
				backgroundColor: dynamicColors(labels.length),
				borderWidth: 1
			}]
		},
		options: {
			legend: {
				labels: {
					fontColor: 'black',
					fontSize: 18
				}
			},
			responsive: true,
			scales: {
				yAxes: [{
					ticks: {
						stepSize: 1,
						beginAtZero: true
					}
				}]
			}
		}
	});
}

function dynamicColors(a) {
	var data = [];
	var m = 2;
	if (a < 10) {
		m = 9;
	}
	for (let index = 0; index < a; index++) {
		data.push("rgba(" + (170 + (m * index)) + "," + (45 - (m * index)) + "," + (90 - (m * index)) + ", 0.73)")
	}
	return data;
}

function addChartData(chart, label, data, totalviews) {
	chart.data.labels = label;
	chart.data.datasets.forEach((dataset) => {
		dataset.label = 'Visualizzazioni Totali: ' + totalviews;
		dataset.data = data;
		dataset.backgroundColor = dynamicColors(label.length);
	});
	chart.update();
}

function removeChartData(chart) {
	chart.data.labels.pop();
	chart.data.datasets.forEach((dataset) => {
		dataset.label = "";
		dataset.data.pop();
		dataset.backgroundColor.pop();
	});
	chart.update();
}

function dataRangePickerGenerator() {
	var start = moment().subtract(29, 'days');
	var end = moment();
	function cb(start, end) {
		$('#reportrange span').html(start.format('L') + ' - ' + end.format('L'));
	}
	$('#reportrange').daterangepicker({
		locale: {
			"format": "DD/MM/YYYY",
			"separator": " - ",
			"applyLabel": "Applica",
			"cancelLabel": "Cancella",
			"fromLabel": "Da",
			"toLabel": "A",
			"customRangeLabel": "Personalizza",
			"weekLabel": "S",
			"daysOfWeek": [
				"Dom",
				"Lun",
				"Mar",
				"Mer",
				"Gio",
				"Ven",
				"Sab"
			],
			"monthNames": [
				"Gennaio",
				"Febbraio",
				"Marzo",
				"Aprile",
				"Maggio",
				"Giugno",
				"Luglio",
				"Augosto",
				"Settembre",
				"Ottobre",
				"Novembre",
				"Dicembre"
			],
			"firstDay": 1
		},
		opens: 'right',
		startDate: start,
		endDate: end,
		ranges: {
			'Oggi': [moment(), moment()],
			'Ieri': [moment().subtract(1, 'days'), moment().subtract(1, 'days')],
			'Ultimi 7 Giorni': [moment().subtract(6, 'days'), moment()],
			'Ultimi 30 Giorni': [moment().subtract(29, 'days'), moment()],
			'Mese Corrente': [moment().startOf('month'), moment().endOf('month')],
			'Mese Precedente': [moment().subtract(1, 'month').startOf('month'), moment().subtract(1, 'month').endOf('month')]
		}
	}, cb);
	cb(start, end);
}
