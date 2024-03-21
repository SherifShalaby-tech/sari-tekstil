function toggleModal() {
    const modal = document.getElementById('form-panel');
    const overlay = document.querySelector('.overlay');
    const breadcrumbbar = document.querySelector('.breadcrumbbar');

    modal.classList.toggle('off');
    overlay.style.display = modal.classList.contains('off') ? 'none' : 'block';
    breadcrumbbar.style.zIndex = "99999";
}

function closeModal() {
    const modals = document.querySelectorAll('.form-panel');
    const overlay = document.querySelector('.overlay');
    const breadcrumbbar = document.querySelector('.breadcrumbbar');
    modals.forEach((modal) => {
        modal.classList.add('off');
    })
    overlay.style.display = 'none';
    breadcrumbbar.style.zIndex = "99";
}

function toggleEditModal(id) {
    const modal = document.getElementById(`form-panel${id}`);
    const overlay = document.querySelector('.edit-overlay');
    const topbar = document.querySelector('.topbar');

    modal.classList.toggle('off');
    overlay.style.display = modal.classList.contains('off') ? 'none' : 'block';
    topbar.style.zIndex = "99";
}

function closeEditModal(id) {
    const modal = document.getElementById(`form-panel${id}`);
    const overlay = document.querySelector('.edit-overlay');
    const topbar = document.querySelector('.topbar');

    modal.classList.add('off');
    overlay.style.display = 'none';
    topbar.style.zIndex = "9999";
}
