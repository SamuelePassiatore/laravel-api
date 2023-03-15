const deleteAllForms = document.querySelectorAll('.delete-all-form');
deleteAllForms.forEach(form => {
    form.addEventListener('submit', (event) => {
        event.preventDefault();
        const name = form.getAttribute('data-name') || 'element';
        const confirm = window.confirm(`Are you sure to empty the ${name}?`);
        if (confirm) form.submit();
    });
});
