@include('partials.studentnav')
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
        background-color: yellow; /* Change this to your preferred highlight color */
        border-radius: 4px;
        padding: 2px;
        font-weight: bold;
    }
</style>


<script>
    document.getElementById('search-form').addEventListener('submit', function(event) {
        event.preventDefault();
        const query = document.getElementById('search-input').value.trim().toLowerCase();
        const resultsContainer = document.getElementById('results-container');

        // Clear previous results
        resultsContainer.innerHTML = '';

        if (!query) {
            // Display a message if the query is empty
            const noResultDiv = document.createElement('div');
            noResultDiv.classList.add('bg-gray-200', 'shadow-md', 'rounded-md', 'p-4', 'mb-4', 'w-full', 'max-w-lg');
            noResultDiv.innerHTML = `
                <p class="text-gray-800">Please enter a search query.</p>
            `;
            resultsContainer.appendChild(noResultDiv);
            return;
        }

        // Fetch search results from the server
        fetch(`/search-abstracts?query=${encodeURIComponent(query)}`)
            .then(response => {
                if (!response.ok) {
                    throw new Error('Network response was not ok');
                }
                return response.json();
            })
            .then(data => {
                // Display results
                if (data.length > 0) {
                    data.forEach(result => {
                        const resultDiv = document.createElement('div');
                        resultDiv.classList.add('flex', 'flex-col', 'mb-4', 'w-full', 'max-w-lg');

                        // Question bubble
                        const questionDiv = document.createElement('div');
                        questionDiv.classList.add('bg-gray-500', 'text-white', 'p-4', 'rounded-lg', 'shadow-md', 'self-end', 'mb-2');
                        questionDiv.innerHTML = `<p><strong>Question:</strong> ${query}</p>`;

                        // Answer bubble with truncated and highlighted text
                        const answerDiv = document.createElement('div');
                        answerDiv.classList.add('bg-gray-200', 'text-black', 'p-4', 'rounded-lg', 'shadow-md', 'self-start');
                        const truncatedAnswer = truncateText(result.abstract, query);
                        const highlightedAnswer = highlightText(truncatedAnswer, query);
                        answerDiv.innerHTML = `
                            <p><strong>Answer:</strong> ${highlightedAnswer}</p>
                            <p class="mt-2"><a href="" class="text-red-800 hover:underline" target="_blank">View PDF</a></p>
                        `;

                        resultDiv.appendChild(questionDiv);
                        resultDiv.appendChild(answerDiv);

                        resultsContainer.appendChild(resultDiv);
                    });
                } else {
                    const noResultDiv = document.createElement('div');
                    noResultDiv.classList.add('bg-gray-200', 'shadow-md', 'rounded-md', 'p-4', 'mb-4', 'w-full', 'max-w-lg');
                    noResultDiv.innerHTML = `
                        <p class="text-gray-800">No results found for "${query}".</p>
                    `;
                    resultsContainer.appendChild(noResultDiv);
                }
            })
            .catch(error => {
                console.error('Error fetching abstracts:', error);
                const errorDiv = document.createElement('div');
                errorDiv.classList.add('bg-gray-200', 'shadow-md', 'rounded-md', 'p-4', 'mb-4', 'w-full', 'max-w-lg');
                errorDiv.innerHTML = `<p class="text-gray-800">An error occurred while fetching results.</p>`;
                resultsContainer.appendChild(errorDiv);
            });
    });

    // Function to truncate text to the full sentence containing the query word up to the first period
    function truncateText(text, query) {
        const queryIndex = text.toLowerCase().indexOf(query);
        if (queryIndex === -1) {
            return ''; // Query word not found
        }
        
        const start = text.lastIndexOf('.', queryIndex) + 1;
        const end = text.indexOf('.', queryIndex);

        if (end === -1) {
            return text.slice(start).trim(); // No period found after query
        }
        return text.slice(start, end + 1).trim(); // Include the period
    }

    // Function to highlight matching words in the text
    function highlightText(text, query) {
        const queryRegex = new RegExp(`(${query})`, 'gi');
        return text.replace(queryRegex, '<span class="highlight">$1</span>');
    }
</script>
