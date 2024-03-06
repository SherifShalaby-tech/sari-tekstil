function toggleModal() {
    const modal = document.getElementById('panel');
    const overlay = document.querySelector('.overlay');

    modal.classList.toggle('off');
    overlay.style.display = modal.classList.contains('off') ? 'none' : 'block';
}

function closeModal() {
    const modals = document.querySelectorAll('.panel');
    const overlay = document.querySelector('.overlay');
    modals.forEach((modal) => {
        modal.classList.add('off');
    })
    overlay.style.display = 'none';
}

function toggleEditModal(id) {
    const modal = document.getElementById(`panel${id}`);
    const overlay = document.querySelector('.overlay');

    modal.classList.toggle('off');
    overlay.style.display = modal.classList.contains('off') ? 'none' : 'block';
}