{{-- This code is intended to be part of a Laravel Blade layout file --}}
{{-- Ensure Alpine.js is loaded, typically in your main app.blade.php or at the end of this file if it's self-contained --}}

@if (Request::route()->getName() != 'landing')
    <nav class="bg-white border-b border-gray-200 shadow-sm sticky top-0 z-50 backdrop-blur-sm bg-white/95">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex justify-between items-center h-16">
                <div class="flex items-center">
                    <div class="flex-shrink-0">
                        <a href="{{ route('landing') }}" class="flex items-center space-x-2 group">
                            <div class="bg-gradient-to-r from-blue-600 to-purple-600 rounded-xl p-2 group-hover:scale-105 transition-transform duration-200">
                                <svg class="w-8 h-8 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 10V3L4 14h7v7l9-11h-7z"></path>
                                </svg>
                            </div>
                            <span class="text-xl font-bold text-black">
                                SkillTrade
                            </span>
                        </a>
                    </div>
                    
                    <div class="hidden md:block ml-10">
                        <div class="flex items-baseline space-x-1">
                            @php
                                $navItems = [
                                    ['label' => 'Dashboard', 'route' => 'dashboard', 'icon' => 'M3 7v10a2 2 0 002 2h14a2 2 0 002-2V9a2 2 0 00-2-2H5a2 2 0 00-2 2v10'],
                                    ['label' => 'Skill', 'route' => 'skill-offers.index', 'icon' => 'M7 8h10M7 12h4m1 8l-4-4H5a2 2 0 01-2-2V6a2 2 0 012-2h14a2 2 0 012 2v8a2 2 0 01-2 2h-3l-4 4z'],
                                    // User Profile link is accessed via account dropdown
                                    ['label' => 'Matching', 'route' => 'matching.index', 'icon' => 'M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z'],
                                    ['label' => 'Transactions', 'route' => 'transactions.index.mine', 'icon' => 'M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z'], // Icon for transactions
                                    ['label' => 'Category', 'route' => 'categories.index', 'icon' => 'M19 11H5m14 0a2 2 0 012 2v6a2 2 0 01-2 2H5a2 2 0 01-2-2v-6a2 2 0 012-2m14 0V9a2 2 0 00-2-2M5 11V9a2 2 0 012-2m0 0V5a2 2 0 012-2h6a2 2 0 012 2v2M7 7h10'],
                                ];
                            @endphp

                            @foreach ($navItems as $item)
                                @php
                                    $currentRouteName = Request::route()->getName();
                                    $baseRoute = explode('.', $item['route'])[0]; 
                                    // For transactions.index.mine, baseRoute will be 'transactions'
                                    // For skill-offers.index, baseRoute will be 'skill-offers'
                                    $isActive = Str::startsWith($currentRouteName, $item['route']) || Str::startsWith($currentRouteName, $baseRoute . '.');
                                    if ($item['route'] === 'dashboard') { // Dashboard exact match
                                        $isActive = $currentRouteName === $item['route'];
                                    }
                                @endphp
                                <a href="{{ route($item['route']) }}"
                                   class="group relative flex items-center px-3 py-2 rounded-lg text-sm font-medium transition-all duration-200 {{ $isActive ? 'bg-blue-50 text-black font-semibold' : 'text-black hover:bg-gray-50' }}">
                                    
                                    <svg class="w-4 h-4 mr-2 {{ $isActive ? 'text-blue-600' : 'text-gray-500 group-hover:text-black' }}" 
                                         fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="{{ $item['icon'] }}"></path>
                                    </svg>
                                    
                                    <span>{{ __($item['label']) }}</span>
                                    
                                    @if ($isActive)
                                        <div class="absolute inset-x-0 bottom-0 h-0.5 bg-gradient-to-r from-blue-600 to-purple-600 rounded-full"></div>
                                    @endif
                                </a>
                            @endforeach
                        </div>
                    </div>
                </div>

                <div class="flex items-center space-x-4">
                    <div class="hidden lg:block">
                        <div class="relative">
                            <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                                <svg class="h-4 w-4 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path>
                                </svg>
                            </div>
                            <input type="text" 
                                   placeholder="Search skills..." 
                                   class="block w-64 pl-10 pr-3 py-2 border border-gray-300 rounded-lg bg-gray-50 focus:ring-2 focus:ring-blue-500 focus:border-blue-500 text-sm transition-colors">
                        </div>
                    </div>

                   

                    @auth {{-- Show only if user is authenticated --}}
                    <div class="relative" x-data="{ isOpen: false }">
                        <button @click="isOpen = !isOpen" @click.away="isOpen = false" class="flex items-center space-x-2 p-1.5 rounded-lg hover:bg-gray-100 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500 transition-colors">
                            <div class="w-8 h-8 bg-gradient-to-r from-blue-600 to-purple-600 rounded-full flex items-center justify-center ring-1 ring-offset-1 ring-blue-200">
                                <span class="text-white text-sm font-medium">
                                    {{ substr(auth()->user()->name, 0, 1) }}
                                </span>
                            </div>
                            <div class="hidden md:block text-left">
                                <div class="text-sm font-medium text-black">{{ auth()->user()->name }}</div>
                                <div class="text-xs text-gray-500">{{ auth()->user()->email }}</div>
                            </div>
                            <svg class="w-4 h-4 text-gray-400 transition-transform duration-200" :class="{'rotate-180': isOpen}" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path>
                            </svg>
                        </button>

                        <div x-show="isOpen"
                             x-transition:enter="transition ease-out duration-100"
                             x-transition:enter-start="opacity-0 scale-95 transform -translate-y-2"
                             x-transition:enter-end="opacity-100 scale-100 transform translate-y-0"
                             x-transition:leave="transition ease-in duration-75"
                             x-transition:leave-start="opacity-100 scale-100 transform translate-y-0"
                             x-transition:leave-end="opacity-0 scale-95 transform -translate-y-2"
                             class="absolute right-0 mt-2 w-56 bg-white rounded-md shadow-xl border border-gray-200 z-50 py-1 origin-top-right"
                             style="display: none;" {{-- Important for Alpine.js to prevent flicker --}}
                             >
                            <div class="px-4 py-3">
                                <p class="text-sm font-semibold text-gray-700">Signed in as</p>
                                <p class="text-sm text-gray-600 truncate">{{ auth()->user()->email }}</p>
                            </div>
                            <hr class="border-gray-100">
                            @if(Auth::user()->profile)
                                <a href="{{ route('user-profiles.show', Auth::user()->profile->id) }}" 
                                   class="flex items-center px-4 py-2 text-sm text-gray-700 hover:bg-blue-50 hover:text-blue-600 transition-colors">
                                    <svg class="w-4 h-4 mr-3 text-gray-400 group-hover:text-blue-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"></path>
                                    </svg>
                                    My Profile
                                </a>
                                <a href="{{ route('user-profiles.edit.mine') }}" 
                                   class="flex items-center px-4 py-2 text-sm text-gray-700 hover:bg-blue-50 hover:text-blue-600 transition-colors">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 mr-3 text-gray-400 group-hover:text-blue-500" viewBox="0 0 20 20" fill="currentColor">
                                        <path d="M17.414 2.586a2 2 0 00-2.828 0L7 10.172V13h2.828l7.586-7.586a2 2 0 000-2.828z" />
                                        <path fill-rule="evenodd" d="M2 6a2 2 0 012-2h4a1 1 0 010 2H4v10h10v-4a1 1 0 112 0v4a2 2 0 01-2 2H4a2 2 0 01-2-2V6z" clip-rule="evenodd" />
                                    </svg>
                                    Edit My Profile
                                </a>
                            @else
                                <a href="{{ route('user-profiles.create.mine') }}" 
                                   class="flex items-center px-4 py-2 text-sm text-gray-700 hover:bg-blue-50 hover:text-blue-600 transition-colors">
                                    <svg class="w-4 h-4 mr-3 text-gray-400 group-hover:text-blue-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                         <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5.121 17.804A13.937 13.937 0 0112 16c2.5 0 4.847.655 6.879 1.804M15 10a3 3 0 11-6 0 3 3 0 016 0zm6 2a9 9 0 11-18 0 9 9 0 0118 0z" />
                                    </svg>
                                    Lengkapi Profil Saya
                                </a>
                            @endif
                             <a href="#" {{-- Replace with actual settings route if you have one --}}
                               class="flex items-center px-4 py-2 text-sm text-gray-700 hover:bg-blue-50 hover:text-blue-600 transition-colors">
                                <svg class="w-4 h-4 mr-3 text-gray-400 group-hover:text-blue-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10.325 4.317c.426-1.756 2.924-1.756 3.35 0a1.724 1.724 0 002.573 1.066c1.543-.94 3.31.826 2.37 2.37a1.724 1.724 0 001.065 2.572c1.756.426 1.756 2.924 0 3.35a1.724 1.724 0 00-1.066 2.573c.94 1.543-.826 3.31-2.37 2.37a1.724 1.724 0 00-2.572 1.065c-.426 1.756-2.924 1.756-3.35 0a1.724 1.724 0 00-2.573-1.066c-1.543.94-3.31-.826-2.37-2.37a1.724 1.724 0 00-1.065-2.572c-1.756-.426-1.756-2.924 0-3.35a1.724 1.724 0 001.066-2.573c-.94-1.543.826-3.31 2.37-2.37.996.608 2.296.07 2.572-1.065z"></path>
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path>
                                </svg>
                                Settings
                            </a>
                            <hr class="border-gray-100 my-0.5">
                            <form method="POST" action="{{ route('auth.logout') }}"> 
                                @csrf
                                @method('DELETE') 
                                <button type="submit" class="flex items-center w-full text-left px-4 py-2 text-sm text-red-600 hover:bg-red-50 hover:text-red-700 transition-colors">
                                    <svg class="w-4 h-4 mr-3 text-red-400 group-hover:text-red-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1"></path>
                                    </svg>
                                    Sign out
                                </button>
                            </form>
                        </div>
                    </div>
                    @else 
                    <div class="hidden md:flex items-center space-x-2">
                        <a href="{{ route('login') }}" class="px-4 py-2 text-sm font-medium text-gray-600 hover:text-blue-600 transition-colors">Login</a>
                        <a href="{{ route('register') }}" class="px-4 py-2 text-sm font-medium text-white bg-blue-600 hover:bg-blue-700 rounded-lg transition-colors">Register</a>
                    </div>
                    @endauth
                </div>
            </div>
        </div>

        <div id="mobile-menu" class="md:hidden hidden border-t border-gray-200 bg-white">
            <div class="px-4 pt-2 pb-3 space-y-1">
                @foreach ($navItems as $item)
                    @php
                        $currentRouteName = Request::route()->getName();
                        $baseRoute = explode('.', $item['route'])[0];
                        $isActive = Str::startsWith($currentRouteName, $item['route']) || Str::startsWith($currentRouteName, $baseRoute . '.');
                        if ($item['route'] === 'dashboard') {
                            $isActive = $currentRouteName === $item['route'];
                        }
                    @endphp
                    <a href="{{ route($item['route']) }}"
                       class="flex items-center px-3 py-2 rounded-lg text-base font-medium {{ $isActive ? 'bg-blue-50 text-black font-semibold' : 'text-black hover:bg-gray-50' }} transition-colors">
                        <svg class="w-5 h-5 mr-3 {{ $isActive ? 'text-blue-600' : 'text-gray-500' }}" 
                             fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="{{ $item['icon'] }}"></path>
                        </svg>
                        {{ __($item['label']) }}
                    </a>
                @endforeach
                
                <div class="pt-4">
                    <div class="relative">
                        <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                            <svg class="h-4 w-4 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path>
                            </svg>
                        </div>
                        <input type="text" 
                               placeholder="Search skills..." 
                               class="block w-full pl-10 pr-3 py-2 border border-gray-300 rounded-lg bg-gray-50 focus:ring-2 focus:ring-blue-500 focus:border-blue-500 text-sm">
                    </div>
                </div>

                @auth
                <div class="pt-4 mt-4 border-t border-gray-200">
                     <div class="flex items-center px-3 py-2">
                        <div class="flex-shrink-0">
                             <div class="w-10 h-10 bg-gradient-to-r from-blue-600 to-purple-600 rounded-full flex items-center justify-center ring-1 ring-offset-1 ring-blue-200">
                                <span class="text-white text-md font-medium">
                                    {{ substr(auth()->user()->name, 0, 1) }}
                                </span>
                            </div>
                        </div>
                        <div class="ml-3">
                            <div class="text-base font-medium text-black">{{ auth()->user()->name }}</div>
                            <div class="text-sm font-medium text-gray-500">{{ auth()->user()->email }}</div>
                        </div>
                    </div>
                    <div class="mt-3 space-y-1">
                        @if(Auth::user()->profile)
                            <a href="{{ route('user-profiles.show', Auth::user()->profile->id) }}" class="block px-3 py-2 rounded-md text-base font-medium text-gray-700 hover:text-blue-600 hover:bg-blue-50">My Profile</a>
                            <a href="{{ route('user-profiles.edit.mine') }}" class="block px-3 py-2 rounded-md text-base font-medium text-gray-700 hover:text-blue-600 hover:bg-blue-50">Edit My Profile</a>
                        @else
                            <a href="{{ route('user-profiles.create.mine') }}" class="block px-3 py-2 rounded-md text-base font-medium text-gray-700 hover:text-blue-600 hover:bg-blue-50">Lengkapi Profil Saya</a>
                        @endif
                        <a href="#" class="block px-3 py-2 rounded-md text-base font-medium text-gray-700 hover:text-blue-600 hover:bg-blue-50">Settings</a>
                        <form method="POST" action="{{ route('auth.logout') }}">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="block w-full text-left px-3 py-2 rounded-md text-base font-medium text-red-600 hover:bg-red-50 hover:text-red-700">
                                Sign out
                            </button>
                        </form>
                    </div>
                </div>
                @else
                <div class="pt-4 mt-4 border-t border-gray-200 space-y-2">
                    <a href="{{ route('login') }}" class="block w-full text-center px-4 py-2 text-base font-medium text-white bg-blue-600 hover:bg-blue-700 rounded-lg">Login</a>
                    <a href="{{ route('register') }}" class="block w-full text-center px-4 py-2 text-base font-medium text-blue-600 ring-1 ring-blue-600 hover:bg-blue-50 rounded-lg">Register</a>
                </div>
                @endauth
            </div>
        </div>
    </nav>

    <script>
        function toggleMobileMenu() {
            const mobileMenu = document.getElementById('mobile-menu');
            const menuIcon = document.getElementById('menu-icon');
            const closeIcon = document.getElementById('close-icon');
            
            if (mobileMenu) mobileMenu.classList.toggle('hidden');
            if (menuIcon) menuIcon.classList.toggle('hidden');
            if (closeIcon) closeIcon.classList.toggle('hidden');
        }

        document.addEventListener('click', function(event) {
            const mobileMenu = document.getElementById('mobile-menu');
            const mobileMenuButton = document.querySelector('button[onclick="toggleMobileMenu()"]'); 
            
            if (mobileMenu && !mobileMenu.classList.contains('hidden') && 
                mobileMenuButton && !mobileMenuButton.contains(event.target) && 
                !mobileMenu.contains(event.target)) {
                
                mobileMenu.classList.add('hidden');
                const menuIcon = document.getElementById('menu-icon');
                const closeIcon = document.getElementById('close-icon');
                if(menuIcon) menuIcon.classList.remove('hidden');
                if(closeIcon) closeIcon.classList.add('hidden');
            }
        });
    </script>
    <script src="https://cdn.jsdelivr.net/gh/alpinejs/alpine@v2.x.x/dist/alpine.min.js" defer></script>
@endif
