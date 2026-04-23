(() => {
  if (window.AOS) {
    window.AOS.init({
      duration: 700,
      easing: 'ease-out-cubic',
      once: true,
      offset: 28,
    });
  }

  const searchInput = document.querySelector('[data-module-search]');
  const cards = Array.from(document.querySelectorAll('[data-module-card]'));
  const noResults = document.querySelector('[data-no-results]');

  if (!searchInput || cards.length === 0) {
    return;
  }

  const normalize = (value) => value.toLowerCase().trim();

  const applyFilter = () => {
    const query = normalize(searchInput.value);
    let visibleCards = 0;

    cards.forEach((card) => {
      const haystack = normalize(card.dataset.filterText || '');
      const isVisible = query === '' || haystack.includes(query);
      card.hidden = !isVisible;
      if (isVisible) {
        visibleCards += 1;
      }
    });

    if (noResults) {
      noResults.hidden = visibleCards !== 0;
    }
  };

  searchInput.addEventListener('input', applyFilter);
})();

(() => {
  const hero = document.querySelector('.hero-card');
  if (!hero || window.matchMedia('(prefers-reduced-motion: reduce)').matches) {
    return;
  }

  const onMove = (event) => {
    const rect = hero.getBoundingClientRect();
    const centerX = rect.left + rect.width / 2;
    const centerY = rect.top + rect.height / 2;
    const rotateY = (event.clientX - centerX) / 45;
    const rotateX = (centerY - event.clientY) / 60;
    hero.style.transform = `perspective(900px) rotateX(${rotateX}deg) rotateY(${rotateY}deg)`;
  };

  const reset = () => {
    hero.style.transform = 'perspective(900px) rotateX(0deg) rotateY(0deg)';
  };

  hero.addEventListener('mousemove', onMove);
  hero.addEventListener('mouseleave', reset);
})();
