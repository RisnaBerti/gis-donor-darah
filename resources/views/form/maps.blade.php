<div id="map" style="height: 400px;"></div>

<script type="text/javascript">
    
    let map;
    let marker;

    function initMap() {
        const oldLat = parseFloat("{{ old('lat', $user->profile->lat ?? '') }}");
        const oldLong = parseFloat("{{ old('long', $user->profile->long ?? '') }}");

        const centerPosition = oldLat && oldLong ? { lat: oldLat, lng: oldLong } : { lat: -7.7065145, lng: 109.0115182 };

        map = new google.maps.Map(document.getElementById("map"), {
            center: centerPosition,
            zoom: 13,
        });

        // Membuat marker dengan opsi draggable dan juga event listener untuk klik
        marker = new google.maps.Marker({
            position: centerPosition,
            map: map,
            draggable: true,
        });

        // Event listener untuk memperbarui nilai input saat posisi marker berubah
        google.maps.event.addListener(marker, 'dragend', function() {
            const lat = marker.getPosition().lat();
            const lng = marker.getPosition().lng();

            document.getElementById('hidden-lat').value = lat;
            document.getElementById('hidden-long').value = lng;
        });

        // Event listener untuk menangani klik pada peta
        google.maps.event.addListener(map, 'click', function(event) {
            const clickedLocation = event.latLng;
            moveMarker(clickedLocation);
        });
    }

    // Fungsi untuk memindahkan marker ke lokasi yang baru
    function moveMarker(location) {
        marker.setPosition(location);
        map.panTo(location);

        const lat = location.lat();
        const lng = location.lng();

        document.getElementById('hidden-lat').value = lat;
        document.getElementById('hidden-long').value = lng;
    }

    google.maps.event.addDomListener(window, 'load', initMap);

</script>



<script type = "text/javascript" src = "https://maps.google.com/maps/api/js?key={{ env('GMAPS_API_KEY') }}&callback=initMap" > </script>