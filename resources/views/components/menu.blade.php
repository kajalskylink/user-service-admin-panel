@props(['menu', 'menu_icon' => null])
<!-- ====================================== Setting Section ===================================== -->
<section class="setting-section">
    <div class="offcanvas offcanvas-start" tabindex="-1" id="offcanvasExample"
        aria-labelledby="offcanvasExampleLabel">
        <div class="offcanvas-header">
            <h2 class="offcanvas-title" id="offcanvasExampleLabel">Settings</h2>
            <button type="button" class="btn-close" data-bs-dismiss="offcanvas" aria-label="Close"></button>
        </div>
        <div class="offcanvas-body">
            @foreach ($menu as $key=>$item)
                <a href="{{ $item->route ? route($item->route ) : '#' }}" class="home-setting-icons-main">
                    <div class="setting-opestion-main">
                        <div class="setting-icons-main">
                            <img src="{{ asset($menu_icon[$key]) }}" alt="home">
                        </div>
                        <h2 class="new-notification">{{ $item->name }}</h2>
                    </div>
                    <img class="setting-arrow" src="{{ asset('images/svg/right-half-arrow-black.svg') }}"
                        alt="right-half-arrow-black">
                </a>
            @endforeach
            <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                @csrf
            </form>
                <a href="{{ route('logout') }}" class="home-setting-icons-main" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                    <div class="setting-opestion-main">
                        <div class="setting-icons-main">
                            <img src="{{ asset('images/svg/LogOut-icon.svg') }}" alt="LogOut-icon">
                        </div>
                        <h2 class="new-notification">Logout</h2>
                    </div>
                    <img class="setting-arrow" src="{{ asset('images/svg/right-half-arrow-black.svg') }}"
                        alt="right-half-arrow-black">
                </a>
            
            
        </div>
    </div>
</section>