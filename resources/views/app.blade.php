<x-guest-layout>
    <!-- ====================================== Preloader ===================================== -->
    <div class="page-loader">
        <img class="splash-img1" src="{{ asset('images/svg/splash-img1.svg') }}" alt="splash-img1">
        <div class="splash-logo-box">
            <img src="{{ asset('images/logo_small.png') }}" alt="logo">
            <h1 class="logo-text">{{ config('app.name', 'Apex MPL') }}</h1>
            <p class="logo-sub-text">Every product is special</p>
        </div>
        <img class="splash-img2" src="{{ asset('images/svg/splash-img2.svg') }}" alt="splash-img2">
    </div>
    <!-- ====================================== Onboarding Screen Start ===================================== -->
    <div id="carouselExampleIndicators" class="carousel slide onboarding-slider" data-bs-ride="carousel">
        <div class="carousel-indicators custom-slider-btn">
            <button type="button" id="first" data-bs-target="#carouselExampleIndicators" data-bs-slide-to="0"
                class="custom-slider-dots active"></button>
            <button type="button" id="second" data-bs-target="#carouselExampleIndicators" data-bs-slide-to="1"
                class="custom-slider-dots" aria-current="true"></button>
            <button type="button" id="third" data-bs-target="#carouselExampleIndicators" data-bs-slide-to="2"
                class="custom-slider-dots"></button>
        </div>
        
        <div class="carousel-inner">
            @foreach ($pages as $index => $page)
                @if (count($page['page']->get_images()) > 0 && $page['page']->get_images()->first()->path != '')
                    @push('styles')
                        <style>
                            .slide{{ $index+1 }} {
                                background-image: linear-gradient(rgba(0, 0, 0, 0), rgba(0, 0, 0, 0.5), rgba(0, 0, 0, 1)), url('{{ asset($page['page']->get_images()->first()->path) }}') !important;
                            }
                        </style>
                    @endpush                
                @endif
            <div class="carousel-item {{ $page['title'] }} {{ $index == 0 ? 'active' : '' }}">
                <div class="Onboarding-main slide{{ $index + 1 }}">
                    <div class="container">
                        @if(count($pages) > $index+1)
                        <div class="skip_btn_{{ $index + 1 }} skip_btn-onboading">
                            <a href="javascript:void(0)">Skip</a>
                        </div>
                        @endif
                        <div class="Onboarding-Screen-1-full">
                            <div class="boarding-title">
                                <h2>{{ $page['page']->title }}</h2>
                                <p>{{ $page['page']->subtitle }}</p>
                            </div>
                            <div class="position-relative">
                                <img class="shape-spalsh-btn" src="{{ asset('images/splash-screen/Shape.png') }}" alt="Shape">
                            </div>
                            @if(count($pages) > $index+1)
                            <div class="onboarding-next-btn skip_btn_{{ $index + 1 }}">
                                <img src="{{ asset('images/svg/right-half-arrow.svg') }}" alt="right-half-arrow">
                            </div>
                            @else
                            <div class="onboarding-next-btn">
                                <a href="{{ route('login') }}">
                                    <img src="{{ asset('images/svg/right-half-arrow.svg') }}" alt="right-half-arrow">
                                </a>
                            </div>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
            @endforeach
        </div>
    </div>
</x-guest-layout>