// Define store configuration
const portfolioStoreConfig = {
  menuOpen: false,
  currentSection: 'home',
  menuItems: window.JOSE_PORTFOLIO?.menuItems || [],

  init() {
    if (window.JOSE_PORTFOLIO?.defaultSection) {
      this.currentSection = window.JOSE_PORTFOLIO.defaultSection;
    }
    // Guard: ensure current section exists, default to 'home' if not found or if menuItems is empty
    if (!this.menuItems.length || !this.menuItems.some(i => i.id === this.currentSection)) {
      this.currentSection = 'home';
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
};

// Register store - this runs in head before Alpine loads
(function() {
  const registerStore = () => {
    if (typeof Alpine !== 'undefined' && Alpine.store) {
      Alpine.store('portfolio', portfolioStoreConfig);
      return true;
    }
    return false;
  };

  // Listen for alpine:init event (fires before Alpine processes DOM)
  document.addEventListener('alpine:init', registerStore);
  
  // Also try to register immediately if Alpine is already available
  // This handles the case where Alpine loads before this script
  if (document.readyState === 'loading') {
    document.addEventListener('DOMContentLoaded', () => {
      if (!registerStore()) {
        // If still not registered, try again after a short delay
        setTimeout(registerStore, 0);
      }
    });
  } else {
    registerStore();
  }
})();
