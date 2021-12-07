<!DOCTYPE html>
<html>

<head>
    <title>GIS Rembang</title>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no" />
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">

    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="https://unpkg.com/leaflet@1.0.3/dist/leaflet.css" />
    <style>
        body {
            padding: 0;
            margin: 0;
        }

        #map,
        #container {
            height: 100%;
            width: 100vw;
            border: 1px solid black;
        }

        /* #map {
            height: 700px;
            border: 1px solid black;
        } */

        .info {
            padding: 6px 8px;
            font: 14px/16px Arial, Helvetica, sans-serif;
            background: white;
            background: rgba(255, 255, 255, 0.8);
            box-shadow: 0 0 15px rgba(0, 0, 0, 0.2);
            border-radius: 5px;
        }

        .info h4 {
            margin: 0 0 5px;
            color: #777;
        }

        .legend {
            line-height: 18px;
            color: #555;
        }

        .legend i {
            width: 18px;
            height: 18px;
            float: left;
            margin-right: 8px;
            opacity: 0.7;
        }
    </style>
    <script src="https://code.highcharts.com/highcharts.js"></script>
    <script src="https://unpkg.com/leaflet@1.0.3/dist/leaflet.js"></script>
    <script src="./lib/html2canvas.js"></script>
    <script src="./lib/leaflet_export.js"></script>
    <!-- Load Esri Leaflet from CDN -->
    <script src="https://unpkg.com/esri-leaflet@3.0.3/dist/esri-leaflet.js" integrity="sha512-kuYkbOFCV/SsxrpmaCRMEFmqU08n6vc+TfAVlIKjR1BPVgt75pmtU9nbQll+4M9PN2tmZSAgD1kGUCKL88CscA==" crossorigin=""></script>

    <!-- Load Esri Leaflet Vector from CDN -->
    <script src="https://unpkg.com/esri-leaflet-vector@3.1.0/dist/esri-leaflet-vector.js" integrity="sha512-AAcPGWoYOQ7VoaC13L/rv6GwvzEzyknHQlrtdJSGD6cSzuKXDYILZqUhugbJFZhM+bEXH2Ah7mA1OxPFElQmNQ==" crossorigin=""></script>
    <script src="jquery/jquery.min.js"></script>
    <script>
        function afterRender(result) {
            return result;
        }

        function afterExport(result) {
            return result;
        }

        function downloadMap(caption) {
            var downloadOptions = {
                container: newMap._container,
                caption: {
                    text: caption,
                    font: '30px Arial',
                    fillStyle: 'black',
                    position: [100, 200]
                },
                exclude: ['.leaflet-control-zoom', '.leaflet-control-attribution'],
                format: 'image/png',
                fileName: 'Map.png',
                afterRender: afterRender,
                afterExport: afterExport
            };
            var promise = newMap.downloadExport(downloadOptions);
            var data = promise.then(function(result) {
                return result;
            });
        }
        var littleton = L.marker([-6.70256, 111.42179]).bindPopup('This is Littleton, CO.').bindTooltip("my tooltip text").openTooltip(),
            denver = L.marker([-6.7312, 111.57492]).bindPopup('This is Denver, CO.').bindTooltip("my tooltip text").openTooltip(),
            aurora = L.marker([-6.8028, 111.45887]).bindPopup('This is Aurora, CO.').bindTooltip("my tooltip text").openTooltip(),
            golden = L.marker([-6.77893, 111.34558]).bindPopup('This is Golden, CO.').bindTooltip("my tooltip text").openTooltip();

        var cities = L.layerGroup([littleton, denver, aurora, golden]);
        var mbAttr = 'Map data &copy; <a href="https://www.openstreetmap.org/copyright">OpenStreetMap</a> contributors, ' +
            'Imagery © <a href="https://www.mapbox.com/">Mapbox</a>',
            mbUrl = 'https://api.mapbox.com/styles/v1/{id}/tiles/{z}/{x}/{y}?access_token=pk.eyJ1IjoibWFwYm94IiwiYSI6ImNpejY4NXVycTA2emYycXBndHRqcmZ3N3gifQ.rJcFIG214AriISLbB6B5aw';

        var grayscale = L.tileLayer(mbUrl, {
                id: 'mapbox/light-v9',
                tileSize: 512,
                zoomOffset: -1,
                attribution: mbAttr
            }),
            streets = L.tileLayer(mbUrl, {
                id: 'mapbox/streets-v11',
                tileSize: 512,
                zoomOffset: -1,
                attribution: mbAttr
            }),
            google = L.tileLayer('http://{s}.google.com/vt/lyrs=m&x={x}&y={y}&z={z}', {
                maxZoom: 20,
                subdomains: ['mt0', 'mt1', 'mt2', 'mt3']
            })

        function GoToOurLocation() {
            newMap.locate({
                setView: true,
                maxZoom: 15
            });
        }

        function GoToSearchLocation() {
            const myArray = $("#LokasiPencarian").val().split(",");
            var lokasi = [myArray[0], myArray[1]];

            newMap.setView(lokasi, 10);
        }
    </script>
    <script>
        var dataMarker = {
            bpsRembang: {
                icon: 'data/image/logobps-min.png',
                lokasi: [-6.7194195, 111.3443151],
                teks: 'Lokasi BPS Kabupaten Rembang'
            }
        }
    </script>
</head>

<body>


    <div id="judul" style="margin: auto;text-align: center;">
        <h1>Tematik Rembang</h1>
    </div>
    <div id="map" style="margin: auto;width: 1000px; height: 600px;">
        <div class="leaflet-bottom leaflet-left">
            <button class="buttonload">
                <i class="fa fa-spinner fa-spin"></i>Loading
            </button>
            <input type="button" id="exportWithCaptionBtn" value="CETAK" onclick="downloadMap('My leaflet map');" class="btnStyle span3 leaflet-control">
            <input type="button" id="Btn2" value="Ke Lokasi Saya Berada" onclick="GoToOurLocation()" class="btnStyle span3 leaflet-control" />
            <input type="text" id="LokasiPencarian" placeholder="Letakkan koordinat di sini" class="btnStyle span3 leaflet-control" />
            <input type="button" value="Cari Lokasi" onclick="GoToSearchLocation()" class="btnStyle span3 leaflet-control" />
            <span id="studentsCount" class="lblStyle span3 leaflet-control"> Ikke rutesat: </span>
        </div>
    </div>
    <div id="container" style="margin: auto;width: 1000px; height: 600px;"></div>
    <div id="footer" style="margin: auto;text-align: center;">
        <h3>BPS Rembang @2021</h3>
    </div>
    <script>
        var dataAjax
    </script>
    <script src="map/desa.js"></script>
    <script src="map/kecamatan.js"></script>
    <script src="map/kabupaten.js"></script>
    <script src="map/terminal_angkutan_penumpang.js"></script>

    <script>
        // console.log(Kecamatan.features)
        // console.log(Kecamatan)
        $.ajax({
            type: "POST",
            async: false,
            url: 'http://localhost:8990/backend/services/DataKecamatan',
            dataType: 'json',
            success: function(output) {
                // console.log(output.data)
                dataAjax = output.data
            }
        })
    </script>
    <script>
        var view = [-6.74003, 111.47556] //mengatur tititk tengah
        var newMap = L.map('map', {
            layers: [grayscale, cities],
            doubleClickZoom: true
        }).setView(view, 12); //mengatur zoom dengan nilai 9

        L.tileLayer('http://{s}.tile.osm.org/{z}/{x}/{y}.png', {
            attribution: '&copy; <a href=”http://osm.org/copyright”>OpenStreetMap</a> contributors'
        }).addTo(newMap);

        function onEachFeature(feature, layer) {
            var popupContent = "";
            if (feature.properties && feature.properties.kode_dagri) {
                popupContent += 'Kode : ' + feature.properties.kode_dagri + '<br> Kabupaten : ' + feature.properties.kabupaten + ' <br> Kecamatan : ' + feature.properties.kecamatan + '<br><button>Tombol</button><br>';
            }

            layer.bindPopup(popupContent);
        }

        function onEachFeatureDesa(feature, layer) {
            var popupContent = "";
            if (feature.properties && feature.properties.KODE_DAGRI) {
                popupContent += 'Kode Desa : ' + feature.properties.KODE_DAGRI + '<br> Kabupaten : ' + feature.properties.KABUPATEN + ' <br> Kecamatan : ' + feature.properties.KECAMATAN + '<br>Desa : ' + feature.properties.DESA + '<br><button>Tombol</button><br>';
            }

            layer.bindPopup(popupContent);
        }

        var myStyle = {
            "color": "#ff7800",
            "weight": 5,
            "opacity": 0.65
        };
        var LayerDesa = L.geoJson(Desa, {
            // onEachFeature: onEachFeatureDesa

            //,
        })
        LayerDesa.addTo(newMap);

        L.geoJson(Kabupaten, {
            style: function(feature) {
                switch (feature.properties.KODE) {
                    case 36:
                        return {
                            color: "#ff0000"
                        };
                    case 51:
                        return {
                            color: "#0000ff"
                        };
                }
            },
            onEachFeature: onEachFeature
            //,
        }).addTo(newMap);

        console.log(Kecamatan.features)
        let iter = 0
        Kecamatan.features.forEach(element => {
            element.properties.nilai = dataAjax[iter].SumDesaByKecamatan.r805a
            iter++
        });
        console.log(dataAjax)
        console.log(Kecamatan.features)

        function getColor(d) {
            return d > 20 ? '#800026' :
                d > 16 ? '#BD0026' :
                d > 12 ? '#E31A1C' :
                d > 8 ? '#FC4E2A' :
                d > 3 ? '#FD8D3C' :
                d > 2 ? '#FEB24C' :
                d > 0 ? '#FED976' :
                '#FFEDA0';
        }
        var info = L.control();

        function zoomToFeature(e) {
            newMap.fitBounds(e.target.getBounds());
            // alert('ada')
        }

        function highlightFeature(e) {
            var layer = e.target;

            layer.setStyle({
                weight: 5,
                color: '#666',
                dashArray: '',
                fillOpacity: 0.7
            });

            if (!L.Browser.ie && !L.Browser.opera && !L.Browser.edge) {
                layer.bringToFront();
            }
            info.update(layer.feature.properties);
        }

        function resetHighlight(e) {
            LayerKec.resetStyle(e.target);
            info.update();
        }

        function onEachFeatureKecamatan(feature, layer) {
            layer.on({
                mouseover: highlightFeature,
                mouseout: resetHighlight,
                click: zoomToFeature
            });
        }
        var LayerKec = L.geoJson(Kecamatan, {
            style: function(feature) {
                // switch (feature.properties.KODE_DAGRI.toString().substr(0, 6)) {
                //     case '331710':
                //         return {
                //             color: "#000000"
                //         };

                // }

                return {
                    fillColor: getColor(parseInt(feature.properties.nilai)),
                    weight: 2,
                    opacity: 1,
                    color: 'white',
                    dashArray: '3',
                    fillOpacity: 0.7
                };
            },
            onEachFeature: onEachFeatureKecamatan
            //,
        })

        info.onAdd = function(map) {
            this._div = L.DomUtil.create('div', 'info'); // create a div with a class "info"
            this.update();
            return this._div;
        };

        // method that we will use to update the control based on feature properties passed
        info.update = function(props) {
            this._div.innerHTML = '<h4>Keterangan Map Kecamatan' + (props ?
                props.KECAMATAN + '</h4><b>' + props.nilai + '</b><br />' + props.nilai + ' bangunan / mi<sup>2</sup>' :
                'Silahkan hover mouse ke kecamatan');
        };

        info.addTo(newMap);


        LayerKec.addTo(newMap);



        newMap.on("contextmenu", function(event) {
            console.log("Coordinates: " + event.latlng.toString());
            L.marker(event.latlng).addTo(newMap);


        });

        var greenIcon = L.icon({
            iconUrl: dataMarker.bpsRembang.icon,
            shadowUrl: '',

            iconSize: [38, 38], // size of the icon
            shadowSize: [50, 64], // size of the shadow
            iconAnchor: [0, 0], // point of the icon which will correspond to marker's location
            shadowAnchor: [4, 62], // the same for the shadow
            popupAnchor: [0, 0] // point from which the popup should open relative to the iconAnchor
        });
        L.marker(dataMarker.bpsRembang.lokasi, {
            icon: greenIcon
        }).addTo(newMap).bindPopup(dataMarker.bpsRembang.teks);


        var legend = L.control({
            position: 'bottomright'
        });
        legend.onAdd = function(map) {

            var div = L.DomUtil.create('div', 'info legend'),
                grades = [0, 10, 20, 50, 100, 200, 500, 1000],
                labels = [];

            // loop through our density intervals and generate a label with a colored square for each interval
            for (var i = 0; i < grades.length; i++) {
                div.innerHTML +=
                    '<i style="background:' + getColor(grades[i] + 1) + '"></i> ' +
                    grades[i] + (grades[i + 1] ? '&ndash;' + grades[i + 1] + '<br>' : '+');
            }

            return div;
        };
        legend.addTo(newMap);

        var baseLayers = {
            "Grayscale": grayscale,
            "Streets": streets,
            "Google": google,
        };

        var overlays = {
            "Pin": cities,
            "Batas Desa": LayerDesa,
            "Batas Kecamatan": LayerKec

        };

        L.control.layers(baseLayers, overlays).addTo(newMap);
    </script>


</body>

</html>