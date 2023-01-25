<html>

<head>
    <title>Webcam</title>
    <script type="text/javascript">
        function take_snapshot() {
            var hidden_canvas = document.querySelector('canvas'),
                context = hidden_canvas.getContext('2d');

            var video = document.querySelector('video');

            hidden_canvas.width = video.videoWidth;
            hidden_canvas.height = video.videoHeight;
            context.drawImage(video, 0, 0, video.videoWidth, video.videoHeight);

            var image = hidden_canvas.toDataURL('image/png');

            var form_data = new FormData();
            form_data.append('image', image);

            var xhr = new XMLHttpRequest();
            xhr.open('POST', 'save_snapshot.php', true);

            xhr.onload = function() {
                if (xhr.status === 200) {
                    alert(xhr.responseText);
                }
            };

            xhr.send(form_data);
        }
    </script>
</head>

<body>
    <video id="video" width="640" height="480" autoplay></video>
    <canvas id="canvas" style="display: none;"></canvas>
    <button onClick="take_snapshot()">Take Snapshot</button>

    <script type="text/javascript">
        // Put event listeners into place
        window.addEventListener("DOMContentLoaded", function() {
            // Grab elements, create settings, etc.
            var video = document.getElementById("video"),
                canvas = document.getElementById("canvas"),
                context = canvas.getContext("2d"),
                videoObj = {
                    "video": true
                },
                errBack = function(error) {
                    console.log("Video capture error: ", error.code);
                };

            // Put video listeners into place
            if (navigator.getUserMedia) { // Standard
                navigator.getUserMedia(videoObj, function(stream) {
                    video.srcObject = stream;
                    video.play();
                }, errBack);
            } else if (navigator.webkitGetUserMedia) { // WebKit-prefixed
                navigator.webkitGetUserMedia(videoObj, function(stream) {
                    video.src = window.webkitURL.createObjectURL(stream);
                    video.play();
                }, errBack);
            } else if (navigator.mozGetUserMedia) { // WebKit-prefixed
                navigator.mozGetUserMedia(videoObj, function(stream) {
                    video.src = window.URL.createObjectURL(stream);
                    video.play();
                }, errBack);
            }
        }, false);
    </script>

</body>

</html>
