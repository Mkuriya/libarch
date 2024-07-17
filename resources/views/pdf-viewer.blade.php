<!DOCTYPE html>
<html>
<head>
    <title>PDF Viewer</title>
    <style>
        #pdf-viewer {
            width: 100%;
            height: 100vh;
        }
    </style>
</head>
<body>
    <div id="pdf-viewer"></div>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/pdf.js/2.6.347/pdf.min.js"></script>
    <script>
        var url = '/path/to/your/sample.pdf'; // URL to your PDF file

        var pdfjsLib = window['pdfjs-dist/build/pdf'];
        pdfjsLib.GlobalWorkerOptions.workerSrc = 'https://cdnjs.cloudflare.com/ajax/libs/pdf.js/2.6.347/pdf.worker.min.js';

        var loadingTask = pdfjsLib.getDocument(url);
        loadingTask.promise.then(function(pdf) {
            console.log('PDF loaded');

            var pageNumber = 1;
            pdf.getPage(pageNumber).then(function(page) {
                console.log('Page loaded');

                var scale = 1.5;
                var viewport = page.getViewport({scale: scale});

                var canvas = document.createElement('canvas');
                var context = canvas.getContext('2d');
                canvas.height = viewport.height;
                canvas.width = viewport.width;

                var renderContext = {
                    canvasContext: context,
                    viewport: viewport
                };
                page.render(renderContext).promise.then(function() {
                    console.log('Page rendered');
                    document.getElementById('pdf-viewer').appendChild(canvas);
                });
            });
        }, function(reason) {
            console.error(reason);
        });
    </script>
</body>
</html>
