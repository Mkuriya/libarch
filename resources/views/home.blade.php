@extends('partials.header')

<div class="login text-black flex min-h-screen flex-col items-center pt-16 sm:justify-center sm:pt-0 ">
    <div class="relative mt-12 w-full max-w-lg sm:mt-10">
        <div class="holder  mx-5 border dark:border-b-white/50 dark:border-t-white/50 border-b-white/20 sm:border-t-white/20 shadow-[20px_0_20px_20px]
        shadow-slate-500/10 dark:shadow-white/20 rounded-lg border-white/20 border-l-white/20 border-r-white/20 sm:shadow-sm lg:rounded-xl 
        lg:shadow-none">
            <div class="flex flex-col p-6">
                <h3 class="text-3xl font-semibold leading-6 tracking-tighter text-center">LOGIN</h3>
            </div>
            <div class="grid grid-cols-2 gap-4 ">
                <a href="/student/login" class="no-underline text-black"><div class="text-center  bg-gray-200 rounded-full text-l mx-3 py-2 hover:bg-muted-dark hover:text-white">Student</div></a>
                <a href="/admin/login" class="no-underline text-black"><div class="text-center bg-gray-200 rounded-full text-l mx-3 py-2 hover:bg-muted-dark hover:text-white">Admin</div></a>
              </div>
            <div class="p-6 pt-0 mt-4">
                <form>
                    <div>
                        <div class="group relative rounded-lg border border-black focus-within:border-black px-3 pb-1.5 pt-2.5 duration-200 focus-within:ring focus-within:ring-black">
                            <div class="flex justify-between">
                                <label class="text-xs font-medium text-muted-foreground group-focus-within:text-black text-black">Username</label>
                            </div>
                            <input type="text" name="username" placeholder="Enter you email" disabled
                            class="block w-full border-0 bg-transparent p-0 text-sm file:my-1 file:rounded-full file:border-0
                             file:bg-accent file:px-4 file:py-2 file:font-medium placeholder:text-gray-800 
                             focus:outline-none focus:ring-0 sm:leading-7 ">
                        </div>
                    </div>
                    <div class="mt-4">
                        <div>
                            <div
                                class="group relative rounded-lg border border-black focus-within:border-black px-3 pb-1.5 pt-2.5 duration-200 focus-within:ring focus-within:ring-black">
                                <div class="flex justify-between">
                                    <label
                                        class="text-xs font-medium text-muted-foreground group-focus-within:text-white text-black">Password</label>
                                </div>
                                <div class="flex items-center">
                                    <input disabled type="password" name="password" placeholder="Enter your password" class="block w-full border-0 bg-transparent p-0 text-sm file:my-1 placeholder:text-gray-800 focus:outline-none focus:ring-0 focus:ring-teal-500 sm:leading-7 text-foreground">
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="mt-4 flex items-center justify-between">
                {{--}}    <label class="flex items-center gap-2">
                            <input type="checkbox" name="remember"
                                class="outline-none focus:outline focus:outline-sky-300">
                            <span class="text-xs">Remember me</span>
                        </label> --}}
                        <a class="text-sm font-medium text-black underline" href="/">Forgot
                            password?</a>
                    </div>
                    <div class="mt-4 flex items-center justify-center gap-x-2">
                        <button class="font-semibold hover:bg-black hover:text-white hover:ring hover:ring-black border-black transition 
                        duration-300 inline-flex items-center justify-center rounded-md text-sm focus-visible:outline-none 
                        focus-visible:ring-2 focus-visible:ring-offset-2 disabled:pointer-events-none disabled:opacity-50 
                        bg-white text-black h-10 px-4 py-2 w-48 "
                            type="submit" disabled>Log in</button>
                    </div>
                </form>
            </div>
        </div> 
    </div>
</div>

{{--}}
<div class="bg-gray-500 h-2/3 w-96 grid place-items-center ">
    <h1>Admin Login</h1>
    <form action="/admin/loginprocess" method="POST">
        @csrf
        <label for="email">Email</label> 
        <input name="email" type="email"><br>
        <label for="password">Password</label> 
        <input name="password" type="password"><br>
        <button>Login</button>
    </form>
</div>
--}}

@extends('partials.footer'){{--
<a href="/student/login"><button>student Login</button></a>
<a href="/admin/login"><button>Admin Login</button></a>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>sidebar</title>
  <script src="https://cdn.tailwindcss.com"></script>
  <!-- <script src="./tailwind3.js"></script> -->
  <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@200;300;400;500;600;800&display=swap"
    rel="stylesheet">
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.7.2/font/bootstrap-icons.css">
</head>
<body>
    <!-- The menu here -->
    <div id="side-menu" class="fixed top-0 right-[-250px] w-[240px] h-screen z-50 bg-gray-700 p-5
    flex flex-col space-y-5 text-white duration-300">
        <a href="javascript:void(0)" class="text-right text-4xl" onclick="closeMenu()">&times;</a>
        <a class="hover:text-amber-500" href="#">Home</a>
        <a class="hover:text-amber-500" href="#">About KindaCode.com</a>
        <a class="hover:text-amber-500" href="#">Contact Us</a>
        <a class="hover:text-amber-500" href="#">Terms of Service</a>
        <a class="hover:text-amber-500" href="#">Privacy Policy</a>
    </div>

    <main class="p-5 bg-gray-400">
        <!-- This is used to open the menu -->
        <span class="cursor-pointer text-4xl  bg-red-400" onclick="openMenu()">&#9776; Open Menu</span>
        <h1 class="mt-5 text-xl font-light italic bg-sky-400">Side Menu Example - KindaCode.com</h1>
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

</body>

</html>--}}