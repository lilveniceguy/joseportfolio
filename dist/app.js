// Define store configuration
const portfolioStoreConfig = {
  menuOpen: false,
  currentSection: 'home',
  menuItems: window.JOSE_PORTFOLIO?.menuItems || [],

  // Album grid state
  albumGrid: {
    colorIndex: 0,
    tagNames: window.JOSE_PORTFOLIO?.tagNames || [],
    squareTags: {},
    squareTextVisible: {},
    squareOpacity: {},
    colorInterval: null,
  },

  init() {
    if (window.JOSE_PORTFOLIO?.defaultSection) {
      this.currentSection = window.JOSE_PORTFOLIO.defaultSection;
    }
    // Guard: ensure current section exists, default to 'home' if not found or if menuItems is empty
    if (!this.menuItems.length || !this.menuItems.some(i => i.id === this.currentSection)) {
      this.currentSection = 'home';
    }
    
    // Don't initialize album grid here - it will be initialized when tags are set in x-init
  },

  initAlbumGrid() {
    // Initialize opacity states for color transitions
    this.albumGrid.squareOpacity = {};
    for (let i = 0; i < 9; i++) {
      this.albumGrid.squareOpacity[i] = 0;
    }
    
    // Rotate colors every second
    if (this.albumGrid.colorInterval) {
      clearInterval(this.albumGrid.colorInterval);
    }
    this.albumGrid.colorInterval = setInterval(() => {
      const oldBluePos = this.albumGrid.colorIndex % 9;
      const oldOrangePos = (this.albumGrid.colorIndex + 4) % 9;
      
      // Fade out: hide text and reduce opacity on squares losing color
      this.albumGrid.squareTextVisible[oldBluePos] = false;
      this.albumGrid.squareTextVisible[oldOrangePos] = false;
      this.albumGrid.squareOpacity[oldBluePos] = 0;
      this.albumGrid.squareOpacity[oldOrangePos] = 0;
      
      // Update color index
      this.albumGrid.colorIndex = (this.albumGrid.colorIndex + 1) % 9;
      
      const newBluePos = this.albumGrid.colorIndex % 9;
      const newOrangePos = (this.albumGrid.colorIndex + 4) % 9;
      
      // Generate new random tags for newly illuminated squares
      if (this.albumGrid.tagNames && this.albumGrid.tagNames.length > 0) {
        this.albumGrid.squareTags[newBluePos] = this.albumGrid.tagNames[
          Math.floor(Math.random() * this.albumGrid.tagNames.length)
        ];
        this.albumGrid.squareTags[newOrangePos] = this.albumGrid.tagNames[
          Math.floor(Math.random() * this.albumGrid.tagNames.length)
        ];
      } else {
        // Fallback only if no tags available
        this.albumGrid.squareTags[newBluePos] = `Tag ${Math.floor(Math.random() * 100)}`;
        this.albumGrid.squareTags[newOrangePos] = `Tag ${Math.floor(Math.random() * 100)}`;
      }
      
      // Fade in: increase opacity on new squares
      setTimeout(() => {
        this.albumGrid.squareOpacity[newBluePos] = 1;
        this.albumGrid.squareOpacity[newOrangePos] = 1;
      }, 50);
      
      // Show text after a delay (when square is illuminated)
      setTimeout(() => {
        this.albumGrid.squareTextVisible[newBluePos] = true;
        this.albumGrid.squareTextVisible[newOrangePos] = true;
      }, 350); // 350ms delay after color starts fading in
    }, 1300); // 1.3 seconds
    
    // Initialize first squares
    const initialBluePos = this.albumGrid.colorIndex % 9;
    const initialOrangePos = (this.albumGrid.colorIndex + 4) % 9;
    
    if (this.albumGrid.tagNames && this.albumGrid.tagNames.length > 0) {
      this.albumGrid.squareTags[initialBluePos] = this.albumGrid.tagNames[
        Math.floor(Math.random() * this.albumGrid.tagNames.length)
      ];
      this.albumGrid.squareTags[initialOrangePos] = this.albumGrid.tagNames[
        Math.floor(Math.random() * this.albumGrid.tagNames.length)
      ];
    }
    
    // Set initial opacity
    setTimeout(() => {
      this.albumGrid.squareOpacity[initialBluePos] = 1;
      this.albumGrid.squareOpacity[initialOrangePos] = 1;
      this.albumGrid.squareTextVisible[initialBluePos] = true;
      this.albumGrid.squareTextVisible[initialOrangePos] = true;
    }, 350);
  },

  getRandomTag(index) {
    return this.albumGrid.squareTags[index] || '';
  },

  isTextVisible(index) {
    return this.albumGrid.squareTextVisible[index] || false;
  },

  getSquareClass(index) {
    const bluePos = this.albumGrid.colorIndex % 9;
    const orangePos = (this.albumGrid.colorIndex + 4) % 9;
    const opacity = this.albumGrid.squareOpacity[index] || 0;
    
    let baseClass = 'bg-gradient-to-br shadow-lg transition-all duration-700 ease-in-out';
    
    if (index === bluePos) {
      return `${baseClass} from-brand-blue to-brand-blue/80 shadow-brand-blue/40`;
    } else if (index === orangePos) {
      return `${baseClass} from-brand-orange to-brand-orange/80 shadow-brand-orange/40`;
    } else {
      return `${baseClass} from-surface-700 to-surface-800`;
    }
  },

  getSquareOpacity(index) {
    const bluePos = this.albumGrid.colorIndex % 9;
    const orangePos = (this.albumGrid.colorIndex + 4) % 9;
    
    if (index === bluePos || index === orangePos) {
      return this.albumGrid.squareOpacity[index] || 0;
    }
    return 1; // Gray squares are always fully visible
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
