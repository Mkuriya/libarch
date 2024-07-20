@include('partials.header')
  <div id="side-menu" class="fixed top-0 right-[-250px] w-[240px] h-screen z-50 bg-whitebg p-5
  flex flex-col space-y-5 text-white duration-300">
  <div class="grid grid-cols-4 gap-4 ">
    <div class=" grid-rows-2 col-span-3">
        <div class="text-xl ">{{auth()->guard('student')->user()->firstname}}</div>
        <div class="text-xs">{{auth()->guard('student')->user()->email}}</div>
    </div>
    
    <div class=" "><a href="javascript:void(0)" class="text-right float-right text-3xl" onclick="closeMenu()">&times; </a></div>
  </div>
      <hr>
      <a href="/student/dashboard/profile/{{auth()->guard('student')->user()->id}} "class="hover:text-amber-500">My Profile</a>
      <hr>
      <a class="hover:text-amber-500" href="/student/dashboard/archivelist">Archive List</a>
      <a class="hover:text-amber-500" href="/student/dashboard/search">Search</a>
      <a class="hover:text-amber-500" href="/student/dashboard/upload">Upload</a>
      <hr>
      <a class="hover:text-amber-500"><form action="/student/logout" method="POST">
        @csrf
        <button class="text-l w-full text-left" onclick="return confirm('Are you sure want to logout?');">Logout</button>
    </form></a>
  </div>

  <main class="h-12 bg-muted-dark pt-1">
      <!-- This is used to open the menu -->
      <span class="text-2xl pl-5 text-white">
        <a href="/student/dashboard">Libarch</a>
      </span>
        <span class="cursor-pointer text-2xl absolute right-0 mr-8 pt-1 " onclick="openMenu()"> 
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
      function openMenu() {
          sideMenu.classList.remove('right-[-250px]');
          sideMenu.classList.add('right-0');
      }

      function closeMenu() {
          sideMenu.classList.remove('right-0');
          sideMenu.classList.add('right-[-250px]');
      }
  </script>