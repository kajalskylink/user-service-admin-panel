$(document).ready(function () {
    let counter = 1;
    const $counterElement = $("#counter");
    const $modalElement = $("#successful");

    if (!$counterElement.length || !$modalElement.length) return;

    const interval = setInterval(() => {
        if (counter <= 100) {
            $counterElement.text(`${counter}%`);
            counter++;
        } else {
            clearInterval(interval);
            showModal();
        }
    }, 30);

    function showModal() {
        const modal = new bootstrap.Modal($modalElement[0]);
        modal.show();

        setTimeout(() => {
            window.location.href = "preferred-lang.html";
        }, 3000);
    }
});
