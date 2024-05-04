
<div class="bg-gray-400 min-h-screen pt-12 pb-6 px-2">
    <div class="bg-white max-w-lg mx-auto p-8 my-10 rounded lg-shadow-2xl">
        @if ($error = \Session::get('error'))
            {{$error}}
        @endif
        <form action="{{route('admin.login')}}" method="POST">
            @csrf
            <h1 class="text-center font-bold text-lg">Admin Login</h1>
            <div class="bg-gray-300 mt-3">
                <label for="email">Email</label>
                <input name="email" type="email" class="bg-gray-300 border-b-4 border-indigo-500 w-full">
                @error('email'){{$message}}@enderror
            </div>
            <div class="bg-gray-300 mt-3">
                <label for="password">Password</label>
                <input name="password" type="password" class="bg-gray-300 border-b-4 border-indigo-500 w-full">
                @error('password'){{$message}}@enderror
            </div>
            
            <div class="mt-3">
                <button type="submit" class="bg-sky-300 border-4 border-indigo-900 w-full pt-2">Login</button>
            </div>

        </form>
    </div>
</div>