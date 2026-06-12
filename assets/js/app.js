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

  const normalize = (value) => value.toLowerCase().trim();

  const applyFilter = () => {
    const query        = normalize(searchInput.value);
    let totalVisible   = 0;

    // Recorrer cada sección de categoría
    const sections = document.querySelectorAll('[data-category-section]');

    if (sections.length === 0) {
      // Fallback: modo plano (sin categorías)
      document.querySelectorAll('[data-module-card]').forEach((card) => {
        const haystack = normalize(card.dataset.filterText || '');
        const visible  = query === '' || haystack.includes(query);
        card.hidden    = !visible;
        if (visible) totalVisible++;
      });
    } else {
      sections.forEach((section) => {
        const cards         = section.querySelectorAll('[data-module-card]');
        let visibleInSection = 0;

        cards.forEach((card) => {
          const haystack = normalize(card.dataset.filterText || '');
          const visible  = query === '' || haystack.includes(query);
          card.hidden    = !visible;
          if (visible) visibleInSection++;
        });

        // Ocultar la sección completa si no tiene coincidencias
        section.hidden = visibleInSection === 0 && query !== '';
        totalVisible  += visibleInSection;
      });
    }

    if (noResults) {
      noResults.hidden = totalVisible !== 0 || query === '';
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
