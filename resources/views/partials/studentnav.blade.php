@include('partials.header')

<!-- Side Menu -->
<div id="side-menu" class="fixed top-0 right-[-250px] w-[240px] h-screen z-50 bg-whitebg p-5 flex flex-col space-y-5 text-white duration-300">
    <div class="grid grid-cols-4 gap-4">
        <div class="grid-rows-2 col-span-3">
            <div class="text-xl">{{ auth()->guard('student')->user()->firstname }}</div>
            <div class="text-xs">{{ auth()->guard('student')->user()->email }}</div>
        </div>
        <div>
            <a href="javascript:void(0)" class="text-right float-right text-3xl" onclick="closeMenu()">&times;</a>
        </div>
    </div>
    <hr>
    <a href="/student/dashboard/profile/{{ auth()->guard('student')->user()->id }}" class="hover:text-amber-500">My Profile</a>
    <hr>
    <a class="hover:text-amber-500" href="/student/dashboard/archivelist">Archive List</a>
    <a class="hover:text-amber-500" href="/student/dashboard/search">Search</a>
    <a class="hover:text-amber-500" href="/student/dashboard/upload">Upload</a>
    <hr>
    
    <!-- History Button -->
    <a class="hover:text-amber-500 cursor-pointer" onclick="toggleHistory()">History</a>
    
    <!-- History Content -->
    @if (auth()->guard('student')->check())
        @php
            $hasHistory = false;
        @endphp

          <div id="history-content" class="hidden max-h-[200px] overflow-y-auto mt-2 p-2 bg-whitebg text-white">
            @forelse ($history as $record)
                @if ($record->student_id == auth()->guard('student')->user()->id)
                    @php
                        $hasHistory = true;
                    @endphp
                    <div class="flex items-center justify-between mb-2">
                        
                        <a href="/student/dashboard/history/{{$record->document->id}}">
                            <button class=" document-view-btn truncate max-w-36 ...">
                                {{ $record->document->title }}
                            </button>
                        </a>
                        
                        
                        <!-- Delete Form -->
                        <form action="{{ route('history.destroy', $record->id) }}" method="POST" class="ml-2">
                            @csrf
                            @method('DELETE')
                            <button type="submit" >
                              <svg class="w-6 h-6 text-gray-800 dark:text-white" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="none" viewBox="0 0 24 24">
                                <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 7h14m-9 3v8m4-8v8M10 3h4a1 1 0 0 1 1 1v3H9V4a1 1 0 0 1 1-1ZM6 7h12v13a1 1 0 0 1-1 1H7a1 1 0 0 1-1-1V7Z"/>
                              </svg>
                            </button>
                        </form>
                    </div>
                @endif
            @empty
                <p>No history available.</p>
            @endforelse

            @if (!$hasHistory && $history->isNotEmpty())
                <p>No history available.</p>
            @endif
          </div>

    @endif



    <hr>
    <a class="hover:text-amber-500">
        <form action="/student/logout" method="POST">
            @csrf
            <button class="text-l w-full text-left" onclick="return confirm('Are you sure you want to logout?');">Logout</button>
        </form>
    </a>
</div>

<main class="h-12 bg-muted-dark pt-1">
    <!-- This is used to open the menu -->
    <span class="text-2xl pl-5 text-white">
        <a href="/student/dashboard">Libarch</a>
    </span>
    <span class="cursor-pointer text-2xl absolute right-0 mr-8 pt-1" onclick="openMenu()">
        @if (auth()->guard('student')->check() && auth()->guard('student')->user()->photo)
            <img src="{{ asset('storage/' . auth()->guard('student')->user()->photo) }}" class="rounded-full h-8 w-8 object-cover">
        @else
            <h1>{{ auth()->guard('student')->user()->firstname }}</h1>
        @endif
    </span>
</main>

<!-- Javascript code -->
<script>
    var sideMenu = document.getElementById('side-menu');
    var historyContent = document.getElementById('history-content');

    function openMenu() {
        sideMenu.classList.remove('right-[-250px]');
        sideMenu.classList.add('right-0');
    }

    function closeMenu() {
        sideMenu.classList.remove('right-0');
        sideMenu.classList.add('right-[-250px]');
    }

    function toggleHistory() {
        if (historyContent.classList.contains('hidden')) {
            historyContent.classList.remove('hidden');
        } else {
            historyContent.classList.add('hidden');
        }
    }

    document.addEventListener('DOMContentLoaded', function() {
    document.querySelectorAll('form[action^="/student/dashboard/history/"]').forEach(function(form) {
        form.addEventListener('submit', function(e) {
            e.preventDefault();
            var form = this;
            if (confirm('Are you sure you want to delete this history record?')) {
                fetch(form.action, {
                    method: 'DELETE',
                    headers: {
                        'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
                    }
                }).then(response => response.json())
                  .then(data => {
                      if (data.success) {
                          form.closest('div').remove(); // Remove the record from the DOM
                      } else {
                          alert('Failed to delete record.');
                      }
                  });
            }
        });
    });
});
document.addEventListener('DOMContentLoaded', () => {
    const viewButtons = document.querySelectorAll('.document-view-btn');
    viewButtons.forEach(button => {
        button.addEventListener('click', () => {
            const url = button.getAttribute('data-url');
            const title = button.getAttribute('data-title');
            
            // Update the document view area with the selected document
            document.getElementById('document-title').textContent = title;
            document.getElementById('document-iframe').src = url + '#toolbar=0'; // Ensure the URL is correct
        });
    });
});



</script>
