@include('partials.studentnav')
@if (session('success'))
    <div id="modal" class="fixed inset-0 flex items-center justify-center z-50">
        <div class="bg-gray-700 p-6 rounded shadow-lg max-w-md w-full">
            <div class="text-center text-2xl text-white">
                <p>{{ session('success') }}</p>
            </div>
            <div class="text-center mt-4">
                <button id="close-modal" class="text-white text-lg bg-whitebg px-16 py-1 rounded-full">Close</button>
            </div>
        </div>
    </div>
    <div id="modal-overlay" class="fixed inset-0 bg-black opacity-50 z-40"></div>
@endif

<div class="bg-red-300 relative">
  <p class="absolute  w-full sm:w-3/4 px-4 text-3xl md:text-4xl leading-8 text-center text-white top-20 md:top-[150px] left-1/2 transform -translate-x-1/2">
      Welcome! How may I assist you today? Whether you have a question, need some information, or just want to see research, I'm here to help.
  </p>
</div>
<div class="flex justify-center items-center mt-20 h-5/6"> 
  <div class="flex justify-center  mt-6 w-full sm:w-1/2   ">
    <div class=" flex justify-center w-full sm:w-1/2 sm:px-16">
    <a href="/student/dashboard/upload"class=" w-[200px] h-[65px]  flex justify-center item-center">
      <button type="button" class=" w-full h-full text-white bg-whitebg hover:bg-gray-700  font-medium rounded-lg text-xl px-5 py-2.5 text-center inline-flex items-center focus:ring-[#3b5998]/55 me-2 mb-2">
        Upload 
        <svg class="w-7 h-7 ml-12 ttext-white" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="none" viewBox="0 0 24 24">
          <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 5v9m-5 0H5a1 1 0 0 0-1 1v4a1 1 0 0 0 1 1h14a1 1 0 0 0 1-1v-4a1 1 0 0 0-1-1h-2M8 9l4-5 4 5m1 8h.01"/>
        </svg>
      </button>
    </a>
    </div>
    <div class=" flex justify-center w-full sm:w-1/2 sm:px-16">
    <a href="/student/dashboard/search"class=" w-[200px] h-[65px]  flex justify-center item-center">
      <button type="button" class=" w-full h-full text-white bg-whitebg hover:bg-gray-700  font-medium rounded-lg text-xl px-5 py-2.5 text-center inline-flex items-center focus:ring-[#3b5998]/55 me-2 mb-2">
        Search 
        <svg class="w-6 h-6 ml-12 text-white" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="none" viewBox="0 0 24 24">
          <path stroke="currentColor" stroke-linecap="round" stroke-width="2" d="m21 21-3.5-3.5M17 10a7 7 0 1 1-14 0 7 7 0 0 1 14 0Z"/>
        </svg>
      </button>
    </a>
  </div>
  </div>
</div>
<script>
   document.addEventListener('DOMContentLoaded', function() {
        // Show the modal
        const modal = document.getElementById('modal');
        const modalOverlay = document.getElementById('modal-overlay');
        const closeModalButton = document.getElementById('close-modal');

        // Automatically close the modal after 5 seconds
        setTimeout(function() {
            closeModal();
        }, 3000);

        // Close modal function
        function closeModal() {
            modal.classList.add('hidden');
            modalOverlay.classList.add('hidden');
        }

        // Close modal when the close button is clicked
        closeModalButton.addEventListener('click', function() {
            closeModal();
        });
    });
  </script>
@extends('partials.footer')