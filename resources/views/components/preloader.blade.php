<div id="global-loader">
    <div class="loader-wrapper">
        <h4 class="loader-logo text-primary fw-bolder mb-0" style="margin-top: 10px;">AURA</h4>
        <div class="loader-spinner"></div>
    </div>
</div>

<style>
    /* Attractive Premium Preloader */
    #global-loader {
        position: fixed;
        top: 0;
        left: 0;
        width: 100vw;
        height: 100vh;
        background-color: #ffffff;
        z-index: 99999;
        display: flex;
        align-items: center;
        justify-content: center;
        transition: opacity 0.5s ease, visibility 0.5s ease;
    }
    
    .loader-wrapper {
        position: relative;
        display: flex;
        align-items: center;
        justify-content: center;
    }
    
    .loader-logo {
        position: absolute;
        animation: loaderPulse 1.5s infinite ease-in-out;
    }
    
    .loader-spinner {
        width: 80px;
        height: 80px;
        border: 3px solid rgba(255, 155, 68, 0.1); /* Subtle brand color track */
        border-top-color: #ff9b44; /* Primary brand color */
        border-bottom-color: #ff9b44;
        border-radius: 50%;
        animation: loaderSpin 1.5s cubic-bezier(0.68, -0.55, 0.265, 1.55) infinite;
    }
    
    @keyframes loaderPulse {
        0% { transform: scale(0.85); opacity: 0.7; }
        50% { transform: scale(1.1); opacity: 1; text-shadow: 0 0 10px rgba(255, 155, 68, 0.5); }
        100% { transform: scale(0.85); opacity: 0.7; }
    }
    
    @keyframes loaderSpin {
        0% { transform: rotate(0deg); border-width: 3px; }
        50% { transform: rotate(180deg); border-width: 1px; }
        100% { transform: rotate(360deg); border-width: 3px; }
    }
</style>
