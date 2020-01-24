<?php
session_start();
use Spatie\Geocoder\Facades\Geocoder;
?>
@extends('layouts.default')
@section('content')
    <div class="container text-center">
        <div class="mb-4">
            <label for="myPlaceTextBox">Uw plaats: </label>
            <input type="text" name="myPlaceTextBox" id="myPlaceTextBox">
        </div>
{{--        genereerd de html van de map --}}
{{--        de js word gegenereed in de layouts.blade.php --}}
        <div class="container" id="mapper">
            <?=$map['html']?>
        </div>
        <div class="m-3">
            <button id="button" onclick="form_submit()">Click me</button>
        </div>
    </div>
    <script>
    </script>
@stop
