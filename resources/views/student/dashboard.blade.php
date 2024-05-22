@include('partials.studentnav')

<div class="relative ">
    <div class="h-[90%] bg-back fixed left-0 right-0 bottom-0 mx-20 shadow-2xl ">
    </div>
    <div class="fixed left-0 right-0 bottom-0 ">
        <div class="max-w-2xl mx-auto bg-gray-700 border-2 border-gray-500 h-40 px-2 pb-4 rounded-[10px]">
            <div class=" flex justify-end">
                <a href="/student/dashboard"><button class="border border-white px-5 hover:bg-muted-dark hover:text-white mx-1 my-2 rounded-full">New Chat</button></a>
            </div>
            <div class="mb-5">  
                    <form class="max-w-2xl mx-auto  mx-[10px] my-2">   
                        <label for="default-search" class="mb-2 text-sm font-medium text-gray-900 sr-only dark:text-white">Search</label>
                        <div class="relative">
                            <div class="absolute inset-y-0 start-0 flex items-center ps-3 pointer-events-none">
                                <svg class="w-4 h-4 text-gray-500 dark:text-gray-400" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 20 20">
                                    <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m19 19-4-4m0-7A7 7 0 1 1 1 8a7 7 0 0 1 14 0Z"/>
                                </svg>
                            </div>
                            <input type="search" id="default-search" class="block w-full p-4 ps-10 text-sm text-gray-900 border border-gray-300 rounded-lg bg-white focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700 dark:border-white-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" placeholder="Message Box" required />
                            <button type="submit" class="text-white absolute end-2.5 bottom-2.5 bg-muted-dark hover:bg-muted-dark focus:ring-4 focus:outline-none focus:ring-black font-medium rounded-lg text-sm px-4 py-2 dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">
                                <svg width="30px" height="20px" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                                    <path fill-rule="evenodd" clip-rule="evenodd" d="M3.3938 2.20468C3.70395 1.96828 4.12324 1.93374 4.4679 2.1162L21.4679 11.1162C21.7953 11.2895 22 11.6296 22 12C22 12.3704 21.7953 12.7105 21.4679 12.8838L4.4679 21.8838C4.12324 22.0662 3.70395 22.0317 3.3938 21.7953C3.08365 21.5589 2.93922 21.1637 3.02382 20.7831L4.97561 12L3.02382 3.21692C2.93922 2.83623 3.08365 2.44109 3.3938 2.20468ZM6.80218 13L5.44596 19.103L16.9739 13H6.80218ZM16.9739 11H6.80218L5.44596 4.89699L16.9739 11Z" fill="#000000"/>
                                    </svg>
                            </button>
                        </div>
                    </form>
            </div>
        </div>
    </div>
</div>
@extends('partials.footer')
    