const deleteDefinitiveForms = document.querySelectorAll('.delete-definitive-form');
deleteDefinitiveForms.forEach(form => {
    form.addEventListener('submit', (event) => {
        event.preventDefault();
        const name = form.getAttribute('data-name') || 'element';
        const confirm = window.confirm(`Are you sure to delete permanently this ${name}?`);
        if (confirm) form.submit();
    });
});