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

// ─── Dark/Light Mode Switcher ─────────────────────────────────────────────────
(() => {
  const initTheme = () => {
    const savedTheme = localStorage.getItem('theme');
    if (savedTheme === 'light') {
      document.body.classList.add('light-mode');
    }
  };

  window.toggleTheme = () => {
    document.body.classList.toggle('light-mode');
    const isLight = document.body.classList.contains('light-mode');
    localStorage.setItem('theme', isLight ? 'light' : 'dark');
  };

  initTheme();
})();

// ─── Filtro de módulos cross-categoría ────────────────────────────────────────
(() => {
  const searchInput = document.querySelector('[data-module-search]');
  const noResults = document.querySelector('[data-no-results]');

  if (!searchInput) return;

  const normalize = (value) => value.toLowerCase().normalize("NFD").replace(/[\u0300-\u036f]/g, "").trim();

  const applyFilter = () => {
    const query = normalize(searchInput.value);
    let totalVisible = 0;

    // Recorrer cada sección de categoría
    const sections = document.querySelectorAll('[data-category-section]');

    if (sections.length === 0) {
      document.querySelectorAll('[data-module-card]').forEach((card) => {
        const haystack = normalize(card.dataset.filterText || '');
        const visible = query === '' || haystack.includes(query);
        card.hidden = !visible;
        if (visible) totalVisible++;
      });
    } else {
      sections.forEach((section) => {
        const cards = section.querySelectorAll('[data-module-card]');
        let visibleInSection = 0;
        cards.forEach((card) => {
          const haystack = normalize(card.dataset.filterText || '');
          const visible = query === '' || haystack.includes(query);
          card.hidden = !visible;
          if (visible) visibleInSection++;
        });

        // Ocultar la sección completa si no tiene coincidencias
        section.hidden = visibleInSection === 0 && query !== '';
        totalVisible += visibleInSection;
      });
    }

    if (noResults) {
      noResults.hidden = totalVisible !== 0 || query === '';
    }
  };

  searchInput.addEventListener('input', applyFilter);
})();

// ─── Hero parallax tilt ───────────────────────────────────────────────────────
(() => {
  const hero = document.querySelector('.hero-card');
  if (!hero || window.matchMedia('(prefers-reduced-motion: reduce)').matches) return;

  const onMove = (event) => {
    const rect = hero.getBoundingClientRect();
    const rotateY = (event.clientX - (rect.left + rect.width / 2)) / 45;
    const rotateX = ((rect.top + rect.height / 2) - event.clientY) / 60;
    hero.style.transform = `perspective(900px) rotateX(${rotateX}deg) rotateY(${rotateY}deg)`;
  };

  const reset = () => hero.style.transform = 'perspective(900px) rotateX(0deg) rotateY(0deg)';

  hero.addEventListener('mousemove', onMove);
  hero.addEventListener('mouseleave', reset);
})();