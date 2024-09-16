@include('partials.studentnav')@if ($errors->any())
<!-- Modal overlay -->
<div id="errorModalOverlay" class="fixed inset-0 bg-gray-600 bg-opacity-50 flex justify-center items-center z-50">
    <!-- Modal structure -->
    <div class="bg-gray-300 rounded-lg shadow-lg w-11/12 md:w-1/3">
        <div class="flex justify-between items-center bg-red-500 text-white text-lg p-4 rounded-t-lg">
            <!-- Error icon -->
            <svg height="32" style="overflow:visible;enable-background:new 0 0 32 32" viewBox="0 0 32 32" width="32" xmlns="http://www.w3.org/2000/svg">
                <circle cx="16" cy="16" r="16" style="fill:#D72828;"/>
                <path d="M14.5,25h3v-3h-3V25z M14.5,6v13h3V6H14.5z" style="fill:#E6E6E6;"/>
            </svg>
            <h5 class="font-bold">SOME FIELDS ARE MISSING, PLEASE FILL THEM.</h5>
            <button id="closeErrorModal" class="text-2xl leading-none">&times;</button>
        </div>
        <div class="p-4">
            <div class="text-red-800 text-start pl-4">
                <ul class="list-disc list-inside">
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        </div>
    </div>
</div>
@endif

<section class="max-w-5xl pt-6 px-6 mx-auto rounded-md shadow-md bg-gray-800 sm:mt-4 mt-0">
<h1 class="text-xl font-bold text-white capitalize ">Upload Research</h1>
<form id="citation-form" name="citation-form" action="/student/dashboard/upload/file" method="POST" enctype="multipart/form-data">
    @csrf
    <input type="hidden" name="status" value="0">
    <input type="hidden" name="student_lastname" value="{{ auth()->guard('student')->user()->firstname }}">
    <input type="hidden" name="student_firstname" value="{{ auth()->guard('student')->user()->lastname }}">
    <input type="hidden" name="student_department" value="{{ auth()->guard('student')->user()->department }}">
    <div class="mt-4">
        <label for="title" class="text-gray-200">Title</label>
        <input type="text" name="title" id="title" class="block w-full px-4 py-2 mt-2  border  rounded-md bg-gray-800 text-gray-300 border-gray-600 focus:border-white ">
    </div>
    <div class="mt-4">
        <label for="year" class="text-white dark:text-gray-200">Year</label>
        <input min="1900" max="2099" step="1" value="2024" name="year" id="year" type="number" class="hide-arrows block w-full px-4 py-2 mt-2 border rounded-md bg-gray-800 text-gray-300 border-gray-600 focus:border-white  no-spinner">
    </div>
    <div class="mt-4 flex justify-between items-center">
        <label for="" class="text-gray-200">Members</label>
        <button type="button" onclick="addAuthor()" class="p-2 bg-whitebg hover:bg-gray-700 text-white rounded-md">Add Author</button>
    </div>
    
    <div id="authors-container" class="mt-2">
        <!-- Author fields will be added here -->
    </div>
    
    <div class="mt-4 hidden">
        <label class="text-gray-200">Members List</label>
        <textarea id="members-preview" name="members" rows="3" class="block w-full px-4 py-2 mt-2  border  rounded-md bg-gray-800 text-gray-300 border-gray-600 focus:border-white " readonly></textarea>
    </div>
    
    <div class="mt-4">
        <label for="abstract" class="text-gray-200">Abstract/Introduction</label>
        <textarea name="abstract" id="abstract" cols="0" rows="5" class="block w-full px-4 py-2 sm:mt-2  border  rounded-md bg-gray-800 text-gray-300 border-gray-600 focus:border-white "></textarea>
    </div>
    <div class="mt-2">
        <label for="document" class="text-gray-200">File <span class="text-sm text-gray-400">(PDF ONLY, Limit: 5MB)</span></label>
        <input type="file" name="document" id="document" accept="application/pdf" class="block w-full mt-2 px-2 py-2 bg-gray-800 border border-gray-600 rounded-md text-white file:py-1 file:px-2 file:rounded-full file:border-0 file:text-sm file:font-semibold file:bg-transparent file:text-white hover:file:bg-gray-700 hover:bg-gray-700">
    </div>
    <div class="mt-4 ">
        <label class="text-gray-200">Description</label>
        <input id="" type="text" name="description" class="block w-full px-4 py-2 mt-2  border  rounded-md bg-gray-800 text-gray-300 border-gray-600 focus:border-white ">
    </div>
    <div class="mt-4 ">
        <label class="text-gray-200">APA Citation</label>
        <input id="citation-preview" type="text" name="citation" class="block w-full px-4 py-2 mt-2  border  rounded-md bg-gray-800 text-gray-300 border-gray-600 focus:border-white " readonly>
    </div>
    <div class="flex justify-center px-2 py-4">
        <button type="submit" class="px-12 py-2 leading-5 text-white transition-colors duration-200 transform bg-whitebg rounded-md hover:bg-gray-700 focus:outline-none focus:bg-gray-600">Save</button>
        <a href="/student/dashboard">
            <button type="button" class="ml-10 px-12 py-2 leading-5 text-white transition-colors duration-200 transform bg-whitebg rounded-md hover:bg-gray-700 focus:outline-none focus:bg-gray-600">Back</button>
        </a>
    </div>
</form>
</section>

<script>
// Function to capitalize the first letter of input value
function capitalizeFirstLetter(input) {
    input.value = input.value.charAt(0).toUpperCase() + input.value.slice(1).toLowerCase();
}

// Function to add a new author field
function addAuthor() {
    const container = document.getElementById('authors-container');
    const div = document.createElement('div');
    div.className = 'mb-1 flex items-center space-x-2';
    div.innerHTML = `
        <div class="bg-gray-600 w-full flex items-center space-x-1 p-2">
            <input type="text" name="firstnames[]" class="block w-full px-4 py-2 border rounded-md bg-gray-800 text-gray-300 border-gray-600 focus:border-white capitalize" placeholder="First Name" oninput="capitalizeFirstLetter(this)">
            <input type="text" name="lastnames[]" class="block w-full px-4 py-2 border rounded-md bg-gray-800 text-gray-300 border-gray-600 focus:border-white capitalize" placeholder="Last Name" oninput="capitalizeFirstLetter(this)">
            <button type="button" onclick="removeAuthor(this)" class="p-2 text-white rounded-md">
                <svg class="w-6 h-6 text-white hover:text-red-700" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="none" viewBox="0 0 24 24">
                    <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 7h14m-9 3v8m4-8v8M10 3h4a1 1 0 0 1 1 1v3H9V4a1 1 0 0 1 1-1ZM6 7h12v13a1 1 0 0 1-1 1H7a1 1 0 0 1-1-1V7Z"/>
                </svg>
            </button>
        </div>

    `;
    container.appendChild(div);
    updateCitation();  // Update the citation after adding a new author
}

// Function to remove an author field
function removeAuthor(button) {
    const authorField = button.parentElement;
    authorField.remove();
    updateCitation();  // Update the citation after removing an author
}

// Function to update the APA citation
function updateCitation() {
    const form = document.forms['citation-form'];
    const firstnames = Array.from(form.querySelectorAll('input[name="firstnames[]"]')).map(input => input.value.trim());
    const lastnames = Array.from(form.querySelectorAll('input[name="lastnames[]"]')).map(input => input.value.trim());
    const title = form['title'].value;
    const year = form['year'].value;

    let citation = '';
    if (firstnames.length && lastnames.length) {
        const authors = firstnames.map((firstname, i) => `${lastnames[i]}, ${firstname.charAt(0).toUpperCase()}.`);
        citation = `${authors.join(', ')} (${year}). ${title}. Published research.`;
    }
    document.getElementById('citation-preview').value = citation;

    let members = firstnames.map((firstname, i) => `${firstname} ${lastnames[i]}`).join(', ');

    // Update the members-preview textarea
    document.getElementById('members-preview').value = members;
}

document.getElementById('citation-form').addEventListener('input', updateCitation);


// Auto-close error modal after 3 seconds
const errorModal = document.getElementById('errorModalOverlay');
if (errorModal) {
    setTimeout(() => {
        errorModal.style.display = 'none';
    }, 3000);
}

// Manual close button for the modal
document.getElementById('closeErrorModal').addEventListener('click', () => {
    errorModal.style.display = 'none';
});
</script>


<script src="/js/modal.js"></script>
@extends('partials.footer')
