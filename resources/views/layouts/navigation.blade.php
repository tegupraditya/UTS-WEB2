@if (Request::route()->getName() != 'landing')
    <nav style="background-color: white; border-bottom: 1px solid #e5e7eb;">
        <div style="max-width: 1280px; margin: 0 auto; padding: 0 1rem; display: flex; justify-content: space-between; height: 4rem; align-items: center;">
            <div style="display: flex; align-items: center;">
                <!-- Logo -->
                <div style="flex-shrink: 0;">
                    <a href="{{ route('landing') }}">
                        <img src="{{ asset('img/logo.png') }}" alt="SkillTrade Logo" style="height: 3rem; width: auto;">
                    </a>
                </div>
                
                <!-- Navigation Links -->
                <div style="display: flex; gap: 2rem; margin-left: 2.5rem; align-items: center;">
                    @php
                        $navItems = [
                            ['label' => 'Dashboard', 'route' => 'dashboard'],
                            ['label' => 'Skill Offers', 'route' => 'skill-offers.index'],
                            ['label' => 'User Profile', 'route' => 'user-profiles.index'],
                            ['label' => 'Matching Skills', 'route' => 'matching.index'],
                        ];
                    @endphp

                    @foreach ($navItems as $item)
                        @php
                            $isActive = request()->routeIs($item['route']);
                        @endphp
                        <a href="{{ route($item['route']) }}"
                            style="
                                position: relative;
                                font-size: 1.125rem; /* 18px */
                                text-decoration: none;
                                color: {{ $isActive ? 'black' : '#6b7280' }}; 
                                font-weight: {{ $isActive ? '600' : '400' }}; 
                                padding-bottom: 5px;
                                transition: color 0.3s ease;
                            "
                            onmouseover="this.style.color='#374151'"
                            onmouseout="this.style.color='{{ $isActive ? 'black' : '#6b7280' }}'">
                            {{ __($item['label']) }}
                            @if ($isActive)
                                <span style="
                                    position: absolute;
                                    left: 0;
                                    right: 0;
                                    bottom: 0;
                                    height: 2px;
                                    background-color: #3b82f6;
                                    border-radius: 9999px;
                                "></span>
                            @endif
                        </a>
                    @endforeach
                </div>
            </div>
        </div>
    </nav>
@endif
