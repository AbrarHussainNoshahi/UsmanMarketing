document.addEventListener('DOMContentLoaded', () => {

const lenis = new Lenis();
lenis.on('scroll', ScrollTrigger.update);

gsap.ticker.add((time) => {
  lenis.raf(time * 1000); 
});

gsap.registerPlugin(ScrollTrigger);
  
const elements = {
    pageContainer: document.querySelector('.page-container'),
    videoPlaceholder: document.getElementById('video-placeholder'),
    video: document.getElementById('vsl-video'),
    playButton: document.querySelector('.play-button'),
    buttons: document.querySelectorAll('.alt-button'),
    vslContainer: document.querySelector('.vsl-container'),
    vslGradientBorder: document.querySelector('.vsl-gradient-border'),
    featureCards: document.querySelectorAll('.feature-card'),
    gradientOverlay: document.querySelector('.gradient-overlay'),
    highlights: document.querySelectorAll('.highlight'),
    cards: document.querySelectorAll('.card')
};
  
gsap.set(elements.pageContainer, { display: 'block', opacity: 1 });

  if (elements.video && elements.videoPlaceholder) {
    elements.video.pause();
    
    
elements.videoPlaceholder.addEventListener('click', () => {
      if (!elements.video.getAttribute('src') && elements.video.querySelector('source')) {
        const source = elements.video.querySelector('source');
        elements.video.setAttribute('src', source.getAttribute('src'));
        elements.video.load();
        
        elements.video.addEventListener('loadedmetadata', function onceLoaded() {
          elements.video.removeEventListener('loadedmetadata', onceLoaded);
          elements.videoPlaceholder.style.display = 'none';
          elements.video.play();
        }, { once: true });
      } else {
        elements.videoPlaceholder.style.display = 'none';
        elements.video.play();
      }
});
    
elements.video.addEventListener('ended', () => {
      elements.videoPlaceholder.style.display = 'flex';
  });
}
  
const initAnimations = () => {
    gsap.timeline({
      defaults: { ease: 'power2.out', duration: 0.8 }
    })
    .set(elements.pageContainer, { opacity: 1 })
    .to('.gradient-overlay', { opacity: 1, duration: 1, ease: 'power2.inOut' }, 0.2)
    .to('.content, .logo, .header-button, h1, .subtitle, .vsl-container, .hero-button, .button-container', 
      { opacity: 1, y: 0, stagger: 0.1 }, 0.4);
    
    if (elements.featureCards.length) {
      gsap.from('.feature-card', {
        opacity: 0,
        y: 20,
        duration: 0.5,
        stagger: 0.05,
        scrollTrigger: {
          trigger: '.feature-card',
          start: "top 85%",
          once: true
        }
      });
    }
};
  
  // Optimize button interactions using delegation
  const setupButtonInteractions = () => {
    document.body.addEventListener('mouseenter', (e) => {
      if (e.target.closest('.button-container')) {
        gsap.to(e.target.closest('.button-container'), { scale: 1.03, duration: 0.3 });
      }
    }, true);
    
    document.body.addEventListener('mouseleave', (e) => {
      if (e.target.closest('.button-container')) {
        gsap.to(e.target.closest('.button-container'), { scale: 1, duration: 0.3 });
      }
    }, true);
    
    document.body.addEventListener('click', (e) => {
      const button = e.target.closest('.alt-button');
      if (button) {
        e.preventDefault();
        const targetSection = document.querySelector('#join-form') || document.querySelector('footer');
        if (targetSection) {
          window.scrollTo({
            top: targetSection.offsetTop - 50,
            behavior: 'smooth'
          });
        }
      }
    });
  };
  
  // Use a single IntersectionObserver for all scroll animations
  const setupScrollAnimations = () => {
    const observerOptions = { threshold: 0.1, rootMargin: '0px 0px -10% 0px' };
    
    const scrollObserver = new IntersectionObserver((entries) => {
      entries.forEach(entry => {
        if (!entry.isIntersecting) return;
        
        const target = entry.target;
        
        // Handle different element types
        if (target.classList.contains('feature-card') || target.classList.contains('card')) {
          gsap.to(target, {
            opacity: 1,
            y: 0,
            duration: 0.4,
            ease: "power1.out"
          });
        }
        else if (target.classList.contains('vsl-container')) {
          gsap.to(target, {
            scale: 1.03, 
            duration: 0.4,
            ease: "power1.out",
            onComplete: () => {
              gsap.to(target, { scale: 1, duration: 0.4, delay: 1 });
            }
          });
        }
        
        // Stop observing this element
        scrollObserver.unobserve(target);
      });
    }, observerOptions);
    
    // Observe feature cards and other animatable elements
    const animatableElements = [
      ...elements.featureCards, 
      ...elements.cards
    ];
    
    if (elements.vslContainer) {
      animatableElements.push(elements.vslContainer);
    }
    
    // Set initial state and start observing
    animatableElements.forEach(el => {
      if (el.classList.contains('feature-card') || el.classList.contains('card')) {
        gsap.set(el, { opacity: 0, y: 15 });
      }
      scrollObserver.observe(el);
    });
  };
  
  // Replace multiple feature card handlers with CSS
  const setupFeatureCardInteractions = () => {
    const style = document.createElement('style');
    style.textContent = `
      .feature-card {
        transition: transform 0.3s ease, box-shadow 0.3s ease, border-color 0.3s ease;
      }
      .feature-card:hover {
        transform: translateY(-5px);
        box-shadow: 0 15px 30px rgba(0, 0, 0, 0.3);
        border-color: rgba(201, 166, 78, 0.4);
      }
    `;
    document.head.appendChild(style);
  };
  
  
  // Simplify play button animation if it exists
  if (elements.playButton) {
    gsap.to(elements.playButton, {
      y: -3,
      duration: 1.5,
      repeat: -1,
      yoyo: true, 
      ease: 'sine.inOut'
    });
  }
  
  // Run all optimized setup functions
  initAnimations();
  setupButtonInteractions();
  setupScrollAnimations();
  setupFeatureCardInteractions();
});
  
  // Register GSAP plugin once
document.addEventListener('DOMContentLoaded', function() {
  gsap.registerPlugin(ScrollTrigger);
  
  // Preconnect to resources
  ['https://fonts.googleapis.com', 'https://fonts.gstatic.com', 'https://cdnjs.cloudflare.com'].forEach(url => {
    const link = document.createElement('link');
    link.rel = 'preconnect';
    link.href = url;
    document.head.appendChild(link);
  });

  // Make page container visible immediately
  const pageContainer = document.querySelector('.page-container');
  if (pageContainer) {
    pageContainer.style.display = 'block';
    pageContainer.style.opacity = '1';
  }

  // Consolidate animations with a single timeline
  const mainTl = gsap.timeline();
  
  // Header animations - only trigger when visible
  mainTl.from(".kafla-eyebrow", {opacity: 0, y: 20, duration: 0.6, ease: "power3.out"})
       .from(".kafla-headline", {opacity: 0, y: 30, duration: 0.8, ease: "power3.out"})
       .from(".kafla-tagline", {opacity: 0, y: 20, duration: 0.8, ease: "power3.out"}, "-=0.4");
  
  ScrollTrigger.create({
    trigger: ".kafla-headline",
    start: "top 80%",
    animation: mainTl
  });

  // Feature items - batch for better performance
  const featureItems = document.querySelectorAll('.feature-item');
  gsap.set(featureItems, {opacity: 0, y: 20});
  
  ScrollTrigger.batch(featureItems, {
    start: "top 85%",
    onEnter: batch => gsap.to(batch, {
      opacity: 1, 
      y: 0, 
      duration: 0.6,
      stagger: 0.1,
      ease: "power2.out"
    }),
    once: true
  });

  // Timeline progress with reduced complexity
  const journeyTracker = ScrollTrigger.create({
    trigger: ".journey-container",
    start: "top center",
    end: "bottom center",
    onUpdate: self => {
      gsap.set(".journey-progress", {height: self.progress * 100 + "%"});
    }
  });

  // Process milestones - batch processing
  const milestones = document.querySelectorAll(".journey-milestone");
  milestones.forEach(milestone => {
    const badge = milestone.querySelector(".milestone-badge");
    const content = milestone.querySelector(".milestone-content");
    const direction = milestone.classList.contains("milestone-left") ? -40 : 40;
    
    ScrollTrigger.create({
      trigger: milestone,
      start: "top 75%",
      once: true,
      onEnter: () => {
        gsap.from(badge, {opacity: 0, scale: 0.5, duration: 0.6, ease: "back.out(1.7)"});
        gsap.from(content, {opacity: 0, x: direction, duration: 0.6, ease: "power3.out"});
      }
    });
  });

  // Reduce frequency of glow animations
  gsap.to(".glow-primary", {x: "10%", y: "5%", duration: 30, repeat: -1, yoyo: true, ease: "sine.inOut"});
  gsap.to(".glow-secondary", {x: "-10%", y: "-5%", duration: 40, repeat: -1, yoyo: true, ease: "sine.inOut"});
  gsap.to(".glow-center", {opacity: 0.02, duration: 6, repeat: -1, yoyo: true, ease: "sine.inOut"});

  // Handle responsive layout with ResizeObserver instead of constant checks
  const resizeObserver = new ResizeObserver(throttle(() => {
    updateJourneyLayout();
    ScrollTrigger.refresh();
  }, 250));
  
  resizeObserver.observe(document.body);
  
  function updateJourneyLayout() {
    const viewportWidth = window.innerWidth;
    const timelineRail = document.querySelector('.journey-rail');
    const timelineProgress = document.querySelector('.journey-progress');
    const milestoneMarkers = document.querySelectorAll('.milestone-marker');
    
    let position = '50%';
    if (viewportWidth <= 576) position = '25px';
    else if (viewportWidth <= 768) position = '30px';
    else if (viewportWidth <= 992) position = '40px';
    
    if (timelineRail) timelineRail.style.left = position;
    if (timelineProgress) timelineProgress.style.left = position;
    milestoneMarkers.forEach(marker => {
      marker.style.left = position;
    });
  }


  const stickyBar = document.getElementById('stickyBar');
  const trigger = document.getElementById('trigger');

  
  // Function to check if element is in viewport
  function isElementInViewport(el) {
    const rect = el.getBoundingClientRect();
    return (
      rect.top <= (window.innerHeight || document.documentElement.clientHeight)
    );
  }
  
  // Function to handle scroll event
  function handleScroll() {
    if (isElementInViewport(trigger)) {
      stickyBar.classList.add('visible');
    } else {
      stickyBar.classList.remove('visible');
    }
  }
  
  // Add scroll event listener
  window.addEventListener('scroll', handleScroll);
  
  // Check initial position
  handleScroll();

// Utility function
function throttle(func, limit) {
  let inThrottle;
  return function() {
    const args = arguments;
    const context = this;
    if (!inThrottle) {
      func.apply(context, args);
      inThrottle = true;
      setTimeout(() => inThrottle = false, limit);
    }
  };
}
  
 // Detect device capability once
const isMobile = window.innerWidth <= 576;
const isLowPerfDevice = /iPhone|iPad|iPod|Android/.test(navigator.userAgent) || isMobile;

// Reduce animations for low performance devices
const animationConfig = {
  duration: isLowPerfDevice ? 0.6 : 0.8,
  stagger: isLowPerfDevice ? 0.05 : 0.1,
  ease: "power2.out"
};

// ----------------- COUNTERS -----------------
// More efficient counter with RAF batching
const counters = {
  contentCounter: 23546,
  lessonsCounter: 2,
  modulesCounter: 13532
};

function startCounters() {
  const duration = isLowPerfDevice ? 1 : 2;
  const startTime = performance.now();
  const endTime = startTime + (duration * 1000);
  
  function updateAllCounters(timestamp) {
    const progress = Math.min((timestamp - startTime) / (duration * 1000), 1);
    
    // Update all counters in one RAF call
    Object.entries(counters).forEach(([id, endValue]) => {
      const element = document.getElementById(id);
      if (element) {
        element.textContent = Math.floor(progress * endValue);
      }
    });
    
    if (progress < 1) {
      requestAnimationFrame(updateAllCounters);
    }
  }
  
  requestAnimationFrame(updateAllCounters);
}

// ----------------- MAIN INITIALIZATION -----------------
  // Header animations - simpler timeline
  const header = document.querySelector('h1');
  const statsContainer = document.querySelector('.stats-container');
  
  if (header && statsContainer) {
    gsap.set([header, statsContainer], { opacity: 0 });
    
    // Use a single observer for header elements
    const headerObserver = new IntersectionObserver((entries) => {
      entries.forEach(entry => {
        if (entry.isIntersecting) {
          if (entry.target === header) {
            gsap.to(header, { opacity: 1, y: 0, duration: 0.8 });
          } else if (entry.target === statsContainer) {
            gsap.to(statsContainer, { opacity: 1, y: 0, duration: 0.8 });
            startCounters();
          }
          headerObserver.unobserve(entry.target);
        }
      });
    }, { threshold: 0.2 });
    
    headerObserver.observe(header);
    headerObserver.observe(statsContainer);
  }
  

// ----------------- FAQ SECTION -----------------
const faqContainer = document.querySelector('.faq-container');
if (faqContainer) {
  faqContainer.addEventListener('click', e => {
    const question = e.target.closest('.faq-question');
    if (!question) return;
    
    const item = question.parentNode;
    const wasOpen = item.classList.contains('open');
    
    // Close all items with a single selector operation
    const openItems = faqContainer.querySelectorAll('.faq-item.open');
    for (let i = 0; i < openItems.length; i++) {
      openItems[i].classList.remove('open');
    }
    
    // Toggle open state
    if (!wasOpen) item.classList.add('open');
  });
}

// ----------------- SCROLL EFFECTS -----------------
const nav = document.querySelector("nav");
const goTopBtn = document.getElementById("go-top");

// Use a single IntersectionObserver for all fade elements
if (document.querySelectorAll(".fade-in").length > 0) {
  const fadeObserver = new IntersectionObserver(entries => {
    for (let i = 0; i < entries.length; i++) {
      entries[i].target.classList.toggle('visible', entries[i].isIntersecting);
    }
  }, { threshold: 0.1 });
  
  const fadeIns = document.querySelectorAll(".fade-in");
  for (let i = 0; i < fadeIns.length; i++) {
    fadeObserver.observe(fadeIns[i]);
  }
}

// Scroll handler (no throttle dependency)
let ticking = false;
let lastScrollY = window.scrollY;

function onScroll() {
  lastScrollY = window.scrollY;
  
  if (!ticking) {
    window.requestAnimationFrame(() => {
      // Nav background
      if (nav) {
        nav.classList.toggle('nav-scrolled', lastScrollY > 50);
      }
      
      // Go-to-top button
      if (goTopBtn) {
        goTopBtn.classList.toggle('visible', lastScrollY > 300);
      }
      
      ticking = false;
    });
    
    ticking = true;
  }
}

// Passive event listener for better scroll performance
window.addEventListener('scroll', onScroll, { passive: true });

// Go to top button functionality
if (goTopBtn) {
  goTopBtn.addEventListener('click', () => {
    window.scrollTo({ top: 0, behavior: 'smooth' });
  });
}

// Initialize states
onScroll();})

        class ModernCarousel {
            constructor() {
                this.currentSlide = 0;
                this.totalSlides = 10;
                this.isAnimating = false;
                this.touchStartX = 0;
                this.touchEndX = 0;
                this.isDragging = false;
                
                this.initializeElements();
                this.generateSlides();
                this.generateIndicators();
                this.attachEventListeners();
                this.updateCarousel();
                this.startAutoplay();
            }
            
            initializeElements() {
                this.track = document.getElementById('carouselTrack');
                this.prevBtn = document.getElementById('prevBtn');
                this.nextBtn = document.getElementById('nextBtn');
                this.indicators = document.getElementById('indicators');
                this.slideCounter = document.getElementById('slideCounter');
                this.progressBar = document.getElementById('progressBar');
                this.currentSlideSpan = document.getElementById('currentSlide');
                this.totalSlidesSpan = document.getElementById('totalSlides');
            }
            
            generateSlides() {
                const achievements = [
                    "Canva Pro Access",
                ];
                
                for (let i = 1; i <= this.totalSlides; i++) {
                    const slide = document.createElement('div');
                    slide.className = 'carousel-slide';
                    slide.innerHTML = `
                        <div class="slide-content">
                            <img src="./imgs/wins/${i}.jpeg" alt="Student Achievement ${i}" loading="lazy">
                            <div class="slide-overlay">
                        
                            </div>
                        </div>
                    `;
                    this.track.appendChild(slide);
                }
                
                this.totalSlidesSpan.textContent = this.totalSlides;
            }
            
            generateIndicators() {
                for (let i = 0; i < this.totalSlides; i++) {
                    const indicator = document.createElement('div');
                    indicator.className = 'indicator';
                    indicator.addEventListener('click', () => this.goToSlide(i));
                    this.indicators.appendChild(indicator);
                }
            }
            
            attachEventListeners() {
                this.prevBtn.addEventListener('click', () => this.previousSlide());
                this.nextBtn.addEventListener('click', () => this.nextSlide());
                
                // Touch events
                this.track.addEventListener('touchstart', (e) => this.handleTouchStart(e), { passive: true });
                this.track.addEventListener('touchmove', (e) => this.handleTouchMove(e), { passive: false });
                this.track.addEventListener('touchend', (e) => this.handleTouchEnd(e), { passive: true });
                
                // Mouse events for desktop dragging
                this.track.addEventListener('mousedown', (e) => this.handleMouseDown(e));
                this.track.addEventListener('mousemove', (e) => this.handleMouseMove(e));
                this.track.addEventListener('mouseup', (e) => this.handleMouseUp(e));
                this.track.addEventListener('mouseleave', (e) => this.handleMouseUp(e));
                
                // Keyboard navigation
                document.addEventListener('keydown', (e) => {
                    if (e.key === 'ArrowLeft') this.previousSlide();
                    if (e.key === 'ArrowRight') this.nextSlide();
                });
                
                // Pause autoplay on hover
                this.track.addEventListener('mouseenter', () => this.pauseAutoplay());
                this.track.addEventListener('mouseleave', () => this.startAutoplay());
            }
            
            handleTouchStart(e) {
                this.touchStartX = e.touches[0].clientX;
                this.isDragging = true;
                this.track.classList.add('dragging');
            }
            
            handleTouchMove(e) {
                if (!this.isDragging) return;
                e.preventDefault();
                this.touchEndX = e.touches[0].clientX;
            }
            
            handleTouchEnd(e) {
                if (!this.isDragging) return;
                this.isDragging = false;
                this.track.classList.remove('dragging');
                
                const difference = this.touchStartX - this.touchEndX;
                const threshold = 50;
                
                if (Math.abs(difference) > threshold) {
                    if (difference > 0) {
                        this.nextSlide();
                    } else {
                        this.previousSlide();
                    }
                }
            }
            
            handleMouseDown(e) {
                this.touchStartX = e.clientX;
                this.isDragging = true;
                this.track.classList.add('dragging');
                e.preventDefault();
            }
            
            handleMouseMove(e) {
                if (!this.isDragging) return;
                this.touchEndX = e.clientX;
            }
            
            handleMouseUp(e) {
                if (!this.isDragging) return;
                this.isDragging = false;
                this.track.classList.remove('dragging');
                
                const difference = this.touchStartX - this.touchEndX;
                const threshold = 50;
                
                if (Math.abs(difference) > threshold) {
                    if (difference > 0) {
                        this.nextSlide();
                    } else {
                        this.previousSlide();
                    }
                }
            }
            
            nextSlide() {
                if (this.isAnimating) return;
                this.goToSlide((this.currentSlide + 1) % this.totalSlides);
            }
            
            previousSlide() {
                if (this.isAnimating) return;
                this.goToSlide((this.currentSlide - 1 + this.totalSlides) % this.totalSlides);
            }
            
            goToSlide(index) {
                if (this.isAnimating || index === this.currentSlide) return;
                
                this.isAnimating = true;
                this.currentSlide = index;
                this.updateCarousel();
                
                setTimeout(() => {
                    this.isAnimating = false;
                }, 600);
            }
            
            updateCarousel() {
                const translateX = -this.currentSlide * 100;
                this.track.style.transform = `translateX(${translateX}%)`;
                
                // Update indicators
                const indicators = this.indicators.querySelectorAll('.indicator');
                indicators.forEach((indicator, index) => {
                    indicator.classList.toggle('active', index === this.currentSlide);
                });
                
                // Update navigation buttons
                this.prevBtn.classList.toggle('disabled', this.currentSlide === 0);
                this.nextBtn.classList.toggle('disabled', this.currentSlide === this.totalSlides - 1);
                
                // Update counter
                this.currentSlideSpan.textContent = this.currentSlide + 1;
                
                // Update progress bar
                const progress = ((this.currentSlide + 1) / this.totalSlides) * 100;
                this.progressBar.style.width = `${progress}%`;
            }
            
            startAutoplay() {
                this.autoplayInterval = setInterval(() => {
                    if (!this.isDragging) {
                        this.nextSlide();
                    }
                }, 5000);
            }
            
            pauseAutoplay() {
                clearInterval(this.autoplayInterval);
            }
        }
        
        // Initialize carousel when DOM is loaded
        document.addEventListener('DOMContentLoaded', () => {
            new ModernCarousel();
        });
        
        // Add image error handling
        document.addEventListener('error', (e) => {
            if (e.target.tagName === 'IMG') {
                e.target.style.display = 'none';
                const placeholder = document.createElement('div');
                placeholder.className = 'placeholder';
                placeholder.textContent = 'Image Loading...';
                placeholder.style.cssText = `
                    width: 100%;
                    height: 100%;
                    background: linear-gradient(45deg, #333, #555);
                    display: flex;
                    align-items: center;
                    justify-content: center;
                    color: white;
                    font-size: 1.2rem;
                `;
                e.target.parentNode.appendChild(placeholder);
            }
        }, true);