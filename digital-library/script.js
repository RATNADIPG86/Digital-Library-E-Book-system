
function filterBooks() {
    const searchValue = (document.getElementById('searchInput')?.value || '').toLowerCase();
    const categoryValue = (document.getElementById('categoryFilter')?.value || '').toLowerCase();
    const books = document.querySelectorAll('.book-card-item');

    books.forEach((book) => {
        const title = book.getAttribute('data-title')?.toLowerCase() || '';
        const author = book.getAttribute('data-author')?.toLowerCase() || '';
        const category = book.getAttribute('data-category')?.toLowerCase() || '';
        const matchTitle = title.includes(searchValue) || author.includes(searchValue);
        const matchCategory = categoryValue === '' || category === categoryValue;
        book.style.display = matchTitle && matchCategory ? 'flex' : 'none';
    });
}

window.addEventListener('DOMContentLoaded', () => {
    const observer = new IntersectionObserver((entries) => {
        entries.forEach((entry) => {
            if (entry.isIntersecting) {
                entry.target.classList.add('show');
                observer.unobserve(entry.target);
            }
        });
    }, { threshold: 0.15 });

    document.querySelectorAll('.feature-card, .stat-card, .dashboard-card, .library-card, .reveal').forEach((el) => observer.observe(el));
});
