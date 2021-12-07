<link rel="stylesheet" href="https://unpkg.com/leaflet@1.7.1/dist/leaflet.css" integrity="sha512-xodZBNTC5n17Xt2atTPuE1HxjVMSvLVW9ocqUKLsCC5CXdbqCmblAshOMAS6/keqq/sMZMZ19scR4PsZChSR7A==" crossorigin="" />
<!-- Make sure you put this AFTER Leaflet's CSS -->
<script src="https://unpkg.com/leaflet@1.7.1/dist/leaflet.js" integrity="sha512-XQoYMqMTK8LvdxXYG3nZ448hOEQiglfqkJs1NOQV44cWnUrBc8PkAOcXy20w0vlaXaVUearIOBhiXZ5V3ynxwA==" crossorigin=""></script>
<script src="<?php echo base_url(); ?>lib/html2canvas.js"></script>
<script src="<?php echo base_url(); ?>lib/leaflet_export.js"></script>
<script src="https://unpkg.com/esri-leaflet@3.0.3/dist/esri-leaflet.js" integrity="sha512-kuYkbOFCV/SsxrpmaCRMEFmqU08n6vc+TfAVlIKjR1BPVgt75pmtU9nbQll+4M9PN2tmZSAgD1kGUCKL88CscA==" crossorigin=""></script>

<!-- Load Esri Leaflet Vector from CDN -->
<script src="https://unpkg.com/esri-leaflet-vector@3.1.0/dist/esri-leaflet-vector.js" integrity="sha512-AAcPGWoYOQ7VoaC13L/rv6GwvzEzyknHQlrtdJSGD6cSzuKXDYILZqUhugbJFZhM+bEXH2Ah7mA1OxPFElQmNQ==" crossorigin=""></script>

<script src="<?php echo base_url(); ?>lib/leaflet.browser.print.js"></script>
<script src="<?php echo base_url(); ?>lib/leaflet.browser.print.utils.js"></script>
<script src="<?php echo base_url(); ?>lib/leaflet.browser.print.sizes.js"></script>

<link rel="stylesheet" href="https://unpkg.com/leaflet-routing-machine@latest/dist/leaflet-routing-machine.css" />
<script src="https://unpkg.com/leaflet-routing-machine@latest/dist/leaflet-routing-machine.js"></script>
<link rel="stylesheet" href="<?php echo base_url(); ?>lib/Control.FullScreen.css" />
<script src="<?php echo base_url(); ?>lib/Control.FullScreen.js"></script>
<link rel="stylesheet" href="https://unpkg.com/@geoman-io/leaflet-geoman-free@latest/dist/leaflet-geoman.css"/>
<script src="https://unpkg.com/@geoman-io/leaflet-geoman-free@latest/dist/leaflet-geoman.min.js"></script>
<script>
    class gradeLegend {
        constructor(grade_) {
            this.grade = grade_
        }
        getColor(d) {
            return d > 20 ? '#800026' :
                d > 16 ? '#BD0026' :
                d > 12 ? '#E31A1C' :
                d > 8 ? '#FC4E2A' :
                d > 3 ? '#FD8D3C' :
                d > 2 ? '#FEB24C' :
                d > 0 ? '#FED976' :
                '#FFEDA0';
        }

    }
</script>
<style>
    #petaTematik,
    #container {
        height: 100%;
        width: 100vw;
        border: 1px solid black;
    }

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
<style>
    .inline {
        display: inline-block;
        /* border: 1px solid red; */
        margin: 2px;
    }
</style>
<style>
    .wrapper,
    #map,
    .form {
        height: 300px;
        width: 100%;
        padding: 0;
        margin: 0
    }

    .wrapper {
        position: relative
    }

    #map,
    .form {
        position: absolute;
        top: 0;
        left: 0
    }

    .form {
        z-index: 100000;
        padding: 50px 60px;
        pointer-events: none;
    }

    .form>* {
        pointer-events: auto;
    }
</style>
<script>
    var info = L.control();

    function zoomToFeature(e) {
        newMap.fitBounds(e.target.getBounds());

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


    function onEachFeatureKecamatan(feature, layer) {
        layer.on({
            mouseover: highlightFeature,
            mouseout: resetHighlight,
            click: zoomToFeature
        });
    }

    function onLocationError(e) {
        alert(e.message);
    }

    function onLocationFound(e) {
        var radius = e.accuracy;
        console.log(e)

        L.marker(e.latlng).addTo(newMap)
            .bindPopup("Anda di sekitar " + radius + " meter dari titik ini").openPopup();

        L.circle(e.latlng, radius).addTo(newMap);
    }


    function afterRender(result) {
        return result;
    }

    function afterExport(result) {
        return result;
    }
</script>
<div class="row">
    <form>


        <div class="form-group">

        </div>

    </form>
</div>
<div class="row">
    <div class="col-xl-12">
        <div class="card mb-4">
            <div class="card-header">
                <i class="fa fa-globe" aria-hidden="true"></i>
                <div class="inline">Tematik By Kecamatan</div> Variabel : <div class="inline" id="keteranganTematik">Ok</div>
            </div>
            <div class="card-body" id="petaTematik" style="margin: auto;width: 100%; height: 600px;">
            </div>

        </div>
    </div>

</div>

<script>
    var petaOverlay = L.tileLayer('http://{s}.google.com/vt/lyrs=m&x={x}&y={y}&z={z}', {
        maxZoom: 20,
        subdomains: ['mt0', 'mt1', 'mt2', 'mt3']
    })


    var newMap = L.map('petaTematik', {
        fullscreenControl: true,
        fullscreenControlOptions: {
            position: 'topleft'
        },
        doubleClickZoom: true,
        layers: [petaOverlay]
    }).setView([-6.74003, 111.47556], 12); //mengatur zoom dengan nilai 9



    // layerKec.addTo(newMap);
</script>

<script>
    var customActionToPrint = function(context, mode) {
        return function() {
            window.alert("We are printing the MAP. Let's do Custom print here!");
            context._printCustom(mode);
        }
    }
    L.control.browserPrint({
        // printLayer: petaOverlay,
        closePopupsOnPrint: false,
        printModes: [
            L.control.browserPrint.mode.landscape("Tabloid VIEW", "Tabloid"),
            L.control.browserPrint.mode("Alert", "User specified print action", "A6", customActionToPrint, false),
            L.control.browserPrint.mode.landscape(),
            "PORTrait",
            L.control.browserPrint.mode.auto("Auto", "B4"),
            L.control.browserPrint.mode.custom("Séléctionnez la zone", "B5")
        ]

    }).addTo(newMap);
</script>

<script>
    L.Routing.control({
        waypoints: [
            L.latLng(-6.8190717, 111.4163239),
            L.latLng(-6.773389679288546, 111.51108094398113)
        ]
    }).addTo(newMap);
</script>