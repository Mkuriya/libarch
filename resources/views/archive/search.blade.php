@include('partials.studentnav')
<script src="https://cdnjs.cloudflare.com/ajax/libs/pdf.js/2.10.377/pdf.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/pdf.js/2.10.377/pdf.worker.min.js"></script>

<div class="w-full flex justify-center items-end fixed bottom-0 left-0">
    <div id="search-bar" class="w-full sm:w-1/2 bg-white rounded-md shadow-lg z-10 mb-4">
        <form id="search-form" class="flex items-center justify-between p-2">
            <input id="search-input" type="text" placeholder="Search here" class="text-xl py-2 px-4 border-0 bg-white text-sm placeholder:text-gray-800 focus:outline-none focus:ring-0 w-full" autocomplete="off" >
            <button type="submit" class="bg-whitebg hover:bg-blue-700 text-white rounded-md py-2 px-4 ml-2">
                <svg class="h-6 w-6" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                    <line x1="22" y1="2" x2="11" y2="13" />
                    <polygon points="22 2 15 22 11 13 2 9 22 2" />
                </svg>
            </button>
        </form>
    </div>
</div>

<div id="results-container" class="w-full flex flex-col items-center mt-6">
    <!-- Search results will be displayed here -->
</div>

<div id="pdf-container" class="w-full h-[93%] flex flex-col items-center hidden ">
    <div class="w-full flex justify-between items-center text-center bg-whitebg">
        <p id="pdf-title" class=" w-full text-white px-8 py-2"></p>
        <button id="close-pdf" class="text-white px-4 py-2">
            <svg width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" class="bg-gray-400 rounded-full text-black">
                <path d="M18 6L6 18" />
                <path d="M6 6L18 18" />
            </svg>
        </button>
    </div>
    <div class="sm:w-1/2 w-full flex-1 overflow-y-auto relative ">
        <iframe id="pdf-iframe" src="" frameborder="0" class="w-full h-full bg-transparent border-whitebg border-r-8 border-l-8"></iframe>
    </div>
    <div class="flex items-center justify-center sm:w-1/2 w-full bg-whitebg py-1 text-white">
        <p id="pdf-citation" class="px-4"></p>
        <button id="copy-citation" class="bg-whitebg text-white py-1 px-4 mr-2 rounded-md hover:bg-gray-700">
            <svg class="w-6 h-6 text-white" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="currentColor" viewBox="0 0 24 24">
                <path fill-rule="evenodd" d="M18 3a2 2 0 0 1 2 2v10a2 2 0 0 1-2 2h-1V9a4 4 0 0 0-4-4h-3a1.99 1.99 0 0 0-1 .267V5a2 2 0 0 1 2-2h7Z" clip-rule="evenodd"/>
                <path fill-rule="evenodd" d="M8 7.054V11H4.2a2 2 0 0 1 .281-.432l2.46-2.87A2 2 0 0 1 8 7.054ZM10 7v4a2 2 0 0 1-2 2H4v6a2 2 0 0 0 2 2h7a2 2 0 0 0 2-2V9a2 2 0 0 0-2-2h-3Z" clip-rule="evenodd"/>
              </svg>
        </button>
    </div>
</div>

<style>
    .highlight {
        background-color: yellow;
        border-radius: 4px;
        padding: 2px;
        font-weight: bold;
    }

    #results-container {
        max-height: 75vh;
        overflow-y: auto;
    }

    .result-item {
        margin-bottom: 1rem;
        padding: 1rem;
        border-radius: 0.5rem;
        box-shadow: 0 0 0.25rem rgba(0, 0, 0, 0.1);
    }

    .notification {
        position: fixed;
        bottom: 20px;
        right: 20px;
        background-color: #503030;
        color: white;
        padding: 10px 20px;
        border-radius: 4px;
        box-shadow: 0 2px 4px rgba(0, 0, 0, 0.2);
        z-index: 1000;
        transition: opacity 0.5s ease-in-out;
    }
</style>

<script>
    const studentId = @json(auth()->guard('student')->user()->id); // Assuming this is in a Blade file and the user is authenticated

    // Copy Citation to Clipboard
    document.getElementById('copy-citation').addEventListener('click', function() {
        const citationText = document.getElementById('pdf-citation').textContent;
        navigator.clipboard.writeText(citationText).then(function() {
            showNotification('Citation copied to clipboard!');
        }).catch(function(error) {
            console.error('Failed to copy citation:', error);
        });
    });

    function showNotification(message) {
        const notification = document.createElement('div');
        notification.className = 'notification';
        notification.textContent = message;

        document.body.appendChild(notification);

        setTimeout(function() {
            notification.remove();
        }, 3000);
    }

    document.getElementById('search-form').addEventListener('submit', function(event) {
        event.preventDefault();
        const queryInput = document.getElementById('search-input');
        const query = queryInput.value.trim().toLowerCase();
        const resultsContainer = document.getElementById('results-container');
        const pdfContainer = document.getElementById('pdf-container');

        queryInput.value = '';
        resultsContainer.innerHTML = '';
        pdfContainer.classList.add('hidden');

        if (!query) {
            const noResultDiv = document.createElement('div');
            noResultDiv.classList.add('result-item', 'bg-gray-200');
            noResultDiv.innerHTML = `<p class="text-gray-800">Please enter a search query.</p>`;
            resultsContainer.appendChild(noResultDiv);
            return;
        }

        let questionDisplayed = false;
        let resultsFound = false;

        @json($file).forEach(function(file) {
            const pdfUrl = file.document;
            const pdfTitle = file.title;
            const pdfCitation = file.citation;

            pdfjsLib.getDocument(pdfUrl).promise.then(pdf => {
                let allText = '';
                let results = [];

                const pages = [];
                for (let i = 1; i <= pdf.numPages; i++) {
                    pages.push(
                        pdf.getPage(i).then(page => {
                            return page.getTextContent().then(textContent => {
                                const textItems = textContent.items.map(item => item.str);
                                const pageText = textItems.join(' ');
                                allText += ' ' + pageText;

                                const snippets = findSnippets(pageText, query, i);
                                results = results.concat(snippets);
                            });
                        })
                    );
                }

                Promise.all(pages).then(() => {
                    if (results.length > 0) {
                        resultsFound = true;
                        results.sort((a, b) => calculateTermFrequency(b.text, query) - calculateTermFrequency(a.text, query));

                        const resultDiv = document.createElement('div');
                        resultDiv.classList.add('flex', 'flex-col', 'mb-2', 'w-full', 'max-w-2xl');

                        if (!questionDisplayed) {
                            const questionDiv = document.createElement('div');
                            questionDiv.classList.add('result-item', 'bg-gray-500', 'text-white');
                            questionDiv.innerHTML = `<p class="text-sm"><strong>Question:</strong> ${query}</p>`;
                            resultDiv.appendChild(questionDiv);
                            questionDisplayed = true;
                        }

                        let combinedAnswer = '';
                        let lastPageNumber = null;

                        results.forEach(result => {
                            if (lastPageNumber !== null && lastPageNumber !== result.page) {
                                combinedAnswer += `<br>`;
                            }
                            combinedAnswer += `<strong>Page:</strong> ${result.page} <br> <strong>Answer:</strong> <span class="hover:underline cursor-pointer" onclick="showPDF('${pdfUrl}', '${pdfTitle}', '${pdfCitation}', '${file.id}', ${result.page})">${highlightText(result.text, query)}</span><br>`;
                            lastPageNumber = result.page;
                        });

                        const answerDiv = document.createElement('div');
                        answerDiv.classList.add('result-item', 'bg-gray-300', 'text-black', 'p-2');
                        answerDiv.innerHTML = `<p class="text-sm"><strong>Title:</strong> ${pdfTitle} <br>${combinedAnswer}</p>`;

                        resultDiv.appendChild(answerDiv);
                        resultsContainer.appendChild(resultDiv);
                    }
                });
            }).catch(error => {
                console.error('Error loading PDF:', error);
                const errorDiv = document.createElement('div');
                errorDiv.classList.add('result-item', 'bg-gray-200');
                errorDiv.innerHTML = `<p class="text-black">An error occurred while fetching the PDF.</p>`;
                resultsContainer.appendChild(errorDiv);
            });
        });

        setTimeout(() => {
            if (!resultsFound) {
                const noResultDiv = document.createElement('div');
                noResultDiv.classList.add('result-item', 'bg-gray-200');
                noResultDiv.innerHTML = `<p class="text-black">No data found for "${query}"</p>`;
                resultsContainer.appendChild(noResultDiv);
            }
        }, 1000);
    });

    function calculateTermFrequency(text, query) {
        const regex = new RegExp(`\\b${query}\\b`, 'gi');
        const matches = text.match(regex);
        return matches ? matches.length : 0;
    }

    function findSnippets(text, query, pageNumber) {
        const sentences = text.split(/(?<=[.!?])\s+/); // Split text into sentences based on punctuation
        const snippetSize = 15; // Number of words to include after the search term

        for (const sentence of sentences) {
            if (sentence.toLowerCase().includes(query.toLowerCase())) {
                const words = sentence.split(/\s+/);
                const index = words.findIndex(word => word.toLowerCase().includes(query.toLowerCase()));

                if (index !== -1) {
                    // Create the snippet up to the snippet size or end of sentence, whichever comes first
                    const snippetWords = words.slice(0, Math.min(words.length, index + snippetSize + 1));
                    let snippet = snippetWords.join(' ');

                    // Add "..." if the snippet doesn't include the full sentence
                    if (snippetWords.length < words.length) {
                        snippet += '...';
                    }

                    return [{ text: snippet, page: pageNumber }];
                }
            }
        }

        return [];
    }


    function highlightText(text, query) {
        const regex = new RegExp(`(${query})`, 'gi');
        return text.replace(regex, '<span class="highlight">$1</span>');
    }

    function showPDF(pdfUrl, title, citation, documentId, page) {
        const pdfContainer = document.getElementById('pdf-container');
        const resultsContainer = document.getElementById('results-container');
        const searchBar = document.getElementById('search-bar');
        const pdfTitle = document.getElementById('pdf-title');
        const pdfIframe = document.getElementById('pdf-iframe');
        const pdfCitation = document.getElementById('pdf-citation');

        searchBar.classList.add('hidden');
        resultsContainer.classList.add('hidden');

        pdfTitle.textContent = title;
        pdfIframe.src = `${pdfUrl}#page=${page}&toolbar=0`; // Set the page number in the URL
        pdfCitation.textContent = `Citation: ${citation}`;

        pdfContainer.classList.remove('hidden');

        fetch('/save-document', {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
                'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
            },
            body: JSON.stringify({ document_id: documentId, student_id: studentId })
        })
        .then(response => response.json())
        .then(data => {
            if (data.status === 'success') {
                console.log('History saved successfully');
            } else {
                console.error('Failed to save history');
            }
        })
        .catch(error => {
            console.error('Error:', error);
            alert('An error occurred while saving the history.');
        });
    }

    document.getElementById('close-pdf').addEventListener('click', function() {
    const pdfContainer = document.getElementById('pdf-container');
    const searchBar = document.getElementById('search-bar');
    const resultsContainer = document.getElementById('results-container');
    const pdfIframe = document.getElementById('pdf-iframe');

    // Reset the iframe's src to clear the current view of the PDF
    pdfIframe.src = ''; 

    pdfContainer.classList.add('hidden');
    searchBar.classList.remove('hidden');
    resultsContainer.classList.remove('hidden');
});

</script>

{{--
@include('partials.studentnav')
<script src="https://cdnjs.cloudflare.com/ajax/libs/pdf.js/2.10.377/pdf.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/pdf.js/2.10.377/pdf.worker.min.js"></script>

<div class="w-full flex justify-center items-end fixed bottom-0 left-0 ">
    <div id="search-bar" class="w-full sm:w-1/2 bg-white rounded-md shadow-lg z-10 mb-4">
        <form id="search-form" class="flex items-center justify-between p-2">
            <input id="search-input" type="text" placeholder="Search here" class="text-xl py-2 px-4 border-0 bg-white text-sm placeholder:text-gray-800 focus:outline-none focus:ring-0 w-full" autocomplete="off" >
            <button type="submit" class="bg-whitebg hover:bg-blue-700 text-white rounded-md py-2 px-4 ml-2">
                <svg class="h-6 w-6" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                    <line x1="22" y1="2" x2="11" y2="13" />
                    <polygon points="22 2 15 22 11 13 2 9 22 2" />
                </svg>
            </button>
        </form>
    </div>
</div>

<div id="results-container" class="w-full flex flex-col items-center mt-6">
    <!-- Search results will be displayed here -->
</div>
<div id="pdf-container" class="w-full h-full flex flex-col justify-between items-center hidden">
    <!-- Title fixed at the top -->
   
    <div class="w-full  flex justify-center items-end fixed top-12 left-0 ">
        <div class="w-full sm:w-1/2 bg-whitebg  text-white ">
            <div class="flex items-center justify-between p-2">
                <p id="pdf-title" class="w-full  text-white px-8 py-2">PDF Title</p>
                <button id="close-pdf" class=" text-white px-4 py-2">
                    <svg width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" class="bg-gray-400 rounded-full text-black">
                        <path d="M18 6L6 18" />
                        <path d="M6 6L18 18" />
                    </svg>
                </button>
            </div>
        </div>
    </div>

    <!-- PDF content centered vertically -->
    <div class="w-full sm:w-1/2 flex-1 flex justify-center items-center bg-white overflow-y-auto mt-20 "> <!-- Adjusted top and bottom margin -->
        <canvas id="pdf-canvas" class=""></canvas>
    </div>

    <!-- Citation fixed at the bottom -->
    <div class="w-full  flex justify-center items-end fixed bottom-0 left-0 ">
        <div class="w-full sm:w-1/2 bg-whitebg   text-white ">
            <div class="flex items-center justify-between p-2">
                <p id="pdf-citation" class="px-4">Citation Text</p>
                <button id="copy-citation" class="bg-gray-700 text-white py-1 px-4 rounded-md hover:bg-gray-600 mr-4">
                    <svg class="w-6 h-6 text-white" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="currentColor" viewBox="0 0 24 24">
                        <path fill-rule="evenodd" d="M18 3a2 2 0 0 1 2 2v10a2 2 0 0 1-2 2h-1V9a4 4 0 0 0-4-4h-3a1.99 1.99 0 0 0-1 .267V5a2 2 0 0 1 2-2h7Z" clip-rule="evenodd"/>
                        <path fill-rule="evenodd" d="M8 7.054V11H4.2a2 2 0 0 1 .281-.432l2.46-2.87A2 2 0 0 1 8 7.054ZM10 7v4a2 2 0 0 1-2 2H4v6a2 2 0 0 0 2 2h7a2 2 0 0 0 2-2V9a2 2 0 0 0-2-2h-3Z" clip-rule="evenodd"/>
                    </svg>
                </button>
            </div>
        </div>
    </div>
</div>



<style>
    .highlight {
        background-color: yellow;
        border-radius: 4px;
        padding: 2px;
        font-weight: bold;
    }

    #results-container {
        max-height: 75vh;
        overflow-y: auto;
    }

    .result-item {
        margin-bottom: 1rem;
        padding: 1rem;
        border-radius: 0.5rem;
        box-shadow: 0 0 0.25rem rgba(0, 0, 0, 0.1);
    }

    .notification {
        position: fixed;
        bottom: 20px;
        right: 20px;
        background-color: #503030;
        color: white;
        padding: 10px 20px;
        border-radius: 4px;
        box-shadow: 0 2px 4px rgba(0, 0, 0, 0.2);
        z-index: 1000;
        transition: opacity 0.5s ease-in-out;
    }
    
    #pdf-container {
        max-height: 85vh; /* Limit the height of the entire container */
        overflow-y: auto; /* Allow vertical scroll if content is too long */
    }

    #pdf-canvas {
        width: 100%; /* Ensure the canvas takes up full width */
        height: auto; /* Auto-adjust height while maintaining aspect ratio */
    }

    @media (max-width: 640px) {
        #pdf-container {
            width: 100%; /* Full width on mobile */
        }
    }


</style>

<script>
    
    const studentId = @json(auth()->guard('student')->user()->id); // Assuming this is in a Blade file and the user is authenticated

    // Copy Citation to Clipboard
    document.getElementById('copy-citation').addEventListener('click', function() {
        const citationText = document.getElementById('pdf-citation').textContent;
        navigator.clipboard.writeText(citationText).then(function() {
            showNotification('Citation copied to clipboard!');
        }).catch(function(error) {
            console.error('Failed to copy citation:', error);
        });
    });

    function showNotification(message) {
        const notification = document.createElement('div');
        notification.className = 'notification';
        notification.textContent = message;

        document.body.appendChild(notification);

        setTimeout(function() {
            notification.remove();
        }, 3000);
    }

    document.getElementById('search-form').addEventListener('submit', function(event) {
        event.preventDefault();
        const queryInput = document.getElementById('search-input');
        const query = queryInput.value.trim().toLowerCase();
        const resultsContainer = document.getElementById('results-container');
        const pdfContainer = document.getElementById('pdf-container');

        queryInput.value = '';
        resultsContainer.innerHTML = '';
        pdfContainer.classList.add('hidden');

        if (!query) {
            const noResultDiv = document.createElement('div');
            noResultDiv.classList.add('result-item', 'bg-gray-200');
            noResultDiv.innerHTML = `<p class="text-gray-800">Please enter a search query.</p>`;
            resultsContainer.appendChild(noResultDiv);
            return;
        }

        let questionDisplayed = false;
        let resultsFound = false;

        @json($file).forEach(function(file) {
            const pdfUrl = file.document;
            const pdfTitle = file.title;
            const pdfCitation = file.citation;

            pdfjsLib.getDocument(pdfUrl).promise.then(pdf => {
                let allText = '';
                let results = [];

                const pages = [];
                for (let i = 1; i <= pdf.numPages; i++) {
                    pages.push(
                        pdf.getPage(i).then(page => {
                            return page.getTextContent().then(textContent => {
                                const textItems = textContent.items.map(item => item.str);
                                const pageText = textItems.join(' ');
                                allText += ' ' + pageText;

                                const snippets = findSnippets(pageText, query, i);
                                results = results.concat(snippets);
                            });
                        })
                    );
                }

                Promise.all(pages).then(() => {
                    if (results.length > 0) {
                        resultsFound = true;
                        results.sort((a, b) => calculateTermFrequency(b.text, query) - calculateTermFrequency(a.text, query));

                        const resultDiv = document.createElement('div');
                        resultDiv.classList.add('flex', 'flex-col', 'mb-2', 'w-full', 'max-w-2xl');

                        if (!questionDisplayed) {
                            const questionDiv = document.createElement('div');
                            questionDiv.classList.add('result-item', 'bg-gray-500', 'text-white');
                            questionDiv.innerHTML = `<p class="text-sm"><strong>Question:</strong> ${query}</p>`;
                            resultDiv.appendChild(questionDiv);
                            questionDisplayed = true;
                        }

                        let combinedAnswer = '';
                        let lastPageNumber = null;

                        results.forEach(result => {
                            if (lastPageNumber !== null && lastPageNumber !== result.page) {
                                combinedAnswer += `<br>`;
                            }
                            combinedAnswer += `<strong>Page:</strong> ${result.page} <br> <strong>Answer:</strong> <span class="hover:underline cursor-pointer" onclick="showPDF('${pdfUrl}', '${pdfTitle}', '${pdfCitation}', '${file.id}', ${result.page})">${highlightText(result.text, query)}</span><br>`;
                            lastPageNumber = result.page;
                        });

                        const answerDiv = document.createElement('div');
                        answerDiv.classList.add('result-item', 'bg-gray-300', 'text-black', 'p-2');
                        answerDiv.innerHTML = `<p class="text-sm"><strong>Title:</strong> ${pdfTitle} <br>${combinedAnswer}</p>`;

                        resultDiv.appendChild(answerDiv);
                        resultsContainer.appendChild(resultDiv);
                    }
                });
            }).catch(error => {
                console.error('Error loading PDF:', error);
                const errorDiv = document.createElement('div');
                errorDiv.classList.add('result-item', 'bg-gray-200');
                errorDiv.innerHTML = `<p class="text-black">An error occurred while fetching the PDF.</p>`;
                resultsContainer.appendChild(errorDiv);
            });
        });

        setTimeout(() => {
            if (!resultsFound) {
                const noResultDiv = document.createElement('div');
                noResultDiv.classList.add('result-item', 'bg-gray-200');
                noResultDiv.innerHTML = `<p class="text-black">No data found for "${query}"</p>`;
                resultsContainer.appendChild(noResultDiv);
            }
        }, 1000);
    });

    function calculateTermFrequency(text, query) {
        const regex = new RegExp(`\\b${query}\\b`, 'gi');
        const matches = text.match(regex);
        return matches ? matches.length : 0;
    }

    function findSnippets(text, query, pageNumber) {
        const sentences = text.split(/(?<=[.!?])\s+/); // Split text into sentences based on punctuation
        const snippetSize = 15; // Number of words to include after the search term

        for (const sentence of sentences) {
            if (sentence.toLowerCase().includes(query.toLowerCase())) {
                const words = sentence.split(/\s+/);
                const index = words.findIndex(word => word.toLowerCase().includes(query.toLowerCase()));

                if (index !== -1) {
                    // Create the snippet up to the snippet size or end of sentence, whichever comes first
                    const snippetWords = words.slice(0, Math.min(words.length, index + snippetSize + 1));
                    let snippet = snippetWords.join(' ');

                    // Add "..." if the snippet doesn't include the full sentence
                    if (snippetWords.length < words.length) {
                        snippet += '...';
                    }

                    return [{ text: snippet, page: pageNumber }];
                }
            }
        }

        return [];
    }


    function highlightText(text, query) {
        const regex = new RegExp(`(${query})`, 'gi');
        return text.replace(regex, '<span class="highlight">$1</span>');
    }

    function showPDF(pdfUrl, title, citation, documentId, page) {
    const pdfContainer = document.getElementById('pdf-container');
    const resultsContainer = document.getElementById('results-container');
    const searchBar = document.getElementById('search-bar');
    const pdfTitle = document.getElementById('pdf-title');
    const pdfCitation = document.getElementById('pdf-citation');

    let currentPage = page; // Save current page for scrolling purposes

    searchBar.classList.add('hidden');
    resultsContainer.classList.add('hidden');
    pdfContainer.classList.remove('hidden');

    pdfTitle.textContent = title;
    pdfCitation.textContent = `Citation: ${citation}`;

    // Clear existing canvases if any
    pdfContainer.querySelectorAll('canvas').forEach(canvas => canvas.remove());

    // Render the entire PDF using pdf.js
    pdfjsLib.getDocument(pdfUrl).promise.then(function(pdf) {
        for (let pageNum = 1; pageNum <= pdf.numPages; pageNum++) {
            const canvas = document.createElement('canvas');
            canvas.id = `pdf-page-${pageNum}`;
            pdfContainer.appendChild(canvas);

            renderPDFPage(pdf, pageNum, canvas);
        }

        // Scroll to the selected page after all pages have been rendered
        setTimeout(() => {
            document.getElementById(`pdf-page-${currentPage}`).scrollIntoView({ behavior: 'smooth' });
        }, 500); // Adjust timeout if necessary depending on rendering speed

        // Re-render pages on window resize
        window.addEventListener('resize', function() {
            for (let pageNum = 1; pageNum <= pdf.numPages; pageNum++) {
                const canvas = document.getElementById(`pdf-page-${pageNum}`);
                renderPDFPage(pdf, pageNum, canvas);
            }
        });
    }).catch(function(error) {
        console.error('Error rendering PDF:', error);
    });
    fetch('/save-document', {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
                'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
            },
            body: JSON.stringify({ document_id: documentId, student_id: studentId })
        })
        .then(response => response.json())
        .then(data => {
            if (data.status === 'success') {
                console.log('History saved successfully');
            } else {
                console.error('Failed to save history');
            }
        })
        .catch(error => {
            console.error('Error:', error);
            alert('An error occurred while saving the history.');
        });
}

function renderPDFPage(pdf, pageNumber, canvas) {
    const pdfContainer = document.getElementById('pdf-container');

    pdf.getPage(pageNumber).then(function(page) {
    const viewport = page.getViewport({ scale: 1 });
    const containerWidth = pdfContainer.clientWidth;

    // Calculate a suitable scale based on the container's width
    let scale = containerWidth / viewport.width;
    if (window.innerWidth > 640) {
        scale = Math.min(1.28, containerWidth / viewport.width); // Max scale for larger screens
    }

    // Use device pixel ratio to avoid blur on high-DPI displays
    const dpr = window.devicePixelRatio || 1; // Get the device's pixel ratio (default to 1)

    // Scale the viewport by both the calculated scale and the device pixel ratio
    const scaledViewport = page.getViewport({ scale: scale * dpr });

    // Adjust canvas dimensions for high-DPI screens
    const canvas = document.createElement('canvas'); // Create a new canvas element
    const context = canvas.getContext('2d');
    canvas.height = scaledViewport.height;
    canvas.width = scaledViewport.width;

    // Set the canvas display size back to CSS size (for proper display in layout)
    canvas.style.width = `${scaledViewport.width / dpr}px`;
    canvas.style.height = `${scaledViewport.height / dpr}px`;

    // Render PDF page into canvas context
    const renderContext = {
        canvasContext: context,
        viewport: scaledViewport
    };

    page.render(renderContext).promise.then(function() {
        // Append the canvas to the PDF container
        pdfContainer.appendChild(canvas);
    });
});

}


    document.getElementById('close-pdf').addEventListener('click', function() {
        const pdfContainer = document.getElementById('pdf-container');
        const searchBar = document.getElementById('search-bar');
        const resultsContainer = document.getElementById('results-container');

        pdfContainer.classList.add('hidden');
        searchBar.classList.remove('hidden');
        resultsContainer.classList.remove('hidden');
    });

</script>--}}