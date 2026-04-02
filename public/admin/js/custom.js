// Global toast function with animated progress bar
window.showToast = function(message, type = 'success', duration = 3000) {
    // type: 'success', 'danger', 'info', 'warning'
    let bgClass = 'bg-success';
    if(type === 'danger') bgClass = 'bg-danger';
    else if(type === 'info') bgClass = 'bg-info';
    else if(type === 'warning') bgClass = 'bg-warning';

    let toastId = 'toast-' + Date.now();

    let toastHtml = `
        <div id="${toastId}" class="toast align-items-center text-white ${bgClass} border-0 show mb-2" role="alert" aria-live="assertive" aria-atomic="true" style="min-width:250px;">
            <div class="d-flex flex-column">
                <div class="toast-body">${message}</div>
                <div class="progress mt-1" style="height:4px;">
                    <div class="progress-bar" role="progressbar" style="width: 100%;" aria-valuenow="100" aria-valuemin="0" aria-valuemax="100"></div>
                </div>
                <button type="button" class="btn-close btn-close-white me-2 m-auto mt-1" data-bs-dismiss="toast" aria-label="Close"></button>
            </div>
        </div>
    `;

    let container = document.getElementById('toast-container');
    if(!container){
        container = document.createElement('div');
        container.id = 'toast-container';
        container.className = 'position-fixed top-0 end-0 p-3';
        container.style.zIndex = 1060;
        document.body.appendChild(container);
    }

    container.insertAdjacentHTML('beforeend', toastHtml);

    let toastEl = document.getElementById(toastId);
    let progressBar = toastEl.querySelector('.progress-bar');

    // Animate progress bar
    let startTime = Date.now();
    let interval = setInterval(() => {
        let elapsed = Date.now() - startTime;
        let percent = Math.max(0, 100 - (elapsed / duration) * 100);
        progressBar.style.width = percent + '%';
        if(percent <= 0){
            clearInterval(interval);
            toastEl.remove();
        }
    }, 20);
};
