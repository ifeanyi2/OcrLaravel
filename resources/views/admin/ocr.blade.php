@extends('admin.layouts.template')


@section('title', 'OCR Fetch Page')
@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-6">
            <div class="card shadow-lg border-0 rounded-lg mt-5">
                <div class="card-header">
                    <button id="start-camera" class="btn btn-block btn-primary"><i class="fas fa-camera"></i> Start Camera</button>
                    <hr class="dropdown-divider" />
                    <p class="font-weight-light my-4">Proceed With Image upload</p>
                </div>
                <div class="card-body">
                    <div class="mb-3 hideForCamera">
                        <label for="recognition-progress" id="label">File Recognition progress</label><br>
                        <progress id="recognition-progress" max="100" value="0">0%</progress>
                    </div>
                    <form action="{{ route("ocr.send") }}" method="post">
                        @csrf
                        <div class="form-floating mb-3">
                            <input class="input-group" id="recognition-image-input" type="file" capture="environment"/>

                        </div>

                        <div class="form-floating mb-3">
                            <textarea style="height: 60vh" class="form-control" id="captured-values" name="capture" /></textarea>
                            <label for="inputEmail">Captured value</label>
                        </div>
                        <div class="form-group">
                            <input type="button" id="btn" value="Send" class="btn btn-lg btn-block btn-primary" style="width:100%">
                        </div>



                    </form>
                </div>

            </div>

        </div>
         <div class="col-md-6 order-first">
            <div class="mt-5">
                <h4>Captured Image</h4>
                <dv id="recognition-images">
                    <div id="orginal-image"></div>
                </dv>
            </div>
            <div class="mt-3 text-center">
              <video width="320" class="d-none rounded mx-auto d-block bg-danger" height="240" autoplay id="video"></video>

                <canvas class="d-none rounded mx-auto d-block bg-info mt-2" id="canvas" width="320" height="240"></canvas>

                <button id="click-photo" class="d-none btn btn-block btn-info mt-3">
                    <i class="fas fa-video-camera"></i>
                     Capture
                </button>
            </div>
        </div>
    </div>

    <script src="{{ asset('js/app.js')  }}"></script>
    <script src="{{ asset("ocr/tesseract.min.js") }}"></script>
    <script src="{{ asset("ocr/worker.min.js") }}"></script>

    <script>

        /* this group of variables deals with image file system capture */
            const recognitionImageInputElement = document.querySelector("#recognition-image-input");
            const originalImageElement = document.querySelector("#orginal-image");
            const labeledImageElement = document.querySelector("#labeled-image");
            const recognitionProgress = document.querySelector('#recognition-progress');
            const label = document.querySelector('#label');
            const capturedValue = document.querySelector('#captured-values');

            //this two variable are just for hiding some display
            const cardHeader = document.querySelector('.card-header')
            const hideForCamera = document.querySelector('.hideForCamera')
        /* file system image capture variables ends here ... */


        /* this variables handles the use of camera **/
            const video = document.querySelector('#video');
            const canvas = document.querySelector('#canvas');
            const clickPhoto = document.querySelector('#click-photo');
            const startCamera = document.querySelector('#start-camera');
        /* camera variables ends .... */


        // video constraints
        const constraints = {
            video: {
                width: {
                    min: 128,
                    ideal: 1920,
                    max: 2560,
                },
                height: {
                    min: 720,
                    ideal: 1080,
                    max: 1440,
                },
                facingMode: "environment",
                audio: false
            }
        };

        // display the video camera and image capture option
         startCamera.addEventListener('click',  async function(){

            //display the camera face
           video.classList.remove('d-none');
           canvas.classList.remove('d-none');
           clickPhoto.classList.remove('d-none');

           /**
             hide card-header section in the form
             hide the start camera button
             hide the progress bar for file upload
           **/
           cardHeader.remove();
           hideForCamera.remove();

            //remove the input tag for image
            recognitionImageInputElement.remove();

           //start camera
           let stream = await navigator.mediaDevices.getUserMedia(constraints);
           video.srcObject = stream;

        })

        //capture image from the video and display on the canvas
        clickPhoto.addEventListener('click', function() {
            canvas.getContext('2d').drawImage(video, 0, 0, canvas.width, canvas.height);
            let image_data_url = canvas.toDataURL('image/jpeg');

            console.log(image_data_url);
        })

        // onchange activate the OCR library to fetch text from image
        recognitionImageInputElement.addEventListener('change', ()=>{

            if(!recognitionImageInputElement.files){
                return null;
            }

            const file = recognitionImageInputElement.files[0];

            return Tesseract.recognize(
                file,
                'eng',
                { logger: m => {

                    //log the progress of the test capture
                    console.log(m)

                    if(m.status === 'recognizing text'){

                        // tesseract will return a progress status
                        // multiple by 100 and set to int
                        // so we can display the capture progress
                        const p = parseInt((m.progress * 100));

                        //append the captured progress
                        label.textContent = `${status} ${p}%`;
                        recognitionProgress.value = p;

                        //if the process === to 100 append the word "Completed!"
                        if(p === 100){
                            label.innerHTML += " <span class='text-success'>complete ..</span>";


                            //create image tag and append it to the html
                            //to display the image we are capturing text from
                            const displayOriginalImage = document.createElement('img');

                            // add class attributes to the created img tag
                            displayOriginalImage.className = "rounded mx-auto d-block img-fluid";

                            // fetch and set the url of the image used for captured
                            displayOriginalImage.src = URL.createObjectURL(file)

                            // append it to the html tag to display the said image
                            originalImageElement.appendChild(displayOriginalImage);

                        }
                    }

                }
            }).then(({ data: { text } }) => {
                // remove special symbols from the captured text
                const chars = ["|", "_", "[", "/", "@", "]", "=", "%", "&"];
                let dText = String(text).trim("");

                for (let i = 0; i < chars.length; i++) {
                  dText = dText.replaceAll(chars[i], "");
                }

                //append the captured text to the textarea
                capturedValue.textContent = dText;

                //remove the input tag for image
                recognitionImageInputElement.remove();
            });

        });

        /*
        here we are trying to capture the value in rows
        and also access each individual value in a row
        */
        const btn = document.querySelector("#btn");
        const text = document.querySelector("#captured-values");
        let data = [];
        var dataRow = {};


        btn.addEventListener('click', (e)=>{
            e.preventDefault();
            const rows = text.value.trim().split("\n");

            for (let index = 0; index < rows.length; index++) {
                 const columns = rows[index].split(" ");
                  dataRow = {
                     STUDENT_ID:  (!String(columns[0]).trim())  ? 0 : columns[0],
                     ACC1:  (!String(columns[1]).trim())  ? 0 : columns[1],
                     ACC2:  (!String(columns[2]).trim())  ? 0 : columns[2],
                     ACC3:  (!String(columns[3]).trim())  ? 0 : columns[3],
                     ACC4:  (!String(columns[4]).trim())  ? 0 : columns[4],
                     ACC5:  (!String(columns[5]).trim())  ? 0 : columns[5],
                     ACC6:  (!String(columns[6]).trim())  ? 0 : columns[6],
                     ACC7:  (!String(columns[7]).trim())  ? 0 : columns[7],
                     ACC8:  (!String(columns[8]).trim())  ? 0 : columns[8],
                     EXAMS: !columns[9]  ? 0 : columns[9],
                     TOTAL: !columns[10]  ? 0 : columns[10],
                 }

                 //push the json data to the array

                data.push(dataRow);

            }


            // send the captured data to be saved
            // in session for further manipulation
            axios.post("/ocr/send", {
                data: {
                   data: data
                }
            }).then((resp) => {

                // redirect to the page with form
                // that will allow you edit the data before submit to database
                window.location.href = '/ocr/display';

            });



        });



    </script>



    @endsection
