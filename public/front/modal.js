function toggleModal() {
    const modal = document.getElementById('panel');
    const overlay = document.querySelector('.overlay');

    modal.classList.toggle('off');
    overlay.style.display = modal.classList.contains('off') ? 'none' : 'block';
}

function closeModal() {
    const modal = document.getElementById('panel');
    const overlay = document.querySelector('.overlay');

    modal.classList.add('off');
    overlay.style.display = 'none';
}
