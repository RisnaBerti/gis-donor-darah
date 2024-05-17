<div id="map" style="height: 600px;"></div>

<script type="text/javascript">

    let map, activeInfoWindow, markers = [];

           
            function initMap() {
                map = new google.maps.Map(document.getElementById("map"), {
                    center: {                        
                        lat: -7.6550637,
                        lng: 109.1148251,
                    },
                    zoom: 11
                });

                map.addListener("click", function(event) {
                    mapClicked(event);
                });

                initMarkers();
            }

            function initMarkers() {
                const initialMarkers = <?php echo json_encode($markPendonor); ?>;

                for (let index = 0; index < initialMarkers.length; index++) {

                    const markerData = initialMarkers[index];
                    const marker = new google.maps.Marker({
                        position: markerData.position,
                        label: markerData.label,
                        draggable: markerData.draggable,
                        icon:markerData.icon,
                        map
                    });
                    markers.push(marker);

                    const infowindow = new google.maps.InfoWindow({
                        content: `<b>${markerData.title}</b>`,
                    });
                    marker.addListener("click", (event) => {
                        if(activeInfoWindow) {
                            activeInfoWindow.close();
                        }
                        infowindow.open({
                            anchor: marker,
                            shouldFocus: false,
                            map
                        });
                        activeInfoWindow = infowindow;
                        markerClicked(marker, index);
                    });

                    marker.addListener("dragend", (event) => {
                        markerDragEnd(event, index);
                    });
                }
            }

          
        </script>


        <script type = "text/javascript" src = "https://maps.google.com/maps/api/js?key={{ env('GMAPS_API_KEY') }}&callback=initMap" > </script>