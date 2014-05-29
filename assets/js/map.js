/* 
 *  Copyright 2014 Frederich.
 *  All rights reserved.
 *
 */

var mapJS = {};

mapJS.loadMarkersFromKMLAsync = function(kmlURL, map) {
    function KMLHandler() {
        this.markers = null;
        this.listeners = new Array();
        this.faulureListeners = new Array();

        this.notifyListeners = function() {
            if (null === this.markers)
                return;
            for (var i in this.listeners) {
                this.listeners[i](this.markers);
            }
        };

        this.notifyFailureListeners = function(msg) {
            for (var i in this.faulureListeners) {
                this.faulureListeners[i](msg);
            }
        };

        this.addMarkersLoadedListener = function(listener) {
            if (null === this.markers)
                this.listeners.push(listener);
            else
                listener(this.markers);
        };

        this.addFailureListener = function(listener) {
            if (null !== this.markers)
                return;
            this.faulureListeners.push(listener);
        };
    }

    var handler = new KMLHandler();
    handler.listeners = new Array();
    $.ajax({
        url: 'http://xml2json.herokuapp.com/?callback=json&url=' + kmlURL,
        type: 'GET',
        crossDomain: true,
        dataType: 'jsonp'
    }).done(function(data) {
        var placemarkers = data['kml']['Document']['Folder']['Placemark'];
        var markers = [];
        for (var i in placemarkers) {
            var coords = placemarkers[i]['Point']['coordinates'];
            var place = placemarkers[i]["name"];
            var desc = placemarkers[i]["description"];
            var c = coords.split(",");
            var latlng = new google.maps.LatLng(c[1], c[0]);

            var marker = new google.maps.Marker({
                position: latlng,
                map: map,
                title: place,
                icon: 'http://maps.google.com/mapfiles/ms/micons/blue-dot.png'
            });

            if (desc === undefined || desc === null)
                desc = "";
            marker.description = desc;
            markers.push(marker);
        }
        handler.markers = markers;
        handler.notifyListeners();

    }).fail(function() {
        console.log("Load Map Fails");
        handler.notifyFailureListeners("Load Map Fails");
    });
    return handler;
};

mapJS.createInfoWindow = function(title, description) {
    var infowindow =
            new google.maps.InfoWindow({maxWidth: 200});
    var content = '<div class="marker_title">' + title + '</div>';

    if (description !== undefined && description !== null && description.length > 0) {
        content += '<div class="marker_descriptioon">' + description + '</div>';
    }
    var currentWindow = null;
    google.maps.event.addListener(infowindow, 'domready', function() {
        $(".marker_title").parent().parent().parent().attr("class", "infoWindow");
        var zindex = parseInt($(".infoWindow").css("z-index"));
        $(".infoWindow").mouseover(function() {
            if (currentWindow !== null) {
                currentWindow.css("z-index", zindex);
            }
            currentWindow = $(this);
            $(this).css("z-index", zindex + 1000);
        });
    });
    infowindow.setContent(content);
    return infowindow;
};

mapJS.attachInfoWindow = function(markers) {
    for (var i in markers) {
        var marker = markers[i];

        var infowindow = mapJS.createInfoWindow(marker.title, marker.description);
        marker.infoWindow = infowindow;
        infowindow.open(marker.map, marker);
    }
};

mapJS.searchMarkerStartsWithString = function(markers, name) {
    for (var i in markers) {
        if (0 === markers[i].getTitle().toLowerCase().indexOf(name.toLowerCase())) {
            return markers[i];
        }
    }
    return null;
};

mapJS.focusMarker = function(markers, names, displayDescription, openWindow) {
    if (typeof names === "string") {
        names = [names];
    }

    if (typeof (displayDescription) === "undefined") {
        if (names.length > 1)
            displayDescription = true;
        else
            displayDescription = false;
    }

    var map = null;
    var selectedMarkers = [];
    for (var i in names) {
        var marker = mapJS.searchMarkerStartsWithString(markers, names[i]);
        if (marker !== null) {
            selectedMarkers.push(marker);
            if (openWindow) {
                var infoWindow = marker.infoWindow;
                if (!(displayDescription)) {
                    infoWindow.content =
                            '<div class="marker_title">' + marker.getTitle() + '</div>';
                }
                infoWindow.open(marker.map, marker);
            }
            marker.selected = true;
            map = marker.map;
            marker.setIcon('https://dl.dropboxusercontent.com/u/18594175/wine-icon.png');

        }
    }

    for (var i in markers) {
        if (mapJS.isInfoWindowOpen(markers[i].infoWindow))
            selectedMarkers.push(markers[i]);
    }

    if (null !== map) {
        mapJS.fitMarkers(map, selectedMarkers);
    }
};




mapJS.fitMarkers = function(map, markers) {
    if (markers.length === 1) {
        map.setZoom(13);
        map.panTo(markers[0].getPosition());
    }
    else {
        var latlngList = new Array();
        var bounds = new google.maps.LatLngBounds();

        for (var i in markers) {
            latlngList.push(markers[i].getPosition());
        }
        var i;
        for (i in latlngList) {
            bounds.extend(latlngList[i]);
        }
        if (null !== map) {
            map.fitBounds(bounds);
            var newBounds = map.getBounds();
            bounds.extend(newBounds.getNorthEast());
            map.fitBounds(bounds);
        }
        
    }
};

mapJS.isInfoWindowOpen = function(infoWindow) {
    var map = infoWindow.getMap();
    return (map !== null && typeof map !== "undefined");
};