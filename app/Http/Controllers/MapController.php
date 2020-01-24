<?php

namespace App\Http\Controllers;

use GoogleMaps\Facade\GoogleMapsFacade as GoogleMaps;

class MapController extends Controller
{
    public function map()
    {
        $config = array();
        $config['center'] = 'auto';
        $config['onboundschanged'] = 'if (!centreGot) {
                var mapCentre = map.getCenter();
        }';
        $config['zoom'] = 12;
        $config['cluster'] = true;
        $config['places'] = true;
        $config['placesAutocompleteInputID'] = 'myPlaceTextBox';
        $config['placesAutocompleteBoundsMap'] = TRUE;
        $config['placesAutocompleteOnChange'] = '
            navigator.geolocation.getCurrentPosition(showPosition)
            
            function showPosition(position) {
                console.log(position.coords.latitude)
            }
        ';

        app('map')->initialize($config);

        // set up the marker ready for positioning
        // once we know the users location
        $marker = array();
        $marker['position'] = '51.65, 4.85';
        $marker['infowindow_content'] = "<div class='content p-3'><h3>First marker</h3></div>";
        app('map')->add_marker($marker);

        $marker = array();
        $marker['position'] = '51.65, 4.90';
        $marker['infowindow_content'] = "<div class='content p-3'><h3>Second marker</h3></div>";
        app('map')->add_marker($marker);

        $map = app('map')->create_map();

        return view('map', ['map' => $map]);
    }

    public function getLatLng() {

    }
}
