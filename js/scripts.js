document.addEventListener('DOMContentLoaded', () => {
    const searchInput = document.getElementById('search');
    const resultsList = document.querySelector('.search-results');

    searchInput.addEventListener('input', () => {
        const query = searchInput.value;
        if (query.length > 2) {
            fetch(`get_artists.php?q=${query}`)
                .then(response => response.json())
                .then(data => {
                    resultsList.innerHTML = '';
                    data.forEach(artist => {
                        const li = document.createElement('li');
                        li.textContent = artist.artist_name;
                        resultsList.appendChild(li);
                    });
                });
        } else {
            resultsList.innerHTML = '';
        }
    });
});
