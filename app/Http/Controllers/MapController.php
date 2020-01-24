<?php

namespace App\Http\Controllers;

use GoogleMaps\Facade\GoogleMapsFacade as GoogleMaps;

class MapController extends Controller
{
    public function map()
    {
        // hier zorg ik dat als de map gegenereerd word alles goed staat
        $config = array();
        $config['center'] = 'auto';
        $config['onboundschanged'] = 'if (!centreGot) {
                var mapCentre = map.getCenter();
        }';
        $config['zoom'] = 12;
        $config['cluster'] = true;
        $config['places'] = true;

        // Zorgt voor de autocomplete in de map.blade.php in textbox myPlaceTextBox
        $config['placesAutocompleteInputID'] = 'myPlaceTextBox';
        $config['placesAutocompleteBoundsMap'] = TRUE;

        // runt een functie in javascript wanneer er in de myPlaceTextBox op enter word gedrukt
        $config['placesAutocompleteOnChange'] = '
            navigator.geolocation.getCurrentPosition(showPosition)
            
            function showPosition(position) {
                console.log(position.coords.latitude)
            }
        ';

        app('map')->initialize($config);

        // de markers
        $marker = array();
        $marker['position'] = '51.65, 4.85';
        $marker['infowindow_content'] = "<div class='content p-3'><h3>First marker</h3></div>";
        app('map')->add_marker($marker);

        $marker = array();
        $marker['position'] = '51.65, 4.90';
        $marker['infowindow_content'] = "<div class='content p-3'><h3>Second marker</h3></div>";
        app('map')->add_marker($marker);

        //hier wordt de map gegenereerd
        $map = app('map')->create_map();

        // redirect naar map.blade.php
        return view('map', ['map' => $map]);
    }
}
