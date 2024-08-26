@extends('partials.header')
<div class="login text-black flex min-h-screen flex-col items-center pt-16 justify-center sm:justify-center sm:pt-0">
    <div class="relative mt-12 w-full max-w-lg sm:mt-10">
        <div id="login-container" class="holder mx-5 border  border-b-white/20 sm:border-t-white/20 shadow-[20px_0_20px_20px]
            shadow-slate-500/10 shadow-white/20 rounded-lg border-white/20 border-l-white/20 border-r-white/20 sm:shadow-sm lg:rounded-xl 
            lg:shadow-sm">
            <div class="flex flex-col p-6">
                <h3 class="text-3xl font-semibold leading-6 tracking-tighter text-center">LOGIN</h3>
            </div>
            <div class="grid grid-cols-2 gap-4 buttons-group">
                <a href="/student/login" class="no-underline text-white student-button">
                    <div class="text-center bg-whitebg rounded-full text-l mx-3 py-2 hover:bg-gray-700 hover:text-white">Student</div>
                </a>
                <a href="/admin/login" class="no-underline text-black admin-button">
                    <div class="text-center bg-gray-200 rounded-full text-l mx-3 py-2 hover:bg-gray-700 hover:text-white">Admin</div>
                </a>
            </div>
            <div class="p-6 pt-0 mt-4">
                <form id="login-form" action="/student/loginprocess" method="POST">
                    @csrf
                    <div>
                        <div class="group relative rounded-lg border border-black focus-within:border-black px-3 pb-1.5 pt-2.5 duration-200 focus-within:ring focus-within:ring-black">
                            <div class="flex justify-between">
                                <label class="text-xs font-medium text-muted-foreground group-focus-within:text-black text-black">Email</label>
                            </div>
                            <input type="text" name="email" placeholder="Enter your email" 
                                class="block w-full border-0 bg-transparent p-0 text-sm file:my-1 file:rounded-full file:border-0
                                file:bg-accent file:px-4 file:py-2 file:font-medium placeholder:text-gray-800 
                                focus:outline-none focus:ring-0 sm:leading-7">
                        </div>
                    </div>
                    <div class="mt-4">
                        <div class="group relative rounded-lg border border-black focus-within:border-black px-3 pb-1.5 pt-2.5 duration-200 focus-within:ring focus-within:ring-black">
                            <div class="flex justify-between">
                                <label class="text-xs font-medium text-muted-foreground group-focus-within:text-black text-black">Password</label>
                            </div>
                            <input type="password" name="password" placeholder="Enter your password" 
                                class="block w-full border-0 bg-transparent p-0 text-sm file:my-1 placeholder:text-gray-800 
                                focus:outline-none focus:ring-0 sm:leading-7 text-foreground">
                        </div>
                    </div>
                    <div class="mt-4 flex items-center justify-between">
                        <a class="text-sm font-medium text-black underline cursor-pointer" id="forgot-password-link">Forgot password?</a>
                    </div>
                    <div class="mt-4 flex items-center justify-center gap-x-2">
                        <button class="font-semibold hover:bg-gray-700 border-black transition duration-300 inline-flex items-center justify-center rounded-md text-sm focus-visible:outline-none 
                            focus-visible:ring-2 focus-visible:ring-offset-2 disabled:pointer-events-none disabled:opacity-50 
                            bg-whitebg text-white h-10 px-4 py-2 w-48" type="submit">Log in</button>
                    </div>
                </form>
            </div>
        </div>
        <div id="reset-container" class="holder mx-5 border  border-b-white/20 sm:border-t-white/20 shadow-[20px_0_20px_20px]
            shadow-slate-500/10 shadow-white/20 rounded-lg border-white/20 border-l-white/20 border-r-white/20 sm:shadow-sm lg:rounded-xl 
            lg:shadow-sm hidden">
            <div class="flex flex-col p-6">
                <h3 class="text-3xl font-semibold leading-6 tracking-tighter text-center">Reset Password</h3>
            </div>
            <!-- Password reset form -->
            <form id="reset-form" action="{{route('forget.password.post')}}" method="POST" class="">
                @csrf
                <div>
                    <div class="group relative rounded-lg border border-black focus-within:border-black mx-6 px-3 pb-1.5 pt-2.5 duration-200 focus-within:ring focus-within:ring-black">
                        <div class="flex justify-between">
                            <label class="text-xs font-medium text-muted-foreground group-focus-within:text-black text-black">Email</label>
                        </div>
                        <input type="text" name="email" placeholder="Enter your email to reset password" 
                            class="block w-full border-0 bg-transparent p-0 text-sm file:my-1 file:rounded-full file:border-0
                            file:bg-accent file:px-4 file:py-2 file:font-medium placeholder:text-gray-800 
                            focus:outline-none focus:ring-0 sm:leading-7">
                    </div>
                </div>
                <div class="my-4 flex items-center justify-center gap-x-2">
                    <button class="font-semibold hover:bg-gray-700 border-black transition duration-300 inline-flex items-center justify-center rounded-md text-sm focus-visible:outline-none 
                        focus-visible:ring-2 focus-visible:ring-offset-2 disabled:pointer-events-none disabled:opacity-50 
                        bg-whitebg text-white h-10 px-4 py-2 w-48" type="submit">Reset Password</button>
                    <button class="font-semibold hover:bg-gray-700 border-black transition duration-300 inline-flex items-center justify-center rounded-md text-sm focus-visible:outline-none 
                        focus-visible:ring-2 focus-visible:ring-offset-2 disabled:pointer-events-none disabled:opacity-50 
                        bg-gray-200 text-black hover:text-white h-10 px-4 py-2 w-48" id="back-to-login">Back to Login</button>
                </div>
            </form>
        </div>
    </div>
</div>
<div class="fixed bottom-4 right-4 z-50 w-96">
    @if(session('success'))
        <div class="bg-gray-200 p-4 rounded relative alert" role="alert">
            {{ session('success') }}
            <button type="button" class="absolute top-0 right-0 mt-2 mr-4 text-lg text-gray-600 hover:text-gray-800" onclick="this.parentElement.style.display='none';">&times;</button>
        </div>
    @elseif(session('error'))
        <div class="bg-whitebg p-4 rounded relative alert text-white" role="alert">
            {{ session('error') }}
            <button type="button" class="absolute top-0 right-0 mt-2 mr-4 text-lg text-white hover:text-gray-800" onclick="this.parentElement.style.display='none';">&times;</button>
        </div>
    @endif
</div>
<script>
    document.getElementById('forgot-password-link').addEventListener('click', function() {
        document.getElementById('login-container').classList.add('hidden');
        document.getElementById('reset-container').classList.remove('hidden');
    });

    document.getElementById('back-to-login').addEventListener('click', function(event) {
        event.preventDefault();
        document.getElementById('reset-container').classList.add('hidden');
        document.getElementById('login-container').classList.remove('hidden');
    });
</script>
@extends('partials.footer')
