// ─── AOS Init ─────────────────────────────────────────────────────────────────
(() => {
  if (window.AOS) {
    window.AOS.init({
      duration: 700,
      easing: 'ease-out-cubic',
      once: true,
      offset: 28,
    });
  }
})();

// ─── Filtro de módulos cross-categoría ────────────────────────────────────────
// Busca en TODOS los [data-module-card] del DOM, independientemente de en
// qué sección de categoría estén. Además oculta/muestra la sección completa
// cuando todos sus módulos quedan fuera del filtro.
(() => {
  const searchInput = document.querySelector('[data-module-search]');
  const noResults   = document.querySelector('[data-no-results]');

  if (!searchInput) {
    return;
  }

  const normalize = (value) => {
    if (!value) return '';
    return value.toLowerCase().normalize("NFD").replace(/[\u0300-\u036f]/g, "").trim();
  };

  const applyFilter = () => {
    const rawQuery = searchInput.value;
    const queryText = normalize(rawQuery);
    const queryWords = queryText.split(/\s+/).filter(w => w.length > 0);
    let totalVisible = 0;

    const sections = document.querySelectorAll('[data-category-section]');

    if (sections.length === 0) {
      document.querySelectorAll('[data-module-card]').forEach((card) => {
        const haystack = normalize(card.dataset.filterText || '');
        const visible = queryWords.length === 0 || queryWords.every(word => haystack.includes(word));
        card.classList.toggle('d-none', !visible);
        if (visible) totalVisible++;
      });
    } else {
      sections.forEach((section) => {
        const cards = section.querySelectorAll('[data-module-card]');
        let visibleInSection = 0;

        cards.forEach((card) => {
          const haystack = normalize(card.dataset.filterText || '');
          const visible = queryWords.length === 0 || queryWords.every(word => haystack.includes(word));
          
          card.classList.toggle('d-none', !visible);
          
          if (visible) visibleInSection++;
        });

        // Ocultar la sección completa si no tiene coincidencias
        const sectionVisible = visibleInSection > 0 || queryWords.length === 0;
        section.classList.toggle('d-none', !sectionVisible);
        totalVisible += visibleInSection;
      });
    }

    if (noResults) {
      const showNoResults = totalVisible === 0 && queryWords.length > 0;
      noResults.hidden = !showNoResults;
      noResults.classList.toggle('d-none', !showNoResults);
    }
  };

  searchInput.addEventListener('input', applyFilter);
})();

// ─── Hero parallax tilt ────────────────────────────────────────────────────────
(() => {
  const hero = document.querySelector('.hero-card');
  if (!hero || window.matchMedia('(prefers-reduced-motion: reduce)').matches) {
    return;
  }

  const onMove = (event) => {
    const rect    = hero.getBoundingClientRect();
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
