function showPDF(pdfUrl, title, citation, documentId, page) {
    const pdfContainer = document.getElementById('pdf-container');
    const resultsContainer = document.getElementById('results-container');
    const searchBar = document.getElementById('search-bar');
    const pdfTitle = document.getElementById('pdf-title');
    const pdfCitation = document.getElementById('pdf-citation');

    // Show the PDF container and hide other elements
    pdfContainer.classList.remove('hidden');
    searchBar.classList.add('hidden');
    resultsContainer.classList.add('hidden');

    // Set the title and citation
    pdfTitle.textContent = title;
    pdfCitation.textContent = `Citation: ${citation}`;

    // Clear existing pages before rendering new ones
    document.getElementById('pdf-canvas-container').innerHTML = '';

    // Load and render the PDF
    pdfjsLib.getDocument(pdfUrl).promise.then(pdf => {
        const numPages = pdf.numPages;
        for (let i = 1; i <= numPages; i++) {
            renderPage(pdf, i);
        }
    }).catch(error => {
        console.error('Error loading PDF:', error);
        alert('An error occurred while loading the PDF.');
    });

    // Save document history
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
