document.addEventListener('DOMContentLoaded', function () {
  const searchInput = document.getElementById('header-search-input');
  const resultsBox = document.getElementById('header-search-results');

  if (!searchInput || !resultsBox) return;

  let searchTimeout;

  searchInput.addEventListener('input', function () {
    const query = searchInput.value.trim();

    clearTimeout(searchTimeout);

    if (query.length < 2) {
      resultsBox.innerHTML = '';
      resultsBox.classList.remove('is-active');
      return;
    }

    searchTimeout = setTimeout(function () {
      fetch(themeSearchAjax.ajax_url, {
        method: 'POST',
        headers: {
          'Content-Type': 'application/x-www-form-urlencoded',
        },
        body: new URLSearchParams({
          action: 'theme_ajax_product_search',
          nonce: themeSearchAjax.nonce,
          search: query,
        }),
      })
        .then(response => response.json())
        .then(data => {
          if (!data.success) {
            resultsBox.innerHTML = '';
            resultsBox.classList.remove('is-active');
            return;
          }

          const products = data.data.products;
          const categories = data.data.categories;
          const searchUrl = data.data.search_url;

          let html = '';

          if (categories.length > 0) {
            html += '<div class="search-results__section">';
            html += '<p class="search-results__title">Categorías</p>';

            categories.forEach(category => {
              html += `
                <a href="${category.url}" class="search-results__category">
                  ${category.name}
                </a>
              `;
            });

            html += '</div>';
          }

          if (products.length > 0) {
            html += '<div class="search-results__section">';
            html += '<p class="search-results__title">Productos</p>';

            products.forEach(product => {
              html += `
                <a href="${product.url}" class="search-results__item">
                  <img src="${product.image}" alt="${product.name}">
                  <div>
                    <span class="search-results__name">${product.name}</span>
                    <span class="search-results__price">${product.price}</span>
                  </div>
                </a>
              `;
            });

            html += '</div>';
          }

          if (products.length === 0 && categories.length === 0) {
            html += `
              <div class="search-results__empty">
                No encontramos resultados para "${query}"
              </div>
            `;
          }

          html += `
            <a href="${searchUrl}" class="search-results__all">
              Ver todos los resultados
            </a>
          `;

          resultsBox.innerHTML = html;
          resultsBox.classList.add('is-active');
        })
        .catch(() => {
          resultsBox.innerHTML = '';
          resultsBox.classList.remove('is-active');
        });
    }, 300);
  });

  document.addEventListener('click', function (event) {
    if (!event.target.closest('.header-search')) {
      resultsBox.innerHTML = '';
      resultsBox.classList.remove('is-active');
    }
  });
});