<?php
/*
 *  Copyright 2014 Frederich.
 *  All rights reserved.
 *
 */
?>

<div class="content">
    <ul class="info-list list-group">
        <li class="host list-group-item">
            <span class="glyphicon glyphicon-user"></span>
            <span class="host"></span>
        </li>
        <li class="time list-group-item">
            <span class="glyphicon glyphicon-time"></span>
            <span class="time"></span>
            <span class='glyphicon glyphicon-calendar'> </span>
            <span class="date"></span>
        </li>
        <li class="location list-group-item">
            <div class="location-info">
                <span class="glyphicon glyphicon-map-marker"></span>
                <div class="place-wrapper">
                    <div class="place">
                        <span class="location"></span>
                        <span class="address"></span>
                    </div>
                </div>
                <div class="map-button"><span class="glyphicon"></span><span class="map-label"></span></div>
            </div>
        </li>
        <li class="map-item">
            <div class="map"></div>
        </li>
    </ul>
    <div class="description panel panel-default">
        <div class="panel-heading"> 
            <span class="glyphicon glyphicon-info-sign"></span> <span class="description-header">Information</span> 
            <span class="link"><a href="#"><span class="glyphicon glyphicon-new-window"></span><span> Facebook </span></a></span>
        </div>
        <div class="panel-body"></div>
    </div>
</div>
<div class="buttons">
    <button id="save_btn" type="button" class="btn btn-default btn-lg">
        <span class="glyphicon glyphicon-star"></span> Save
    </button>
    <button id="close_btn" type="button" class="btn btn-default btn-lg">
        <span class="glyphicon glyphicon-remove-circle"></span> Close
    </button>
</div>