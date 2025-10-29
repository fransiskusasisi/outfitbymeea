<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login - Outfitbymee</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap');
        
        body {
            font-family: 'Poppins', sans-serif;
        }
        
        .gradient-bg {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
        }
        
        .glass-effect {
            background: rgba(255, 255, 255, 0.95);
            backdrop-filter: blur(10px);
            border: 1px solid rgba(255, 255, 255, 0.2);
        }
        
        .input-focus:focus {
            border-color: #667eea;
            box-shadow: 0 0 0 3px rgba(102, 126, 234, 0.1);
        }
    </style>
</head>
<body class="gradient-bg min-h-screen flex items-center justify-center p-4">
    
    <!-- Decorative Elements -->
    <div class="absolute inset-0 overflow-hidden pointer-events-none">
        <div class="absolute -top-40 -right-40 w-80 h-80 bg-purple-300 rounded-full mix-blend-multiply filter blur-xl opacity-70 animate-pulse"></div>
        <div class="absolute -bottom-40 -left-40 w-80 h-80 bg-pink-300 rounded-full mix-blend-multiply filter blur-xl opacity-70 animate-pulse"></div>
    </div>

    <!-- Login Container -->
    <div class="glass-effect rounded-3xl shadow-2xl w-full max-w-md p-8 relative z-10">
        
        <!-- Logo -->
        <div class="flex justify-center mb-8">
            <div class="w-24 h-24 border-4 border-purple-600 flex items-center justify-center rounded-2xl shadow-lg bg-white overflow-hidden">
                <img src="{{ asset('images/logo.png') }}" alt="Logo Outfitbymee" class="object-contain w-full h-full">
            </div>
        </div>

        <!-- Title -->
        <div class="text-center mb-8">
            <h1 class="text-3xl font-bold text-gray-800 mb-2">Selamat Datang!</h1>
            <p class="text-gray-600">Masuk ke akun Outfitbymee Anda</p>
        </div>

        <!-- Error Message -->
        @if($errors->any())
        <div class="bg-red-50 border-l-4 border-red-500 p-4 mb-6 rounded-lg">
            <div class="flex">
                <div class="flex-shrink-0">
                    <svg class="h-5 w-5 text-red-500" fill="currentColor" viewBox="0 0 20 20">
                        <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zM8.707 7.293a1 1 0 00-1.414 1.414L8.586 10l-1.293 1.293a1 1 0 101.414 1.414L10 11.414l1.293 1.293a1 1 0 001.414-1.414L11.414 10l1.293-1.293a1 1 0 00-1.414-1.414L10 8.586 8.707 7.293z" clip-rule="evenodd"/>
                    </svg>
                </div>
                <div class="ml-3">
                    <p class="text-sm text-red-700 font-medium">{{ $errors->first() }}</p>
                </div>
            </div>
        </div>
        @endif

        <!-- Login Form -->
        <form action="{{ route('login') }}" method="POST" class="space-y-6">
            @csrf
            
            <!-- Username Input -->
            <div>
                <label for="username" class="block text-sm font-semibold text-gray-700 mb-2">Username</label>
                <div class="relative">
                    <div class="absolute inset-y-0 left-0 pl-4 flex items-center pointer-events-none">
                        <svg class="h-5 w-5 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"/>
                        </svg>
                    </div>
                    <input 
                        type="text" 
                        id="username" 
                        name="username" 
                        required
                        class="input-focus w-full pl-12 pr-4 py-3 border-2 border-gray-200 rounded-xl focus:outline-none transition-all duration-300"
                        placeholder="Masukkan username"
                        value="{{ old('username') }}"
                    >
                </div>
            </div>

            <!-- Password Input -->
            <div>
                <label for="password" class="block text-sm font-semibold text-gray-700 mb-2">Password</label>
                <div class="relative">
                    <div class="absolute inset-y-0 left-0 pl-4 flex items-center pointer-events-none">
                        <svg class="h-5 w-5 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z"/>
                        </svg>
                    </div>
                    <input 
                        type="password" 
                        id="password" 
                        name="password" 
                        required
                        class="input-focus w-full pl-12 pr-12 py-3 border-2 border-gray-200 rounded-xl focus:outline-none transition-all duration-300"
                        placeholder="Masukkan password"
                    >
                    <button type="button" id="togglePassword" class="absolute inset-y-0 right-0 pr-4 flex items-center text-gray-400 hover:text-purple-600">
                        <svg id="eyeIcon" xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" 
                                  d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"/>
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" 
                                  d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"/>
                        </svg>
                    </button>
                </div>
            </div>

       
            <!-- Login Button -->
            <button 
                type="submit" 
                class="w-full bg-gradient-to-r from-purple-600 to-indigo-600 text-white font-semibold py-3 rounded-xl hover:from-purple-700 hover:to-indigo-700 transform hover:scale-105 transition-all duration-300 shadow-lg hover:shadow-xl"
            >
                Masuk
            </button>
        </form>

        <!-- Footer -->
        <div class="mt-8 text-center">
            <p class="text-sm text-gray-600">
                &copy; 2024 Outfitbymee. All rights reserved.
            </p>
        </div>
    </div>

    <!-- Toggle Password Script -->
    <script>
        const togglePassword = document.getElementById('togglePassword');
        const passwordInput = document.getElementById('password');
        const eyeIcon = document.getElementById('eyeIcon');

        togglePassword.addEventListener('click', function() {
            const isPassword = passwordInput.type === 'password';
            passwordInput.type = isPassword ? 'text' : 'password';
            eyeIcon.innerHTML = isPassword 
                ? '<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13.875 18.825A10.05 10.05 0 0112 19c-4.478 0-8.268-2.943-9.542-7a9.97 9.97 0 012.17-3.482M15 12a3 3 0 01-6 0m9.707 9.707L4.293 4.293" />'
                : '<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"/><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"/>';
        });
    </script>

</body>
</html>
