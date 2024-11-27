import Alpine from 'alpinejs';

window.Alpine = Alpine;

Alpine.start();


document.querySelectorAll('[data-dismiss="alert"]').forEach((button) => {
    button.addEventListener('click', () => {
        button.parentElement.style.display = 'none';
    });
});

document.querySelectorAll('.coment').forEach((button) => {
    button.addEventListener('click', () => {
        const commentFormContainer = button.closest('.mb-8').querySelector('#commentFormContainer');
        
        if (commentFormContainer.style.display === 'none' || !commentFormContainer.style.display) {
            commentFormContainer.style.display = 'block';
        } else {
            commentFormContainer.style.display = 'none';
        }
    });
});
