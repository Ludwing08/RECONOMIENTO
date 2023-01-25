<html lang="en">

<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Opencv JS</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65" crossorigin="anonymous">
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-kenU1KFdBIe4zVF0s0G1M5b4hcpxyD9F7jL+jjXkk+Q2h455rYXK/7HAuoJl+0I4" crossorigin="anonymous"></script>

  <script async src="js/opencv.js" onload="openCvReady();"></script>
  <script src="js/utils.js"></script>
  <script src="js/jquery.js"> </script>

</head>


<?php

include('../Servicios/conexion.php');

$Cedula = $_REQUEST['Cedula'];
// $Cedula = '1804567891';
$query = "SELECT * FROM empleado WHERE CED_EMP = '$Cedula'";
$result = $conn->query($query);

if ($result->num_rows > 0) {
  $empleado = $result->fetch_assoc();
  $nombre = $empleado['NOM_EMP'];
  $apellido = $empleado['APE_EMP'];
  $cedula = $empleado['CED_EMP'];
  echo "<input class='form-control' type='hidden' value='$cedula' name='Cedula' id='Cedula'>";
  echo "<input class='form-control m-auto' type='text' value='$nombre $apellido' style='width: 35%; text-align: center; ' disabled>";
}
?>

<body style="background-color: #222">

  <script type="text/javascript">
    function take_snapshot() {
      var hidden_canvas = document.querySelector('canvas'),
        context = hidden_canvas.getContext('2d');
      var casco = document.getElementById('casco');
      var cedula = document.getElementById('Cedula');


      var video = document.querySelector('video');

      hidden_canvas.width = video.videoWidth;
      hidden_canvas.height = video.videoHeight;
      context.drawImage(video, 0, 0, video.videoWidth, video.videoHeight);

      var image = hidden_canvas.toDataURL('image/png');

      var form_data = new FormData();
      form_data.append('image', image);
      form_data.append('casco', casco.value);
      form_data.append('Cedula', cedula.value);

      var xhr = new XMLHttpRequest();
      xhr.open('POST', '../foto.php', true);

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


    <table style="margin: auto; margin-top:10px;">
      <tr>
        <th>
          <h1>
            Original
          </h1>
        </th>
        <th>
          <h1>
            Detección
          </h1>
        </th>
      </tr>
      <tr>
        <td style="
              border: solid 10px;
              border-color: #444;
              border-radius: 10px;  
            ">
          <video id="cam_input" name="cam_input" height="360" width="480"></video>
        </td>
        <td style="border: solid 10px; border-color: #444;border-radius: 10px;">
          <canvas id="canvas_output"></canvas>
          <div id="texto"></div>
        </td>
      </tr>
    </table>

    <!-- <input type="button" value="Tomar foto" name="capturar" id="capturar"> -->



    <div class="container overflow-hidden text-center mt-3">
      <div class="row">
        <div class="col-6">

          <div class="card panel-control" style="width: 90%; margin-left:53%;">

            <div class="row">
              <div class="col-1"><label for="">Escala: </label></div>
              <div class="col-10">

                <input id="s1" type="range" class="form-range p-2" min="5" max="10" step="1" oninput="showVal(this.value)" onchange="showVal(this.value)">
              </div>
              <div class="col-1">
                <p id="result"> 0 </p>

              </div>
            </div>
            <div class="row">
              <div class="col-1"><label for="">Vecinos: </label></div>
              <div class="col-10">
                <input id="s2" type="range" class="form-range p-2" min="5" max="10" step="1" oninput="showVal2(this.value)" onchange="showVal2(this.value)">
              </div>

              <div class="col-1">
                <p id="res2">0</p>
              </div>
            </div>

            <div class="row">
              <div class="col-1"><label for="">Tamaño: </label></div>
              <div class="col-10">
                <input id="s3" type="range" class="form-range p-2" min="5" max="10" step="1" oninput="showVal3(this.value)" onchange="showVal3(this.value)">

              </div>
              <div class="col-1">
                <p id="res3">0</p>
              </div>

              <div class="card-footer text-muted" style="text-align: center;">
                CENTRO DE CONFIGURACIÓN
              </div>
            </div>


          </div>
        </div>
        <div class="col-6">
          <button onClick="take_snapshot()" class="btn btn-danger" style="width: 20%; height: 30%; margin-top:17%;margin-left:35%;">Capturar foto</button>
        </div>
      </div>


    </div>

    <input type="hidden" name="casco" id="casco" value="0">


    <style>
      .panel-control {
        background-color: whitesmoke;
        width: 100%;
        margin-left: auto;
        margin-right: 10%;
        margin-bottom: 2%;
      }

      .form-range {
        width: 100%;
      }
    </style>


    <!-- aqui -->

  </body>


  <script type="text/javascript">
    // Put event listeners into place
    window.addEventListener("DOMContentLoaded", function() {
      // Grab elements, create settings, etc.
      var video = document.getElementById("cam_input"),
        canvas = document.getElementById("canvas_output"),
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

  <script>
    function showVal(newVal) {
      document.getElementById("result").innerHTML = newVal;
    }

    function showVal2(newVal) {
      document.getElementById("res2").innerHTML = newVal;
    }

    function showVal3(newVal) {
      document.getElementById("res3").innerHTML = newVal;
    }
  </script>


  <script type="text/JavaScript">
    function openCvReady() {
      cv['onRuntimeInitialized']=()=>{
        let video = document.getElementById("cam_input"); // video is the id of video tag
        navigator.mediaDevices.getUserMedia({ video: true, audio: false })
        .then(function(stream) {
            video.srcObject = stream;
            video.play();
        })
        .catch(function(err) {
            console.log("An error occurred! " + err);
        });
        let src = new cv.Mat(video.height, video.width, cv.CV_8UC4);
        let dst = new cv.Mat(video.height, video.width, cv.CV_8UC1);
        let gray = new cv.Mat();
        let cap = new cv.VideoCapture(cam_input);
        let faces = new cv.RectVector();
        let scaleFactor = 1;
        let minNeighbors = 1;
        let minSize = new cv.Size(38, 38);
        let maxSize = new cv.Size(64, 64);
        let classifier = new cv.CascadeClassifier();
        let utils = new Utils('errorMessage');
        let faceCascadeFile = 'cascade_funcional.xml'; // path to xml
        utils.createFileFromUrl(faceCascadeFile, faceCascadeFile, () => {
        classifier.load(faceCascadeFile); // in the callback, load the cascade from file
    });
        const FPS = 24;
        let estado = false;        

        function processVideo() {
            let begin = Date.now();
            let texto = document.getElementById("texto"); // video is the id of video tag
            let casco = document.getElementById("casco");
            let s1 = document.getElementById("s1");
            let s2 = document.getElementById("s2");
            let s3 = document.getElementById("s3");
            
            cap.read(src);
            src.copyTo(dst);
            cv.cvtColor(dst, gray, cv.COLOR_RGBA2GRAY, 0);
            try{
                // classifier.detectMultiScale(gray, faces, scaleFactor, minNeighbors, 0, minSize, maxSize);
                // classifier.detectMultiScale(gray, faces, Number(s1.value), 20, 0);
                classifier.detectMultiScale(gray, faces, Number(s1.value), Number(s2.value), Number(s3.value));
                // console.log(s3.value);
                console.log(faces.size());
            }catch(err){
                console.log(err);
            }
            
            for (let i = 0; i < faces.size(); ++i) {
                let face = faces.get(i);
                let point1 = new cv.Point(face.x, face.y);
                let point2 = new cv.Point(face.x + face.width, face.y + face.height);
                cv.rectangle(dst, point1, point2, [255, 0, 0, 255]);                
                // console.log("casco")
                // cv.putText(dst, 'Casco', (200, 200), 2,0.7, (0, 255,0),2,cv.LINE_AA);            
                // cv.putText(dst,"Good Morning",(200, 200),cv.FONT_HERSHEY_DUPLEX,3.0,(125, 246, 55),3);
                cv.putText(dst, 'Casco', (point1, point2), cv.FONT_HERSHEY_SIMPLEX, 1.5, [209, 80, 0, 255], 2);
                casco.value = 1;                

            }
                       
            cv.imshow("canvas_output", dst);
            // schedule next one.
            let delay = 1000/FPS - (Date.now() - begin);
            setTimeout(processVideo, delay);
    }
    
    // schedule first one.
    setTimeout(processVideo, 0);
      };
    }
  </script>
  <style>
    h1 {
      color: white;
    }
  </style>

</html>