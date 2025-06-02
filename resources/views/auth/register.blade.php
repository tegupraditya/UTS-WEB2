<x-auth-layout title="Register" section-title="SkillTrade" section-description="Create your account to start trading skills">
    <form action="{{ route('auth.store') }}" method="POST" class="space-y-6 mt-6">
        @csrf
        {{-- @method("POST") --}} {{-- Ini tidak diperlukan karena method="POST" sudah ada di tag form --}}

        <div class="space-y-2">
            <label for="name" class="block text-sm font-semibold text-gray-700 tracking-wide">
                Full Name
            </label>
            <div class="relative">
                <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                    <svg class="h-5 w-5 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"></path>
                    </svg>
                </div>
                <input type="text" id="name" name="name"
                       class="block w-full pl-10 pr-3 py-3 border border-gray-300 rounded-lg bg-gray-50 focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition-all duration-200 placeholder-gray-400 @error('name') border-red-500 bg-red-50 @enderror"
                       placeholder="Enter your full name" 
                       value="{{ old('name') }}"
                       required>
            </div>
            @error('name')
                <div class="bg-gradient-to-r from-red-50 to-pink-50 border-l-4 border-red-500 text-red-700 px-3 py-2 rounded-lg text-sm animate-shake">
                    <div class="flex items-center">
                        <svg class="w-4 h-4 mr-2" fill="currentColor" viewBox="0 0 20 20">
                            <path fill-rule="evenodd" d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7 4a1 1 0 11-2 0 1 1 0 012 0zm-1-9a1 1 0 00-1 1v4a1 1 0 102 0V6a1 1 0 00-1-1z" clip-rule="evenodd"></path>
                        </svg>
                        {{ $message }}
                    </div>
                </div>
            @enderror
        </div>

        <div class="space-y-2">
            <label for="email" class="block text-sm font-semibold text-gray-700 tracking-wide">
                Email Address
            </label>
            <div class="relative">
                <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                    <svg class="h-5 w-5 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 12a4 4 0 10-8 0 4 4 0 008 0zm0 0v1.5a2.5 2.5 0 005 0V12a9 9 0 10-9 9m4.5-1.206a8.959 8.959 0 01-4.5 1.207"></path>
                    </svg>
                </div>
                <input type="email" id="email" name="email"
                       class="block w-full pl-10 pr-3 py-3 border border-gray-300 rounded-lg bg-gray-50 focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition-all duration-200 placeholder-gray-400 @error('email') border-red-500 bg-red-50 @enderror"
                       placeholder="Enter your email address" 
                       value="{{ old('email') }}"
                       required>
            </div>
            @error('email')
                <div class="bg-gradient-to-r from-red-50 to-pink-50 border-l-4 border-red-500 text-red-700 px-3 py-2 rounded-lg text-sm animate-shake">
                    <div class="flex items-center">
                        <svg class="w-4 h-4 mr-2" fill="currentColor" viewBox="0 0 20 20">
                            <path fill-rule="evenodd" d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7 4a1 1 0 11-2 0 1 1 0 012 0zm-1-9a1 1 0 00-1 1v4a1 1 0 102 0V6a1 1 0 00-1-1z" clip-rule="evenodd"></path>
                        </svg>
                        {{ $message }}
                    </div>
                </div>
            @enderror
        </div>

        <div class="space-y-2">
            <label for="password" class="block text-sm font-semibold text-gray-700 tracking-wide">
                Password
            </label>
            <div class="relative">
                <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                    <svg class="h-5 w-5 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z"></path>
                    </svg>
                </div>
                <input type="password" id="password" name="password"
                       class="block w-full pl-10 pr-12 py-3 border border-gray-300 rounded-lg bg-gray-50 focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition-all duration-200 placeholder-gray-400 @error('password') border-red-500 bg-red-50 @enderror"
                       placeholder="Create a strong password"
                       required>
                <button type="button" onclick="togglePassword('password')" class="absolute inset-y-0 right-0 pr-3 flex items-center">
                    <svg id="password-eye-open" class="h-5 w-5 text-gray-400 hover:text-gray-600 transition-colors" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path>
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"></path>
                    </svg>
                    <svg id="password-eye-closed" class="h-5 w-5 text-gray-400 hover:text-gray-600 transition-colors hidden" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13.875 18.825A10.05 10.05 0 0112 19c-4.478 0-8.268-2.943-9.543-7a9.97 9.97 0 011.563-3.029m5.858.908a3 3 0 114.243 4.243M9.878 9.878l4.242 4.242M9.878 9.878L3 3m6.878 6.878L21 21"></path>
                    </svg>
                </button>
            </div>
            <div class="mt-2">
                <div class="flex space-x-1">
                    <div id="strength-1" class="h-1 w-1/4 bg-gray-200 rounded transition-colors"></div>
                    <div id="strength-2" class="h-1 w-1/4 bg-gray-200 rounded transition-colors"></div>
                    <div id="strength-3" class="h-1 w-1/4 bg-gray-200 rounded transition-colors"></div>
                    <div id="strength-4" class="h-1 w-1/4 bg-gray-200 rounded transition-colors"></div>
                </div>
                <p id="strength-text" class="text-xs text-gray-500 mt-1">Password strength: Weak</p>
            </div>
            @error('password')
                <div class="bg-gradient-to-r from-red-50 to-pink-50 border-l-4 border-red-500 text-red-700 px-3 py-2 rounded-lg text-sm animate-shake">
                    <div class="flex items-center">
                        <svg class="w-4 h-4 mr-2" fill="currentColor" viewBox="0 0 20 20">
                            <path fill-rule="evenodd" d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7 4a1 1 0 11-2 0 1 1 0 012 0zm-1-9a1 1 0 00-1 1v4a1 1 0 102 0V6a1 1 0 00-1-1z" clip-rule="evenodd"></path>
                        </svg>
                        {{ $message }}
                    </div>
                </div>
            @enderror
        </div>

        <div class="space-y-2">
            <label for="password_confirmation" class="block text-sm font-semibold text-gray-700 tracking-wide">
                Confirm Password
            </label>
            <div class="relative">
                <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                    <svg class="h-5 w-5 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                    </svg>
                </div>
                <input type="password" id="password_confirmation" name="password_confirmation"  {{-- PERBAIKAN: id dan name diubah --}}
                       class="block w-full pl-10 pr-12 py-3 border border-gray-300 rounded-lg bg-gray-50 focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition-all duration-200 placeholder-gray-400"
                       placeholder="Confirm your password"
                       required>
                <button type="button" onclick="togglePassword('password_confirmation')" class="absolute inset-y-0 right-0 pr-3 flex items-center"> {{-- PERBAIKAN: onclick target ID --}}
                    {{-- ID untuk ikon mata di field confirm password juga disesuaikan agar unik --}}
                    <svg id="password_confirmation-eye-open" class="h-5 w-5 text-gray-400 hover:text-gray-600 transition-colors" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path>
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"></path>
                    </svg>
                    <svg id="password_confirmation-eye-closed" class="h-5 w-5 text-gray-400 hover:text-gray-600 transition-colors hidden" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13.875 18.825A10.05 10.05 0 0112 19c-4.478 0-8.268-2.943-9.543-7a9.97 9.97 0 011.563-3.029m5.858.908a3 3 0 114.243 4.243M9.878 9.878l4.242 4.242M9.878 9.878L3 3m6.878 6.878L21 21"></path>
                    </svg>
                </button>
            </div>
            <div id="password-match-indicator" class="hidden mt-1"> {{-- ID diubah agar lebih unik jika ada beberapa indikator --}}
                <div class="flex items-center text-sm">
                    <svg id="match-check-icon" class="w-4 h-4 mr-2 text-green-500 hidden" fill="currentColor" viewBox="0 0 20 20"> {{-- ID diubah --}}
                        <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"></path>
                    </svg>
                    <svg id="match-cross-icon" class="w-4 h-4 mr-2 text-red-500 hidden" fill="currentColor" viewBox="0 0 20 20"> {{-- ID diubah --}}
                        <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zM8.707 7.293a1 1 0 00-1.414 1.414L8.586 10l-1.293 1.293a1 1 0 101.414 1.414L10 11.414l1.293 1.293a1 1 0 001.414-1.414L11.414 10l1.293-1.293a1 1 0 00-1.414-1.414L10 8.586 8.707 7.293z" clip-rule="evenodd"></path>
                    </svg>
                    <span id="match-text-indicator" class="text-gray-600"></span> {{-- ID diubah --}}
                </div>
            </div>
            {{-- Error untuk password_confirmation (jika ada aturan validasi spesifik di backend selain 'confirmed') tidak akan ditampilkan oleh error 'password' --}}
            {{-- @error('password_confirmation') ... @enderror --}}
        </div>

        <div class="flex items-start">
            <div class="flex items-center h-5">
                <input id="terms" name="terms" type="checkbox" 
                       class="h-4 w-4 text-blue-600 focus:ring-blue-500 border-gray-300 rounded transition-colors" required>
            </div>
            <div class="ml-3 text-sm">
                <label for="terms" class="text-gray-700 cursor-pointer">
                    I agree to the 
                    <a href="#" class="font-medium text-blue-600 hover:text-blue-500 transition-colors">Terms and Conditions</a>
                    and 
                    <a href="#" class="font-medium text-blue-600 hover:text-blue-500 transition-colors">Privacy Policy</a>
                </label>
            </div>
        </div>

        <button type="submit" 
                class="group relative w-full flex justify-center py-3 px-4 border border-transparent text-sm font-medium rounded-lg text-white bg-gradient-to-r from-green-600 to-green-700 hover:from-green-700 hover:to-green-800 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-green-500 transition-all duration-200 transform hover:scale-[1.02] active:scale-[0.98] shadow-lg hover:shadow-xl">
            <span class="absolute left-0 inset-y-0 flex items-center pl-3">
                <svg class="h-5 w-5 text-green-300 group-hover:text-green-200 transition-colors" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M18 9v3m0 0v3m0-3h3m-3 0h-3m-2-5a4 4 0 11-8 0 4 4 0 018 0zM3 20a6 6 0 0112 0v1H3v-1z"></path>
                </svg>
            </span>
            Create your account
        </button>

        <div class="text-center">
            <p class="text-sm text-gray-600">
                Already have an account?
                <a href="{{ route('login') }}" 
                   class="font-semibold text-blue-600 hover:text-blue-500 transition-colors hover:underline">
                    Sign in here
                </a>
            </p>
        </div>

        <div class="mt-6">
            <div class="relative">
                <div class="absolute inset-0 flex items-center">
                    <div class="w-full border-t border-gray-300"></div>
                </div>
                <div class="relative flex justify-center text-sm">
                    <span class="px-2 bg-white text-gray-500">Or register with</span>
                </div>
            </div>

            <div class="mt-6 grid grid-cols-2 gap-3">
                <button type="button" 
                        class="w-full inline-flex justify-center py-2 px-4 border border-gray-300 rounded-lg shadow-sm bg-white text-sm font-medium text-gray-500 hover:bg-gray-50 transition-colors">
                    <svg class="h-5 w-5" viewBox="0 0 24 24">
                        <path fill="currentColor" d="M22.56 12.25c0-.78-.07-1.53-.2-2.25H12v4.26h5.92c-.26 1.37-1.04 2.53-2.21 3.31v2.77h3.57c2.08-1.92 3.28-4.74 3.28-8.09z"/>
                        <path fill="currentColor" d="M12 23c2.97 0 5.46-.98 7.28-2.66l-3.57-2.77c-.98.66-2.23 1.06-3.71 1.06-2.86 0-5.29-1.93-6.16-4.53H2.18v2.84C3.99 20.53 7.7 23 12 23z"/>
                        <path fill="currentColor" d="M5.84 14.09c-.22-.66-.35-1.36-.35-2.09s.13-1.43.35-2.09V7.07H2.18C1.43 8.55 1 10.22 1 12s.43 3.45 1.18 4.93l2.85-2.22.81-.62z"/>
                        <path fill="currentColor" d="M12 5.38c1.62 0 3.06.56 4.21 1.64l3.15-3.15C17.45 2.09 14.97 1 12 1 7.7 1 3.99 3.47 2.18 7.07l3.66 2.84c.87-2.6 3.3-4.53 6.16-4.53z"/>
                    </svg>
                    <span class="ml-2">Google</span>
                </button>

                <button type="button" 
                        class="w-full inline-flex justify-center py-2 px-4 border border-gray-300 rounded-lg shadow-sm bg-white text-sm font-medium text-gray-500 hover:bg-gray-50 transition-colors">
                    <svg class="h-5 w-5" fill="currentColor" viewBox="0 0 24 24">
                        <path d="M24 12.073c0-6.627-5.373-12-12-12s-12 5.373-12 12c0 5.99 4.388 10.954 10.125 11.854v-8.385H7.078v-3.47h3.047V9.43c0-3.007 1.792-4.669 4.533-4.669 1.312 0 2.686.235 2.686.235v2.953H15.83c-1.491 0-1.956.925-1.956 1.874v2.25h3.328l-.532 3.47h-2.796v8.385C19.612 23.027 24 18.062 24 12.073z"/>
                    </svg>
                    <span class="ml-2">Facebook</span>
                </button>
            </div>
        </div>
    </form>

    <script>
        // Password toggle functionality
        function togglePassword(fieldId) {
            const passwordInput = document.getElementById(fieldId);
            // Sesuaikan ID ikon mata berdasarkan fieldId
            const eyeOpen = document.getElementById(fieldId + '-eye-open'); 
            const eyeClosed = document.getElementById(fieldId + '-eye-closed');
            
            if (passwordInput.type === 'password') {
                passwordInput.type = 'text';
                if (eyeOpen) eyeOpen.classList.add('hidden');
                if (eyeClosed) eyeClosed.classList.remove('hidden');
            } else {
                passwordInput.type = 'password';
                if (eyeOpen) eyeOpen.classList.remove('hidden');
                if (eyeClosed) eyeClosed.classList.add('hidden');
            }
        }

        // Password strength checker
        function checkPasswordStrength(password) {
            let strength = 0;
            const checks = {
                length: password.length >= 8,
                lowercase: /[a-z]/.test(password),
                uppercase: /[A-Z]/.test(password),
                numbers: /\d/.test(password),
                special: /[!@#$%^&*(),.?":{}|<>]/.test(password) // Anda bisa sesuaikan karakter spesial ini
            };
            strength = Object.values(checks).filter(Boolean).length;
            return { score: strength, checks: checks };
        }

        // Update password strength indicator
        function updatePasswordStrengthVisuals() {
            const password = document.getElementById('password').value;
            const result = checkPasswordStrength(password);
            
            const strengthBars = [
                document.getElementById('strength-1'),
                document.getElementById('strength-2'),
                document.getElementById('strength-3'),
                document.getElementById('strength-4')
            ];
            const strengthText = document.getElementById('strength-text');
            
            strengthBars.forEach(bar => {
                if(bar) bar.className = 'h-1 w-1/4 bg-gray-200 rounded transition-colors';
            });
            
            const colors = ['bg-red-500', 'bg-orange-500', 'bg-yellow-500', 'bg-green-500'];
            const labels = ['Very Weak', 'Weak', 'Fair', 'Strong', 'Very Strong']; // index 0-4 for score, 5 for very strong
            
            let scoreIndex = Math.max(0, result.score -1); // score 1-5 -> index 0-4
            if (result.score === 5) scoreIndex = 3; // map score 5 to strongest color/label
            if (result.score > 0) { // Only color if there's some input
                for (let i = 0; i < result.score && i < 4; i++) {
                     if(strengthBars[i]) strengthBars[i].className = `h-1 w-1/4 ${colors[Math.min(i, 3)]} rounded transition-colors`;
                }
            }
            
            if(strengthText) {
                strengthText.textContent = `Password strength: ${labels[result.score] || 'Very Weak'}`;
                strengthText.className = `text-xs mt-1 ${result.score >= 4 ? 'text-green-600' : result.score >= 2 ? 'text-yellow-600' : 'text-red-600'}`;
                if (password.length === 0) {
                     strengthText.textContent = `Password strength: Weak`; // Reset to default if empty
                     strengthText.className = 'text-xs text-gray-500 mt-1';
                }
            }
        }

        // Check password match
        function checkPasswordMatchVisuals() {
            const passwordInput = document.getElementById('password');
            const confirmPasswordInput = document.getElementById('password_confirmation'); // PERBAIKAN: ID disesuaikan
            
            if (!passwordInput || !confirmPasswordInput) return; // Pastikan elemen ada

            const password = passwordInput.value;
            const confirmPassword = confirmPasswordInput.value;
            
            const matchIndicator = document.getElementById('password-match-indicator'); // ID Disesuaikan
            const matchCheck = document.getElementById('match-check-icon'); // ID Disesuaikan
            const matchCross = document.getElementById('match-cross-icon'); // ID Disesuaikan
            const matchText = document.getElementById('match-text-indicator'); // ID Disesuaikan

            if (!matchIndicator || !matchCheck || !matchCross || !matchText) return; // Pastikan elemen ada

            if (confirmPassword.length > 0) {
                matchIndicator.classList.remove('hidden');
                if (password === confirmPassword) {
                    matchCheck.classList.remove('hidden');
                    matchCross.classList.add('hidden');
                    matchText.textContent = 'Passwords match';
                    matchText.className = 'text-green-600';
                } else {
                    matchCheck.classList.add('hidden');
                    matchCross.classList.remove('hidden');
                    matchText.textContent = 'Passwords do not match';
                    matchText.className = 'text-red-600';
                }
            } else {
                matchIndicator.classList.add('hidden');
            }
        }

        // Event listeners
        const passwordField = document.getElementById('password');
        const confirmPasswordField = document.getElementById('password_confirmation'); // PERBAIKAN: ID disesuaikan

        if (passwordField) {
            passwordField.addEventListener('input', function() {
                updatePasswordStrengthVisuals();
                checkPasswordMatchVisuals();
            });
        }
        if (confirmPasswordField) {
            confirmPasswordField.addEventListener('input', checkPasswordMatchVisuals);
        }
        
        // Inisialisasi saat load jika ada old value
        document.addEventListener('DOMContentLoaded', function() {
            if (passwordField && passwordField.value.length > 0) {
                updatePasswordStrengthVisuals();
            }
            if (confirmPasswordField && confirmPasswordField.value.length > 0) {
                 checkPasswordMatchVisuals();
            }
        });


        // Add custom animations (opsional, jika belum ada di CSS global)
        // const style = document.createElement('style');
        // style.textContent = `
        //     @keyframes shake {
        //         0%, 100% { transform: translateX(0); }
        //         25% { transform: translateX(-5px); }
        //         75% { transform: translateX(5px); }
        //     }
            
        //     .animate-shake {
        //         animation: shake 0.5s ease-in-out;
        //     }
        // `;
        // document.head.appendChild(style);
    </script>
</x-auth-layout>
