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
</style>

<script>
document.getElementById('search-form').addEventListener('submit', function(event) {
    event.preventDefault();
    const queryInput = document.getElementById('search-input');
    const query = queryInput.value.trim().toLowerCase();
    const resultsContainer = document.getElementById('results-container');

    queryInput.value = '';
    resultsContainer.innerHTML = '';

    if (!query) {
        const noResultDiv = document.createElement('div');
        noResultDiv.classList.add('result-item', 'bg-gray-200');
        noResultDiv.innerHTML = `<p class="text-gray-800">Please enter a search query.</p>`;
        resultsContainer.appendChild(noResultDiv);
        return;
    }

    // Iterate through each file passed from the controller
    @json($file).forEach(function(file) {
        const pdfUrl = file.document;

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

                            const snippets = findSnippets(pageText, query);
                            results = results.concat(snippets);
                        });
                    })
                );
            }

            Promise.all(pages).then(() => {
                if (results.length > 0) {
                    const resultDiv = document.createElement('div');
                    resultDiv.classList.add('flex', 'flex-col', 'mb-4', 'w-full', 'max-w-lg');

                    const questionDiv = document.createElement('div');
                    questionDiv.classList.add('result-item', 'bg-gray-500', 'text-white');
                    questionDiv.innerHTML = `<p><strong>Question:</strong> ${query}</p>`;
                    resultDiv.appendChild(questionDiv);

                    results.forEach(result => {
                        const highlightedAnswer = highlightText(result, query);
                        const answerDiv = document.createElement('div');
                        answerDiv.classList.add('result-item', 'bg-gray-200');
                        answerDiv.innerHTML = `
                            <p><strong>Answer:</strong> ${highlightedAnswer}</p>
                            <p class="mt-2"><a href="${pdfUrl}" class="text-red-800 hover:underline" target="_blank">View PDF</a></p>
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
});

function findSnippets(text, query) {
    const snippets = [];
    const queryRegex = new RegExp(`[^.]*${query}[^.]*`, 'gi');
    let match;
    while ((match = queryRegex.exec(text)) !== null) {
        snippets.push(match[0].trim());
    }
    return snippets;
}

function highlightText(text, query) {
    const queryRegex = new RegExp(`(${query})`, 'gi');
    return text.replace(queryRegex, '<span class="highlight">$1</span>');
}
</script>
