@include('partials.studentnav')  
<div class="h-[calc(100vh-5.5rem)]"> <!-- Adjusted height to account for the adminnav -->
    <div class="w-full flex justify-between items-center text-center">
        <p class="bg-whitebg w-full text-white px-8 py-2">Research Title: {{$file->title}}</p>
        <button onclick="window.history.back()" class="bg-whitebg text-white px-4 py-2"> 
            <svg width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" class="bg-gray-400 rounded-full text-black">
                <path d="M18 6L6 18" />
                <path d="M6 6L18 18" />
            </svg>
        </button>
    </div>
    
    <div class="h-full bg-transparent flex flex-col justify-between items-center sm:px-4 relative">
        <div class="sm:w-1/2 w-full flex-1 overflow-y-auto relative">
            <iframe src="{{$file->document}}#toolbar=0" frameborder="0" class="w-full h-full bg-transparent border-whitebg border-8"></iframe>
        </div>
  
        <div class="flex items-center justify-center sm:w-1/2 w-full bg-whitebg py-1 text-white">
            <p id="citation-text" class="bg-whitebg px-4">Citation: {{$file->citation}}</p>
            <button id="copy-citation" class="bg-whitebg text-white py-1 px-4 mr-2 rounded-md hover:bg-gray-700">
                <svg class="w-6 h-6 text-white" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="currentColor" viewBox="0 0 24 24">
                    <path fill-rule="evenodd" d="M18 3a2 2 0 0 1 2 2v10a2 2 0 0 1-2 2h-1V9a4 4 0 0 0-4-4h-3a1.99 1.99 0 0 0-1 .267V5a2 2 0 0 1 2-2h7Z" clip-rule="evenodd"/>
                    <path fill-rule="evenodd" d="M8 7.054V11H4.2a2 2 0 0 1 .281-.432l2.46-2.87A2 2 0 0 1 8 7.054ZM10 7v4a2 2 0 0 1-2 2H4v6a2 2 0 0 0 2 2h7a2 2 0 0 0 2-2V9a2 2 0 0 0-2-2h-3Z" clip-rule="evenodd"/>
                </svg>
            </button>
        </div>  
    </div>
</div>

<style>
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
        opacity: 1;
        transition: opacity 0.5s ease-in-out;
    }
    .notification.fade-out {
        opacity: 0;
    }
</style>

<script>
    document.getElementById('copy-citation').addEventListener('click', function() {
        // Get the citation text
        var citationText = document.getElementById('citation-text').innerText.replace('Citation: ', '');
        
        // Copy the text to the clipboard
        navigator.clipboard.writeText(citationText).then(function() {
            showNotification('Citation copied to clipboard');
        }, function(err) {
            console.error('Could not copy text: ', err);
        });
    });

    function showNotification(message) {
        const notification = document.createElement('div');
        notification.className = 'notification';
        notification.textContent = message;

        document.body.appendChild(notification);

        // Automatically fade out the notification after 3 seconds
        setTimeout(function() {
            notification.classList.add('fade-out');
        }, 2500); // Start fade out after 2.5 seconds

        // Remove notification from DOM after the fade-out completes
        setTimeout(function() {
            notification.remove();
        }, 3000); // Remove after 3 seconds
    }
</script>
