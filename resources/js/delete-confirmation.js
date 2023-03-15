const deleteForms = document.querySelectorAll('.delete-form');
deleteForms.forEach(form => {
    form.addEventListener('submit', (event) => {
        event.preventDefault();
        const name = form.getAttribute('data-name') || 'element';
        const confirm = window.confirm(`Are you sure to delete this ${name}?`);
        if (confirm) form.submit();
    });
});
