<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>Marzipano</title>
    <link rel="stylesheet" href="">

    <script src="/js/marzipano.js"></script>
    <script src="https://unpkg.com/leaflet@1.9.2/dist/leaflet.js" integrity="sha256-o9N1jGDZrf5tS+Ft4gbIK7mYMipq9lqpVJ91xHSyKhg=" crossorigin=""></script>

    <link rel="stylesheet" href="https://unpkg.com/leaflet@1.9.2/dist/leaflet.css" integrity="sha256-sA+zWATbFveLLNqWO2gtiw3HL/lh1giY/Inf1BJ0z14=" crossorigin="" />
    <style>
        * {
            -webkit-box-sizing: border-box;
            -moz-box-sizing: border-box;
            box-sizing: border-box;
            -moz-user-select: none;
            -webkit-user-select: none;
            -ms-user-select: none;
            user-select: none;
            -webkit-user-drag: none;
            -webkit-touch-callout: none;
            -ms-content-zooming: none;
        }

        html, body {
            width: 100%;
            height: 100%;
            padding: 0;
            margin: 0;
            overflow: hidden;
        }

        #pano {
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
        }

        #map {
            position: absolute;
            top: 60%;
            left: 0;
            width: 35%;
            height: 40%;
            margin-left: 12px;
        }
    </style>
</head>
<body>
    <div id="pano"></div>
    <div id="map"></div>
    <div id="map2"></div>

    <script type="text/javascript">
        // Set up autorotate, if enabled.
        var autorotate = Marzipano.autorotate({
            yawSpeed: 0.03,
            targetPitch: 0,
            targetFov: Math.PI/2
        });

        // Create viewer.
        var viewer = new Marzipano.Viewer(document.getElementById('pano'));

        // Create source.
        // var source = Marzipano.ImageUrlSource.fromString(
        //   "/tiles/{f}.jpg"
        // );
        var source1 = Marzipano.ImageUrlSource.fromString(
          "/tiles/afuera-d1.jpg"
        );

        // Create EquirectGeometry.
        var geometry = new Marzipano.EquirectGeometry([{ width: 4000 }]);

        // Create CubeGeometry
        // var geometry = new Marzipano.CubeGeometry([{ tileSize: 1024, size: 1024 }]);

        // Create view.
        var limiter = Marzipano.RectilinearView.limit.traditional(4096, 100*Math.PI/180);
        var view = new Marzipano.RectilinearView(null, limiter);

        // Create scene.
        var scene = viewer.createScene({
          source: source1,
          geometry: geometry,
          view: view,
          pinFirstLevel: true
        });

        // Display scene.
        scene.switchTo();

        viewer.startMovement(autorotate);
        viewer.setIdleMovement(3000, autorotate);

        var map = L.map('map').setView([16.759088805822643, -93.17229628164813], 17);

        L.tileLayer('https://tile.openstreetmap.org/{z}/{x}/{y}.png', {
            maxZoom: 19,
            attribution: '&copy; <a href="http://www.openstreetmap.org/copyright">OpenStreetMap</a>'
        }).addTo(map);

        var marker = L.marker([16.759088805822643, -93.17229628164813]).addTo(map);
    </script>
</body>
</html>
