var NHS_GMAP = null;
var Pager = {};
var focusCountry;

$(document).ready(function () {
    var cascadingFillsSetlist = new Array();
    Pager.orderByAttr = $('#orderByAttr').val();
    focusCountry = $('#focusCountry').val();
   

    // Set the number of element in the Pager
    var nbElementPerPage = parseInt($('#nbElementPerPage').val());

    if (isNaN(nbElementPerPage) || nbElementPerPage == "")
        nbElementPerPage = 10;

    //Load the Map at the Dom Loading
    initializeMap(focusCountry, nbElementPerPage);
    showMap();

    //Hide the Shop Map Show List Buttons
    $(".header.cf").hide();

    //Form Builder
    for (var i in NHSStoreLocatorSettings.formBuilder) {
        var f = NHSStoreLocatorSettings.formBuilder[i];

        var _html = '<div class="filter">';
        _html += '<label>' + f.label + '</label>';
        if (f.type == "list") {
            _html += '<select name="' + f.column + '">';
            _html += '<option value="" disabled="" selected="">' + f.placeholder + '</option>';
            _html += '</select>';


        } else if (f.type == "text") {
            if (typeof f.nbDigit !== 'undefined')
                _html += '<input name="' + f.column + '" type="text" id="digitControl" nbDigit=' + f.nbDigit + ' placeholder="' + f.placeholder + '" /><span id="nbDigitError" >' + f.nbDigitError + '</span>';
            else
                _html += '<input name="' + f.column + '" type="text" placeholder="' + f.placeholder + '" />';
        }
        _html += '</div>';

        $(".StoreLocator .filters_list").append(_html);

        if (f.loadedByDefault) {
            var jsondata = {
                "id": NHSWidgetID,
                "mode": "",
                "columns": [f.column],
                "filters": {}
            };
            var ccol = f.column;

            $.ajax({
                type: "POST",
                dataType: "json",
                cache: false,
                contentType: "application/json",
                url: "/servicestack_api/store-locator",
                data: JSON.stringify(jsondata),
                success: function (result) {
                    result.sort();
                    for (var elm in result) {
                        var _html = '<option value="' + result[elm] + '">' + result[elm] + '</option>';
                        $("select[name=" + ccol + "]").append(_html);
                    }
                    disableCascadingFills(cascadingFillsSetlist);
                },
                error: function (result) {
                    //console.log(result);
                }
            });
        }
        if (f.cascadingFill) {
            var fillCol = f.cascadingFill;
            $("select[name=" + f.column + "]").change(function () {
                var _val = $("select[name=" + ccol + "]").val();
                //console.log(fillCol, ccol, _val);
                var jsondata = {
                    "id": NHSWidgetID,
                    "mode": "",
                    "columns": [fillCol],
                    "filters": {}
                };
                jsondata.filters[ccol] = _val;
                //console.log(jsondata);
                $.ajax({
                    type: "POST",
                    dataType: "json",
                    cache: false,
                    contentType: "application/json",
                    url: "/servicestack_api/store-locator",
                    data: JSON.stringify(jsondata),
                    success: function (result) {
                        //console.log(result);
                        result.sort();
                        $("select[name=" + fillCol + "] option").not(':first').remove();
                        $("select[name=" + fillCol + "]")[0].selectedIndex = 0;
                        for (var elm in result) {
                            var _html = '<option value="' + result[elm] + '">' + result[elm] + '</option>';
                            $("select[name=" + fillCol + "]").append(_html);
                        }
                        //Active the cascading Select box
                        $("select[name=" + fillCol + "]").removeAttr("disabled");
                    },
                    error: function (result) {
                        //console.log(result);
                    }
                });
            });
        }

        if (f.type == "text") {
            $("input[name=" + f.column + "]").keyup(function (event) {
                if (event.which == 13) {
                    SL_Search();
                    event.preventDefault();
                }
            });
        }
    }

    //Initialize Events

    $(document).on("click", ".StoreLocator #storeLocatorShowMap", function () {
        $(".StoreLocator .results").removeClass("pagingControlsUp");
        $(".StoreLocator .results").removeClass("pagingControlsDown");
        $(".StoreLocator .results").removeClass("mobilePagingControls");
        $(".StoreLocator .results").removeClass("list");
        $(".StoreLocator .results").addClass("map");
        google.maps.event.trigger(map, 'resize');
        return false;
    });
    $(document).on("click", ".StoreLocator #storeLocatorShowList", function () {

        $(".StoreLocator .results").removeClass("map");
        $(".StoreLocator .results").addClass("list");
        $(".StoreLocator .results").addClass("pagingControlsUp");
        $(".StoreLocator .results").addClass("pagingControlsDown");
        $(".StoreLocator .results").addClass("mobilePagingControls");
        fixHeightListResult();
        return false;
    });

    $(document).on("click", ".StoreLocator #storeLocatorClear", function () {

        $(".header.cf").hide();
        manageError();
        $(".result_label").html("");
        disableCascadingFills(cascadingFillsSetlist);
        $(".StoreLocator .results").removeClass("pagingControlsUp");
        $(".StoreLocator .results").removeClass("pagingControlsDown");
        $(".StoreLocator .results").removeClass("mobilePagingControls");
        $(".StoreLocator .results").removeClass("list");
        $(".StoreLocator .results").addClass("map");

        google.maps.event.trigger(map, 'resize');

        for (var i in NHSStoreLocatorSettings.formBuilder) {
            var f = NHSStoreLocatorSettings.formBuilder[i];
            if (f.type == "list") {
                $("select[name=" + f.column + "]").prop('selectedIndex', 0);
                if (!f.loadedByDefault) {
                    $("select[name=" + f.column + "] option").not(':first').remove();
                }

            } else if (f.type == "text") {
                $("input[name=" + f.column + "]").val("");
            }
        }
        centerMapOnCountry(focusCountry);
        return false;
    });

    $(document).on("click", ".StoreLocator #storeLocatorSearch", function () {
        // Correct the placeholder problem on IE9
        if ((navigator.appName.indexOf("Internet Explorer") != -1 && navigator.appVersion.indexOf("MSIE 9") != -1)) {
            for (var i in NHSStoreLocatorSettings.formBuilder) {
                var f = NHSStoreLocatorSettings.formBuilder[i];
                if (f.type == "text" && f.placeholder == $("input[name=" + f.column + "]").val()) {
                    $("input[name=" + f.column + "]").val("");
                }
            }
        }
        SL_Search();
        return false;
    });
});

function SL_Search() {
    //Mode To Be Change to near for Nearest points mode
    var jsondata = {
        "id": NHSWidgetID,
        "mode": "search",
        "columns": [],
        "filters": {}
    };
    jsondata.columns = NHSStoreLocatorSettings.display.columns;
    for (var i in NHSStoreLocatorSettings.formBuilder) {
        var f = NHSStoreLocatorSettings.formBuilder[i];
        var _val = "";
        if (f.type == "list") {
            _val = $("select[name=" + f.column + "]").val();
        } else if (f.type == "text") {
            _val = $("input[name=" + f.column + "]").val();
        }

        if (_val) {
            jsondata.filters[f.column] = _val;
        }
    }

    $(".StoreLocator .filters .select_filter").css("visibility", "hidden");
    $("#nbDigitError").css('visibility', 'hidden');
    var _filled = false;
    var _digitChecked = true;

    for (var e in jsondata.filters) {
        _filled = true;
        if ($("#digitControl").length > 0 && $("#digitControl").val().length > 0 && $("#digitControl").val().length != parseInt($("#digitControl").attr("nbDigit"))) {
            manageError('nbDigit');
            _digitChecked = false;
        } else {
            _filled = true;
        }
    }
    if (!_filled) {
        manageError('notFilled');
    }
    //console.log(_ok, "jsondata", jsondata);

    if (_filled && _digitChecked) {
        $.ajax({
            type: "POST",
            dataType: "json",
            cache: false,
            contentType: "application/json",
            url: "/servicestack_api/store-locator",
            data: JSON.stringify(jsondata),
            success: function (result) {

                
                showMap();

                NHS_GMAP = {};
                NHS_GMAP.data = {};
                NHS_GMAP.bounds = new google.maps.LatLngBounds();
                NHS_GMAP.lastinfowin = null;
                //deleteMarkers();

                $(".resultList").empty();
                if (result.length > 0) {
                    //if an orderBy is specified in the settings
                    if (Pager.orderByAttr) {
                        // Sort the result order by given orderByAttr
                        result.sort(dynamicSort(Pager.orderByAttr));
                    }

                    for (var i in result) {
                        var marker = result[i];

                        marker["lat"] = parseFloat(marker["lat"]);
                        marker["lng"] = parseFloat(marker["lng"]);

                        addMarker(marker);
                        addListResult(i, marker);


                        NHS_GMAP.data[i] = marker;
                    }
                    google.maps.event.addListenerOnce(map, 'bounds_changed', function (event) {
                        if (this.getZoom() > 12) {
                            this.setZoom(12);
                        }
                    });
                    map.fitBounds(NHS_GMAP.bounds);

                   
                    $(".result_label").html(result.length + " " + SL_Results);
                    //Set Focus on Map
                    jump("storeLocatorResults");
                    
                    //Pager Creation
                    Pager.pager = new NestlePager.Pager();
                    Pager.pager.paragraphsPerPage = Pager.nbElementPerPage; // set amount elements per page
                    Pager.pager.paragraphs = $('.result', this.pagingContainer); // set of required containers
                    Pager.pager.showPage(1);

                    //Show the Shop Map Show List Buttons
                    $(".header.cf").show();
                } else {
                    manageError('noResult');
                    centerMapOnCountry(focusCountry);
                    $(".header.cf").hide();
                }
            },
            error: function (result) {
            }
        });
       
    }
}

var map;
var geocoder;
function initializeMap(country, nbElementPerPage) {
    Pager.nbElementPerPage = nbElementPerPage;
    geocoder = new google.maps.Geocoder();
    centerMapOnCountry(country);
}


function centerMapOnCountry(country) {
    //If country string is null, then set it to Switzerland
    var country = country || "Switzerland";

    //Initialize map on a given defaultStatus position
    var latlng = new google.maps.LatLng(46.2157467, 2.2088258);
    var mapOptions = {
        zoom: 6,
        center: latlng
    }
    map = new google.maps.Map(document.getElementById('map-canvas'), mapOptions);

    //Center Map on the given Country
    geocoder.geocode({ 'address': country }, function (results, status) {
        if (status == google.maps.GeocoderStatus.OK) {
            //map.setCenter(results[0].geometry.location);
            map.setCenter(results[0].geometry.location);
            map.fitBounds(results[0].geometry.viewport);
        }
    });
}


function codeAddress(address) {

    geocoder.geocode({ 'address': address }, function (results, status) {
        if (status == google.maps.GeocoderStatus.OK) {
            map.setCenter(results[0].geometry.location);
            //var marker = new google.maps.Marker({
            //    map: map,
            //    position: results[0].geometry.location
            //});
            //map.setZoom(15);
        } else {
            alert('Geocode was not successful for the following reason: ' + status);
        }
    });
}

function addListResult(ind, marker) {

    var contentString = '';
    contentString += '<div class="result">';
    contentString += '<div class="inner-result marker_content">';


    for (i in NHSStoreLocatorSettings.display.list) {
        var col = NHSStoreLocatorSettings.display.list[i];
        var _style = "";
        if (col.hasOwnProperty("style")) {
            _style = " style=" + col.style;
        }
        if (col.hasOwnProperty("type")) {
            if (col.type == "telephon") {
                contentString += '<a href="tel:' + marker[col.column] + '"' + _style + '>' + marker[col.column] + '</a>';
            } else if (col.type == "mail") {
                contentString += '<a href="mailto:' + marker[col.column] + '"' + _style + '>' + marker[col.column] + '</a>';
            } else if (col.type == "url") {
                contentString += '<a href="' + marker[col.column] + '"' + _style + '>' + marker[col.column] + '</a>';
            } else if (col.type == "custom") {
                contentString += '<span' + _style + '>' + col.column + '</span>';
            }
        } else {
            contentString += '<span' + _style + '>' + marker[col.column] + '</span>';
        }
    }

    contentString += '<a href="#" onclick="NHS_Map_ClickViewOnMap(' + ind + ');return false;">' + SL_ViewOnMap + '</a>';

    contentString += '</div>';
    contentString += '</div>';

    $(".resultList").append(contentString);
}

function addMarker(marker) {

    var newMarker = new google.maps.Marker({
        position: { lat: marker.lat, lng: marker.lng },
        map: map,
        icon: NHSStoreLocatorPlotPath,
        title: '-'
    });
    NHS_GMAP.bounds.extend(newMarker.position);
    var contentString = '<div class="marker_content">';
    for (var i in NHSStoreLocatorSettings.display.map) {
        var col = NHSStoreLocatorSettings.display.map[i];
        var _style = "";
        if (col.hasOwnProperty("style")) {
            _style = " style=" + col.style;
        }
        if (col.hasOwnProperty("type")) {
            if (col.type == "telephon") {
                contentString += '<a href="tel:' + marker[col.column] + '"' + _style + '>' + marker[col.column] + '</a>';
            } else if (col.type == "mail") {
                contentString += '<a href="mailto:' + marker[col.column] + '"' + _style + '>' + marker[col.column] + '</a>';
            } else if (col.type == "url") {
                contentString += '<a href="' + marker[col.column] + '"' + _style + '>' + marker[col.column] + '</a>';
            } else if (col.type == "custom") {
                contentString += '<span' + _style + '>' + col.column + '</span>';
            }
        } else {
            contentString += '<span' + _style + '>' + marker[col.column] + '</span>';
        }
    }

    contentString += '</div>';




    var infowindow = new google.maps.InfoWindow({
        content: contentString
    });

    newMarker.addListener('click', function () {
        if (NHS_GMAP.lastinfowin) {
            NHS_GMAP.lastinfowin.close();
        }
        NHS_GMAP.lastinfowin = infowindow;
        infowindow.open(map, newMarker);

    });

    newMarker.addListener('closeclick', function () {
        NHS_GMAP.lastinfowin = null;

    });

    marker.newMarker = newMarker;
    marker.infowindow = infowindow;
}

function jump(h) {
    if (!$('html').is('.lt-ie7, .lt-ie8, .lt-ie9')) {
        var url = location.href; //Save down the URL without hash.
        location.href = "#" + h; //Go to the target element.
        // avoid usage of  history.replaceState in IE9 which does not supports it
        if (!(navigator.appName.indexOf("Internet Explorer") != -1 && navigator.appVersion.indexOf("MSIE 9") != -1))
            history.replaceState(null, null, url); //Don't like hashes. Changing it back.
    }
}

function NHS_Map_ClickViewOnMap(ind) {
    if (NHS_GMAP.lastinfowin) {
        NHS_GMAP.lastinfowin.close();
    }
    $(".StoreLocator .results").removeClass("pagingControlsUp");
    $(".StoreLocator .results").removeClass("pagingControlsDown");
    $(".StoreLocator .results").removeClass("mobilePagingControls");
    $(".StoreLocator .results").removeClass("list");
    $(".StoreLocator .results").addClass("map");
    //Center focus on map div
    jump("storeLocatorResults");
    google.maps.event.trigger(map, 'resize');


    map.setZoom(14);
    var marker = NHS_GMAP.data[ind];
    var position = { lat: marker.lat, lng: marker.lng }
    map.setCenter(position);

    marker.infowindow.open(map, marker.newMarker);

    NHS_GMAP.lastinfowin = marker.infowindow;

    return false;
}

function fixHeightListResult() {
    var max = 0;
    $(".resultList .result").each(function (index) {
        if ($(this).height() > max) { max = $(this).height(); }
    });
    $(".resultList .result").each(function (index) {
        $(this).height(max);
    });
}

// Sets the map on all markers in the array.
function setMapOnAll(map) {
    for (var i = 0; i < markers.length; i++) {
        markers[i].setMap(map);
    }
}

// Removes the markers from the map, but keeps them in the array.
function clearMarkers() {
    setMapOnAll(null);
}

// Shows any markers currently in the array.
function showMarkers() {
    setMapOnAll(map);
}

// Deletes all markers in the array by removing references to them.
function deleteMarkers() {
    clearMarkers();
    markers = [];
}

// Display the Map
function showMap() {
    //Remove the list of items and display the map div
    $(".StoreLocator .results").removeClass("list");
    $(".StoreLocator .results").addClass("map");
    $(".StoreLocator .results").show();
    google.maps.event.trigger(map, 'resize');
    return false;
}



// Pager JS Nestle
var NestlePager = {};
NestlePager.Pager = function () {
    this.currentPage = 1;
    this.pagingControlsContainerUp = '#pagingControlsUp';
    this.pagingControlsContainerDown = '#pagingControlsDown';
    this.mobilePagingControlsContainer = '#mobilePagingControls';
    this.pagingContainerPath = '.resultList';



    this.numPages = function () {
        var numPages = 0;
        if (this.paragraphs != null && this.paragraphsPerPage != null) {
            numPages = Math.ceil(this.paragraphs.length / this.paragraphsPerPage);
        }
        return numPages;
    };

    this.showPage = function (page) {
        this.currentPage = page;
        var html = '';

        var pageContent = this.paragraphs.slice((page - 1) * this.paragraphsPerPage,
        ((page - 1) * this.paragraphsPerPage) + this.paragraphsPerPage);

        $(this.pagingContainerPath).empty();
        for (i = 0; i < pageContent.length; i++) {
            //html += '<div class="result">' + pageContent[i].innerHTML + '</div>';
            $(this.pagingContainerPath).append(pageContent[i]);
        }
       
        //$(this.pagingContainerPath).html(html);
        renderControls(this.pagingControlsContainerUp, this.pagingControlsContainerDown, this.mobilePagingControlsContainer, this.currentPage, this.numPages());
    }

    this.showMore = function (page) {
        this.currentPage = page;
        var html = '';
        this.paragraphs.slice((page - 1) * this.paragraphsPerPage,
            ((page - 1) * this.paragraphsPerPage) + this.paragraphsPerPage).each(function () {
                html += '<div class="result">' + $(this).html() + '</div>';
            });

        $(this.pagingContainerPath).append(html);

        renderControls(this.pagingControlsContainerUp, this.pagingControlsContainerDown, this.mobilePagingControlsContainer, this.currentPage, this.numPages());
    }

    var renderControls = function (containerUp, containerDown, mobileContainer, currentPage, numPages) {
        //Pager Mobile
        if (window.screen.availWidth < 480 && window.screen.availWidth > 320) {
            var pagingControls = '<a href="#" onclick="Pager.pager.showMore(' + eval(currentPage + 1) + ');return false;" >View More</a>';
            $(mobileContainer).html(pagingControls);
        }
            //Pager Normale
        else {
            var pagingControls = currentPage + ' ' + SL_Of + ' ' + numPages;
            if (currentPage < numPages)
                pagingControls += '<a href="#" onclick="Pager.pager.showPage(' + eval(currentPage + 1) + '); return false;"> ' + SL_Next + ' </a>';
            if (currentPage > 1)
                pagingControls = '<a href="#" onclick="Pager.pager.showPage(' + eval(currentPage - 1) + '); return false;"> ' + SL_Previous + ' </a>' + pagingControls;
            $(containerUp).html(pagingControls);
            $(containerDown).html(pagingControls);
        }
    }
}



// Find and Disable all the cascading select boxes
function disableCascadingFills(cascadingFillsSetlist) {

    //Construct the list of cascading selectBoxes
    for (i in NHSStoreLocatorSettings.formBuilder) {
        var formBuilderElement = NHSStoreLocatorSettings.formBuilder[i];
        if (typeof (formBuilderElement.cascadingFill) !== 'undefined') {
            cascadingFillsSetlist.push(formBuilderElement);
        }
    }

    // Disable all the cascading select boxes
    for (i in cascadingFillsSetlist) {
        var cascadingFillElement = cascadingFillsSetlist[i];
        var dependantSelect = $('select[name="' + cascadingFillElement.cascadingFill + '"]');
        dependantSelect.attr('disabled', 'disabled');
    }
}

// Sort a Table
function dynamicSort(property) {
    var sortOrder = 1;
    if (property[0] === "-") {
        sortOrder = -1;
        property = property.substr(1);
    }
    return function (a, b) {
        var result = (a[property] < b[property]) ? -1 : (a[property] > b[property]) ? 1 : 0;
        return result * sortOrder;
    }
}

// Manage Errors
function manageError(errortype) {
    switch (errortype) {
        case 'noResult':
            $(".select_filter").html(SL_NoResult);
            $(".select_filter").css('visibility', 'visible');
            $(".result_label").html("");
            break;
        case 'notFilled':
            $(".select_filter").html(SL_SelectOnFilter);
            $(".select_filter").css('visibility', 'visible');
            break;
        case 'nbDigit':
            //console.log("Error detected");
            $("#nbDigitError").css('visibility', 'visible');
            break;
        default:
            $(".select_filter").html("");
            $("#nbDigitError").css('visibility', 'hidden');
            break;
    }
}
