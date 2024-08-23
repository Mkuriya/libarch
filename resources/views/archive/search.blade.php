@include('partials.studentnav')
<script src="https://cdnjs.cloudflare.com/ajax/libs/pdf.js/2.10.377/pdf.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/pdf.js/2.10.377/pdf.worker.min.js"></script>

<div class="w-full flex justify-center items-end fixed bottom-0 left-0">
    <div id="search-bar" class="w-full sm:w-1/2 bg-white rounded-md shadow-lg z-10 mb-4">
        <form id="search-form" class="flex items-center justify-between p-2">
            <input id="search-input" type="text" placeholder="Search here" class="text-xl py-2 px-4 border-0 bg-white text-sm placeholder:text-gray-800 focus:outline-none focus:ring-0 w-full">
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

<!-- Container to display PDF, hidden by default -->


<div id="pdf-container" class="w-full h-[84%] flex flex-col items-center hidden ">
    <div class="w-full flex justify-between items-center text-center">
        <p id="pdf-title" class="bg-whitebg w-full text-white px-8 py-2"></p>
        <button id="close-pdf" class="bg-whitebg text-white px-4 py-2">
            <svg width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" class="bg-gray-400 rounded-full text-black">
                <path d="M18 6L6 18" />
                <path d="M6 6L18 18" />
            </svg>
        </button>
    </div>
    <div class="sm:w-1/2 w-full flex-1 overflow-y-auto relative ">
        <iframe id="pdf-iframe" src="" frameborder="0" class="w-full h-full bg-transparent border-whitebg  border-r-8 border-l-8"></iframe>
    </div>
    <div class="flex items-center justify-center sm:w-1/2 w-full bg-whitebg py-1 text-white">
        <p id="pdf-citation" class="mr-4"></p>
        <button id="copy-citation" class="bg-whitebg text-white py-1 px-4 rounded-md hover:bg-gray-700">
            <svg class="w-6 h-6 text-gray-800 dark:text-white" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="currentColor" viewBox="0 0 24 24">
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
        background-color: #503030; /* Green background */
        color: white;
        padding: 10px 20px;
        border-radius: 4px;
        box-shadow: 0 2px 4px rgba(0, 0, 0, 0.2);
        z-index: 1000; /* Ensure it's on top of other elements */
        transition: opacity 0.5s ease-in-out;
    }

</style>

<script>
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
        // Create notification element
        const notification = document.createElement('div');
        notification.className = 'notification';
        notification.textContent = message;
        
        // Add the notification to the body
        document.body.appendChild(notification);
        
        // Remove the notification after 3 seconds
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
                    resultDiv.classList.add('flex', 'flex-col', 'mb-4', 'w-full', 'max-w-lg');

                    if (!questionDisplayed) {
                        const questionDiv = document.createElement('div');
                        questionDiv.classList.add('result-item', 'bg-gray-500', 'text-white');
                        questionDiv.innerHTML = `<p><strong>Question:</strong> ${query}</p>`;
                        resultDiv.appendChild(questionDiv);
                        questionDisplayed = true;
                    }

                    results.forEach(result => {
                        const highlightedAnswer = highlightText(result.text, query);
                        const resultItemDiv = document.createElement('div');
                        resultItemDiv.classList.add('result-item', 'bg-gray-100');

                        resultItemDiv.innerHTML = `
                                <p class="mb-2">
                                    <button  class="text-red-800 hover:underline" onclick="showPDF('${pdfUrl}', '${pdfTitle}', '${pdfCitation}')">${pdfTitle}</button>
                                Page: ${result.page}
                                </p>
                            <p class="mb-2"><strong>Result:</strong> ${highlightedAnswer}</p>
                            
                        `;
                        resultDiv.appendChild(resultItemDiv);
                    });

                    resultsContainer.appendChild(resultDiv);
                }
            });
        }).catch(error => {
            console.error('Error loading PDF:', error);
            const errorDiv = document.createElement('div');
            errorDiv.classList.add('result-item', 'bg-gray-200');
            errorDiv.innerHTML = `<p class="text-gray-800">An error occurred while fetching the PDF.</p>`;
            resultsContainer.appendChild(errorDiv);
        });
    });

    setTimeout(() => {
        if (!resultsFound) {
            const noResultDiv = document.createElement('div');
            noResultDiv.classList.add('result-item', 'bg-gray-200');
            noResultDiv.innerHTML = `<p class="text-gray-800">No data found for "${query}"</p>`;
            resultsContainer.appendChild(noResultDiv);
        }
    }, 1000);
});

function showPDF(pdfUrl, title, citation, documentId) {
    const pdfContainer = document.getElementById('pdf-container');
    const resultsContainer = document.getElementById('results-container');
    const pdfTitle = document.getElementById('pdf-title');
    const pdfIframe = document.getElementById('pdf-iframe');
    const pdfCitation = document.getElementById('pdf-citation');

    // Hide the search results container
    resultsContainer.classList.add('hidden');

    // Display the PDF container
    pdfTitle.textContent = title;
    pdfIframe.src = `${pdfUrl}#toolbar=0`;
    pdfCitation.textContent = `Citation: ${citation}`;

    pdfContainer.classList.remove('hidden');

    // Send request to save the history
    fetch('/save-history', {
        method: 'POST',
        headers: {
            'Content-Type': 'application/json',
            'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
        },
        body: JSON.stringify({ document_id: documentId })
    })
    .then(response => response.json())
    .then(data => {
        if (data.status === 'success') {
            console.log('History saved successfully');
        } else {
            console.error('Failed to save history');
        }
    })
    .catch(error => console.error('Error:', error));
}



document.getElementById('close-pdf').addEventListener('click', function() {
    const pdfContainer = document.getElementById('pdf-container');
    const resultsContainer = document.getElementById('results-container');

    // Hide the PDF container
    pdfContainer.classList.add('hidden');

    // Show the search results container
    resultsContainer.classList.remove('hidden');
});

function findSnippets(text, query, page) {
    const snippets = [];
    const queryRegex = new RegExp(`[^.?!]*?${query}[^.?!]*[.?!]`, 'gi'); // Adjust regex to capture full sentences
    let match;
    
    while ((match = queryRegex.exec(text)) !== null) {
        const snippet = match[0].trim();

        // Ensure snippet starts from the beginning of the sentence
        const sentenceStartIndex = Math.max(
            text.lastIndexOf('.', match.index - 1) + 1,
            text.lastIndexOf('!', match.index - 1) + 1,
            text.lastIndexOf('?', match.index - 1) + 1
        );

        const fullSnippet = text.substring(sentenceStartIndex, match.index + snippet.length).trim();

        // Limit snippet to 20 words
        const limitedSnippet = limitWords(fullSnippet, 50);

        snippets.push({ text: limitedSnippet, page: page });
    }
    return snippets;
}

function limitWords(text, wordLimit) {
    const words = text.split(/\s+/);
    if (words.length > wordLimit) {
        return words.slice(0, wordLimit).join(' ') + '...'; // Append ellipsis if truncated
    }
    return text;
}


function highlightText(text, query) {
    const queryRegex = new RegExp(`(${query})`, 'gi');
    return text.replace(queryRegex, '<span class="highlight">$1</span>');
}

function calculateTermFrequency(text, term) {
    const words = text.toLowerCase().split(/\s+/);
    const termCount = words.filter(word => word === term).length;
    return termCount / words.length;
}

</script>
{{--}}

                    results.forEach(result => {
                        const highlightedAnswer = highlightText(result.text, query);
                        const answerDiv = document.createElement('div');
                        answerDiv.classList.add('result-item', 'bg-gray-200');
                        answerDiv.innerHTML = `
                            <p class="p-2 bg-red-300 w-full">
                                <a href="${pdfUrl}" class="text-red-800 hover:underline" target="_blank">${pdfTitle}</a>
                                <p class="right-0">Page:${result.page}</p>
                            </p>
                            <p><strong>Answer:</strong> ${highlightedAnswer}...</p>
                        `;
                        resultDiv.appendChild(answerDiv);
                    });

                    resultsContainer.appendChild(resultDiv);
                }
            });
        }).catch(error => {
            console.error('Error loading PDF:', error);
            const errorDiv = document.createElement('div');
            errorDiv.classList.add('result-item', 'bg-gray-200');
            errorDiv.innerHTML = `<p class="text-gray-800">An error occurred while fetching the PDF.</p>`;
            resultsContainer.appendChild(errorDiv);
        });
    });
--}}
