@include('partials.adminnav')
<div class="h-[calc(100vh-5.5rem)]"> <!-- Adjusted height to account for the adminnav -->
    <div class="w-full flex bg-whitebg justify-between items-center text-center">
        <p class=" w-full text-white px-8 py-2">Research Title: {{$file->title}}</p>
        <a href="/admin/dashboard/archive">
            <button class=" text-white px-4 py-2"> 
                <svg width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" class="bg-gray-400 rounded-full text-black">
                    <path d="M18 6L6 18" />
                    <path d="M6 6L18 18" />
                </svg>
            </button>
        </a>
    </div>
    
    <div class="h-full bg-transparent flex flex-col justify-between items-center sm:px-2 relative">
        <div class="sm:w-1/2 w-full flex-1 overflow-y-auto relative">
            <div id="pdf-container" class="w-full h-full bg-transparent "></div>
        </div>
        <!-- Citation at the bottom of the iframe, fitting within the screen -->
        <p class="bg-whitebg sm:w-1/2 w-full text-white py-1 px-1 text-center">Citation: {{$file->citation}}</p>
    </div>
</div>

<script src="https://cdnjs.cloudflare.com/ajax/libs/pdf.js/2.12.313/pdf.min.js"></script>
<script>
    document.addEventListener('DOMContentLoaded', function() {
        const url = '{{ asset($file->document) }}';
        const container = document.getElementById('pdf-container');
        
        function renderPDF() {
            pdfjsLib.getDocument(url).promise.then(function(pdf) {
                container.innerHTML = ''; // Clear previous content

                const containerWidth = container.clientWidth;
                
                for (let pageNum = 1; pageNum <= pdf.numPages; pageNum++) {
                    pdf.getPage(pageNum).then(function(page) {
                        const viewport = page.getViewport({ scale: 1 }); // Initial scale of 1
                        const scale = containerWidth / viewport.width; // Adjust scale based on container width
                        const scaledViewport = page.getViewport({ scale: scale });
                        const canvas = document.createElement('canvas');
                        const context = canvas.getContext('2d');
                        canvas.height = scaledViewport.height;
                        canvas.width = scaledViewport.width;
                        container.appendChild(canvas);

                        const renderContext = {
                            canvasContext: context,
                            viewport: scaledViewport
                        };
                        page.render(renderContext);
                    });
                }
            }).catch(function(error) {
                console.error('Error loading PDF:', error);
            });
        }

        renderPDF(); // Initial render

        // Optionally, you can re-render the PDF on window resize
        window.addEventListener('resize', renderPDF);
    });
</script>


{{--
@include('partials.adminnav')
<div class="h-[calc(100vh-5.5rem)]"> <!-- Adjusted height to account for the adminnav -->
    <div class="w-full flex justify-between items-center text-center">
        <p class="bg-whitebg w-full text-white px-8 py-2">Research Title: {{$file->title}}</p>
        <a href="/admin/dashboard/archive">
            <button class="bg-whitebg text-white px-4 py-2"> 
                <svg width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" class="bg-gray-400 rounded-full text-black">
                    <path d="M18 6L6 18" />
                    <path d="M6 6L18 18" />
                </svg>
            </button>
        </a>
    </div>

    <!-- PDF.js Viewer -->
    <div class="h-full bg-transparent flex flex-col justify-between items-center sm:px-4 relative">
        <!-- Controls for pagination -->
        <div class="pagination-controls flex justify-between w-full sm:w-1/2 my-2">
            <button id="prev-page" class="bg-gray-300 text-black px-4 py-2 rounded">Previous</button>
            <span id="page-info" class="text-black">Page: <span id="page-num"></span> / <span id="page-count"></span></span>
            <button id="next-page" class="bg-gray-300 text-black px-4 py-2 rounded">Next</button>
        </div>

        <!-- PDF Canvas -->
        <div class="w-full sm:w-1/2">
            <canvas id="pdf-render" class="w-full border-whitebg border-8"></canvas>
        </div>

        <!-- Citation at the bottom -->
        <p class="bg-whitebg sm:w-1/2 w-full text-white py-1 text-center">Citation: {{$file->citation}}</p>
    </div>
</div>

<!-- Include PDF.js from CDN -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/pdf.js/2.12.313/pdf.min.js"></script>

<script>
    const url = "{{$file->document}}";  // URL of the PDF document

    const pdfjsLib = window['pdfjs-dist/build/pdf'];
    pdfjsLib.GlobalWorkerOptions.workerSrc = 'https://cdnjs.cloudflare.com/ajax/libs/pdf.js/2.12.313/pdf.worker.min.js';

    let pdfDoc = null,
        pageNum = 1,
        pageIsRendering = false,
        pageNumIsPending = null;

    const scale = 1.5,
          canvas = document.getElementById('pdf-render'),
          ctx = canvas.getContext('2d');

    // Render the page
    const renderPage = (num) => {
        pageIsRendering = true;

        // Get the page
        pdfDoc.getPage(num).then(page => {
            const viewport = page.getViewport({ scale });
            canvas.height = viewport.height;
            canvas.width = viewport.width;

            const renderCtx = {
                canvasContext: ctx,
                viewport: viewport
            };

            const renderTask = page.render(renderCtx);

            renderTask.promise.then(() => {
                pageIsRendering = false;

                if (pageNumIsPending !== null) {
                    renderPage(pageNumIsPending);
                    pageNumIsPending = null;
                }
            });

            // Update page counters
            document.getElementById('page-num').textContent = num;
        });
    };

    // Check for pages rendering
    const queueRenderPage = (num) => {
        if (pageIsRendering) {
            pageNumIsPending = num;
        } else {
            renderPage(num);
        }
    };

    // Show Prev Page
    const showPrevPage = () => {
        if (pageNum <= 1) {
            return;
        }
        pageNum--;
        queueRenderPage(pageNum);
    };

    // Show Next Page
    const showNextPage = () => {
        if (pageNum >= pdfDoc.numPages) {
            return;
        }
        pageNum++;
        queueRenderPage(pageNum);
    };

    // Get Document
    pdfjsLib.getDocument(url).promise.then(pdfDoc_ => {
        pdfDoc = pdfDoc_;

        document.getElementById('page-count').textContent = pdfDoc.numPages;

        renderPage(pageNum);
    });

    // Button Events
    document.getElementById('prev-page').addEventListener('click', showPrevPage);
    document.getElementById('next-page').addEventListener('click', showNextPage);
</script>
--}}