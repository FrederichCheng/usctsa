<script src="https://maps.googleapis.com/maps/api/js?v=3.exp&sensor=false"></script>
<div class="housing-map" style="height:500px;"></div>
<script type="text/javascript">
    (function(){
        var canva = $('.housing-map').get(0);
        var url = 'https://mapsengine.google.com/map/u/0/kml?mid=zYjzcxdR19fg.kvE0EHfKh8tc&cid=mp&cv=yCsoPjplrX0.zh_TW';
        var usc = new google.maps.LatLng(34.02541587908883,-118.27750042546387);

        var mapOptions = {
            center: usc
        };

        var map = new google.maps.Map(canva, mapOptions);
        var ctaLayer = new google.maps.KmlLayer({
            url: url
        });
        ctaLayer.setMap(map);
    })();
</script>
