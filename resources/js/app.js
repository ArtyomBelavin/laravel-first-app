import './bootstrap';
import Alpine from 'alpinejs';

const selectElements = document.querySelectorAll('.status-form #status_id');

for (let elem of selectElements) {
    const currentStatus = parseInt(elem.dataset.currentStatus);

    const isStatusLocked = [2, 3].includes(currentStatus);

    if (isStatusLocked) {
        elem.disabled = true;
    }

    elem.addEventListener('change', function (event) {
        if (isStatusLocked) {
            event.preventDefault();
            this.value = currentStatus;
            return;
        }

        this.form.submit();
    });
}

window.Alpine = Alpine;
Alpine.start();

