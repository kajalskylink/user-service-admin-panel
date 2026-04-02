<!-- ====================================== Pop Up Add Home Screen ===================================== -->
<div id="bkgOverlay" class="backgroundOverlay"></div>
<div id="delayedPopup" class="delayedPopupWindow">
    <a href="#" id="btnClose"><img src="{{ asset('images/svg/x.svg') }}" alt="x"></a>
    <div class="formDescription">
        <img src="{{ asset('images/logo_small.png') }}" alt="logo">
        <h3>{{ config('app.name', 'Apex MPL') }}</h3>
        <p>Install {{ config('app.name', 'Apex MPL') }} Mobile App Template to your home screen for easy access, just like any other app</p>
        <div class="home-scrren-main">
            <div class="button-main">
                <a href="#">Add Home Screen</a>
            </div>
        </div>
    </div>
</div>