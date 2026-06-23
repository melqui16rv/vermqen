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
    const rotateY = (event.clientX - (rect.left + rect.width / 2)) / 190;
    const rotateX = ((rect.top + rect.height / 2) - event.clientY) / 230;
    hero.style.transform = `perspective(900px) rotateX(${rotateX}deg) rotateY(${rotateY}deg)`;
  };

  const reset = () => hero.style.transform = 'perspective(900px) rotateX(0deg) rotateY(0deg)';

  hero.addEventListener('mousemove', onMove);
  hero.addEventListener('mouseleave', reset);
  
})();
// ─── Sidebar Expandible ─────────────────────────────
(() => {

  const toggles = document.querySelectorAll('.sidebar-category-toggle');

  if (!toggles.length) return;

  const closeList = (toggle, list) => {
    list.classList.remove('open');
    list.style.maxHeight = '0px';
    toggle.setAttribute('aria-expanded', 'false');
  };

  const openList = (toggle, list) => {
    list.classList.add('open');
    list.style.maxHeight = `${list.scrollHeight}px`;
    toggle.setAttribute('aria-expanded', 'true');
  };

  const normalize = (value) => value
    .toLowerCase()
    .normalize('NFD')
    .replace(/[\u0300-\u036f]/g, '')
    .trim();

  const refreshOpenHeights = () => {
    document.querySelectorAll('.sidebar-modules.open').forEach(list => {
      list.style.maxHeight = `${list.scrollHeight}px`;
    });
  };

  toggles.forEach(toggle => {

    const category = toggle.dataset.category;

    const list = document.querySelector(
      `.sidebar-modules[data-category="${category}"]`
    );

    if (!list) return;

    if (!toggle.hasAttribute('aria-expanded')) {
      toggle.setAttribute('aria-expanded', 'false');
    }

    if (list.classList.contains('open')) {
      openList(toggle, list);
    } else {
      closeList(toggle, list);
    }

    toggle.addEventListener('click', (event) => {
      event.preventDefault();
      event.stopImmediatePropagation();

      const opened = list.classList.contains('open');

      // Cerrar las demás
      document.querySelectorAll('.sidebar-category-toggle').forEach(el => {
        const otherCategory = el.dataset.category;
        const otherList = document.querySelector(
          `.sidebar-modules[data-category="${otherCategory}"]`
        );

        if (otherList) {
          closeList(el, otherList);
        }
      });

      // Abrir la actual
      if (!opened) {
        openList(toggle, list);
      }

    });

  });

  const searchInput = document.getElementById('moduleSearch');
  const categoryFilter = document.getElementById('categoryFilter');
  const moduleLinks = Array.from(document.querySelectorAll('.sidebar-module-link'));

  if (searchInput && moduleLinks.length) {
    const searchBox = searchInput.closest('.sidebar-search');
    const suggestions = document.createElement('div');
    suggestions.className = 'search-suggestions';
    suggestions.hidden = true;
    searchBox?.appendChild(suggestions);

    const emptyState = document.createElement('p');
    emptyState.className = 'sidebar-empty-state';
    emptyState.hidden = true;
    emptyState.textContent = 'No hay módulos para esta búsqueda.';
    document.querySelector('.modules-sidebar')?.appendChild(emptyState);

    let closeCategoryPicker = () => {};

    if (categoryFilter) {
      const filterBox = categoryFilter.closest('.sidebar-filter');
      const picker = document.createElement('div');
      picker.className = 'filter-picker';
      picker.innerHTML = `
        <button class="filter-picker-button" type="button" aria-expanded="false">
          <span class="filter-picker-label"></span>
          <i class="bi bi-funnel filter-picker-icon"></i>
        </button>
        <div class="filter-picker-menu" hidden></div>
      `;

      const pickerButton = picker.querySelector('.filter-picker-button');
      const pickerLabel = picker.querySelector('.filter-picker-label');
      const pickerMenu = picker.querySelector('.filter-picker-menu');

      const syncPickerLabel = () => {
        const selectedOption = categoryFilter.options[categoryFilter.selectedIndex];
        pickerLabel.textContent = selectedOption?.textContent || 'Todas las categorias';
        pickerMenu.querySelectorAll('.filter-picker-option').forEach(item => {
          item.classList.toggle('is-selected', item.dataset.value === categoryFilter.value);
        });
      };

      const closePicker = () => {
        pickerButton.setAttribute('aria-expanded', 'false');
        pickerMenu.hidden = true;
      };

      closeCategoryPicker = closePicker;

      Array.from(categoryFilter.options).forEach(option => {
        const item = document.createElement('button');
        item.type = 'button';
        item.className = 'filter-picker-option';
        item.dataset.value = option.value;
        item.textContent = option.textContent;
        item.addEventListener('click', () => {
          categoryFilter.value = option.value;
          syncPickerLabel();
          closePicker();
          categoryFilter.dispatchEvent(new Event('change', { bubbles: true }));
        });
        pickerMenu.appendChild(item);
      });

      pickerButton.addEventListener('click', event => {
        event.stopPropagation();
        suggestions.hidden = true;
        const isOpen = pickerButton.getAttribute('aria-expanded') === 'true';
        pickerButton.setAttribute('aria-expanded', String(!isOpen));
        pickerMenu.hidden = isOpen;
      });

      categoryFilter.addEventListener('change', syncPickerLabel);
      syncPickerLabel();
      filterBox?.appendChild(picker);
      filterBox?.classList.add('has-custom-filter');
    }

    const getMatches = () => {
      const query = normalize(searchInput.value);
      const selectedCategory = categoryFilter?.value || '';

      return moduleLinks.filter(link => {
        const title = normalize(link.textContent || '');
        const category = link.dataset.category || '';
        const matchesSearch = query === '' || title.includes(query);
        const matchesCategory = selectedCategory === '' || category === selectedCategory;

        return matchesSearch && matchesCategory;
      });
    };

    const renderSuggestions = (matches) => {
      const query = normalize(searchInput.value);
      suggestions.innerHTML = '';

      if (query === '') {
        suggestions.hidden = true;
        return;
      }

      matches.slice(0, 6).forEach(link => {
        const option = document.createElement('button');
        option.type = 'button';
        option.className = 'search-suggestion-item';
        option.textContent = link.textContent.trim();
        option.addEventListener('click', () => {
          searchInput.value = link.textContent.trim();
          applySidebarFilter();
          suggestions.hidden = true;
        });
        suggestions.appendChild(option);
      });

      suggestions.hidden = suggestions.children.length === 0;
    };

    const applySidebarFilter = () => {
      const matches = getMatches();
      const visibleLinks = new Set(matches);

      moduleLinks.forEach(link => {
        link.parentElement.hidden = !visibleLinks.has(link);
      });

      toggles.forEach(toggle => {
        const category = toggle.dataset.category;
        const list = document.querySelector(
          `.sidebar-modules[data-category="${category}"]`
        );

        if (!list) return;

        const hasVisibleItems = Array.from(list.querySelectorAll('.sidebar-module-item'))
          .some(item => !item.hidden);

        toggle.closest('.sidebar-section').hidden = !hasVisibleItems;

        if (hasVisibleItems && (searchInput.value.trim() !== '' || categoryFilter?.value)) {
          openList(toggle, list);
        } else if (!hasVisibleItems) {
          closeList(toggle, list);
        }
      });

      emptyState.hidden = matches.length !== 0;
      renderSuggestions(matches);
      refreshOpenHeights();
    };

    searchInput.addEventListener('input', event => {
      event.stopImmediatePropagation();
      applySidebarFilter();
      // Notify moduloApp about external search activity so it can shrink/expand
      try {
        const evt = new CustomEvent('modulo-search', { detail: { query: searchInput.value } });
        window.dispatchEvent(evt);
      } catch (e) {
        // ignore
      }
    });
    searchInput.addEventListener('focus', () => renderSuggestions(getMatches()));
    searchInput.addEventListener('keydown', event => {
      if (event.key === 'Escape') {
        suggestions.hidden = true;
        searchInput.blur();
      }
    });

    document.addEventListener('click', event => {
      if (!searchBox?.contains(event.target)) {
        suggestions.hidden = true;
      }

      closeCategoryPicker();
    });

    categoryFilter?.addEventListener('change', event => {
      event.stopImmediatePropagation();
      applySidebarFilter();
    });
    categoryFilter?.addEventListener('click', applySidebarFilter);
  }

  document.addEventListener('DOMContentLoaded', () => {
    toggles.forEach(toggle => {
      const category = toggle.dataset.category;
      const list = document.querySelector(
        `.sidebar-modules[data-category="${category}"]`
      );

      if (!list) return;

      if (list.classList.contains('open')) {
        openList(toggle, list);
      } else {
        closeList(toggle, list);
      }
    });
  });

})();

window.moduloApp = (options = {}) => ({
  apiBase: options.apiBase || '',
  glossaryPath: options.glossaryPath || '',
  modulos: [],
  terminosGlosario: [],
  masVistos: [],
  tePuedenInteresar: [],
  open: false,

  init() {
    if (!this.apiBase) {
      console.warn('moduloApp: apiBase no está definido');
      return;
    }
    // Load glossary immediately; modules are lazy-loaded on demand to save bandwidth.
    fetch(`${this.apiBase}/glosario`, { credentials: 'same-origin' }).then(this.checkOk).then(async (glossaryResponse) => {
      const glossaryArray = await glossaryResponse.json();
      this.terminosGlosario = Array.isArray(glossaryArray)
        ? glossaryArray.map(item => ({
            termino: String(item.termino || '').trim(),
            urlDefinicion: String(item.urlDefinicion || '').trim(),
          })).filter(entry => entry.termino && entry.urlDefinicion)
        : [];
    }).catch(error => {
      console.error('moduloApp glossary load error:', error);
    });

    // React to external search events (sidebar search)
    window.addEventListener('modulo-search', (e) => {
      try {
        const q = (e && e.detail && String(e.detail.query || '') ) || '';
        this.handleExternalSearch(q);
      } catch (err) {
        // ignore
      }
    });
  },

  searchQuery: '',
  compactMode: false,

  handleExternalSearch(query) {
    this.searchQuery = String(query || '');
    const q = this.searchQuery.trim();
    if (q !== '') {
      // Compress recommendations to save space while searching
      this.compactMode = true;
      this.open = false;
      // Ensure we have module data to show filtered compact results
      if ((!Array.isArray(this.modulos) || this.modulos.length === 0)) {
        this.fetchModules();
      }
    } else {
      this.compactMode = false;
    }
  },

  toggleOpen() {
    this.open = !this.open;
    if (this.open && (!Array.isArray(this.modulos) || this.modulos.length === 0)) {
      this.fetchModules();
    }
  },

  async fetchModules() {
    if (!this.apiBase) return;
    try {
      const resp = await fetch(`${this.apiBase}/modulos`, { credentials: 'same-origin' });
      this.checkOk(resp);
      const data = await resp.json();
      this.modulos = Array.isArray(data) ? data : [];
      this.updateSections();
    } catch (err) {
      console.error('fetchModules error', err);
    }
  },

  compactItems() {
    const q = String(this.searchQuery || '').toLowerCase().trim();
    if (q === '') {
      return Array.isArray(this.masVistos) ? this.masVistos.slice(0, 3) : [];
    }

    const list = Array.isArray(this.modulos) ? this.modulos : [];
    const matches = list.filter(it => (String(it.titulo || '')).toLowerCase().includes(q));
    if (matches.length > 0) return matches.slice(0, 3);
    return Array.isArray(this.masVistos) ? this.masVistos.slice(0, 3) : [];
  },

  updateSections() {
    const modules = Array.isArray(this.modulos) ? this.modulos : [];
    const sortedByViews = [...modules].sort((a, b) => {
      const scoreA = Number(a.vistas || 0);
      const scoreB = Number(b.vistas || 0);
      if (scoreA !== scoreB) return scoreB - scoreA;
      return new Date(b.fechaCreacion).getTime() - new Date(a.fechaCreacion).getTime();
    });

    this.masVistos = sortedByViews.slice(0, 3);

    const recent = [...modules].sort((a, b) => new Date(b.fechaCreacion).getTime() - new Date(a.fechaCreacion).getTime());
    const topIds = new Set(this.masVistos.map(item => item._id));
    this.tePuedenInteresar = recent.filter(item => !topIds.has(item._id)).slice(0, 3);
  },

  checkOk(response) {
    if (!response.ok) {
      throw new Error(`HTTP error ${response.status}`);
    }
    return response;
  },

  escapeHtml(value) {
    const div = document.createElement('div');
    div.textContent = value;
    return div.innerHTML;
  },

  buildRegex() {
    const terms = Array.from(new Set(this.terminosGlosario.map(item => item.termino.trim()).filter(Boolean)));
    if (terms.length === 0) {
      return null;
    }

    const escaped = terms
      .sort((a, b) => b.length - a.length)
      .map(term => term.replace(/[.*+?^${}()|[\]\\]/g, '\\$&'))
      .join('|');

    return new RegExp(`(?<![\\p{L}\\p{N}_])(${escaped})(?![\\p{L}\\p{N}_])`, 'giu');
  },

  procesarTextoGlosario(texto) {
    if (typeof texto !== 'string' || texto.trim() === '') {
      return '';
    }

    const safeText = this.escapeHtml(texto);
    const regex = this.buildRegex();
    if (!regex) {
      return safeText;
    }

    const glossaryMap = this.terminosGlosario.reduce((map, item) => {
      map[item.termino.toLowerCase()] = item.urlDefinicion;
      return map;
    }, {});

    return safeText.replace(regex, (match) => {
      const key = match.toLowerCase();
      const url = glossaryMap[key];
      if (!url) {
        return match;
      }
      return `<a href="${url}" class="glossary-link">${match}</a>`;
    });
  },

  irAModulo(modulo) {
    if (!modulo || !modulo._id || !modulo.url) {
      return;
    }

    fetch(`${this.apiBase}/modulos/${encodeURIComponent(modulo._id)}/click`, {
      method: 'POST',
      credentials: 'same-origin',
    }).finally(() => {
      window.location.href = modulo.url;
    });
  },
});

// Page loader
(() => {
  const finishLoading = () => {
    document.body.classList.add('is-loaded');
  };

  window.addEventListener('load', finishLoading);
  window.setTimeout(finishLoading, 900);
})();
