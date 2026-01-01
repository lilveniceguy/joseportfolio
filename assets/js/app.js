document.addEventListener('alpine:init', () => {
  Alpine.store('portfolio', {
    menuOpen: false,
    currentSection: 'home',
    menuItems: window.JOSE_PORTFOLIO?.menuItems || [],

    init() {
      if (window.JOSE_PORTFOLIO?.defaultSection) {
        this.currentSection = window.JOSE_PORTFOLIO.defaultSection;
      }
      // Guard: ensure current section exists
      if (!this.menuItems.some(i => i.id === this.currentSection) && this.menuItems.length) {
        this.currentSection = this.menuItems[0].id;
      }
    },

    toggleMenu() { this.menuOpen = !this.menuOpen; },
    openMenu() { this.menuOpen = true; },
    closeMenu() { this.menuOpen = false; },

    setSection(id) {
      this.currentSection = id;
      this.menuOpen = false;
    },

    isActive(id) { return this.currentSection === id; },

    currentItem() {
      return this.menuItems.find(i => i.id === this.currentSection) || this.menuItems[0] || null;
    },
  });
});
