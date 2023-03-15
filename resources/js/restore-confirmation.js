const restoreForms = document.querySelectorAll('.restore-form');
restoreForms.forEach(form => {
    form.addEventListener('submit', (event) => {
        event.preventDefault();
        const name = form.getAttribute('data-name') || 'element';
        const confirm = window.confirm(`Are you sure to restore this ${name}?`);
        if (confirm) form.submit();
    });
});