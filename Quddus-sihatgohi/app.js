class SanatoriyApp {
    constructor() {
        this.init();
    }

    init() {
        this.initMobileMenu();
        this.initStickyHeader();
        this.initGalleryLightbox();
        this.initForms();
    }

    initMobileMenu() {
        const mobileMenuBtn = document.querySelector('.mobile-menu-btn');
        const navLinks = document.querySelector('.nav-links');
        
        if (mobileMenuBtn && navLinks) {
            mobileMenuBtn.addEventListener('click', () => {
                const isExpanded = mobileMenuBtn.getAttribute('aria-expanded') === 'true';
                mobileMenuBtn.setAttribute('aria-expanded', !isExpanded);
                navLinks.classList.toggle('active');
                mobileMenuBtn.innerHTML = isExpanded 
                    ? '<i class="fas fa-bars" aria-hidden="true"></i>' 
                    : '<i class="fas fa-times" aria-hidden="true"></i>';
            });
            
            document.querySelectorAll('.nav-links a').forEach(link => {
                link.addEventListener('click', () => {
                    mobileMenuBtn.setAttribute('aria-expanded', 'false');
                    navLinks.classList.remove('active');
                    mobileMenuBtn.innerHTML = '<i class="fas fa-bars" aria-hidden="true"></i>';
                });
            });
        }
    }

    initStickyHeader() {
        window.addEventListener('scroll', () => {
            const header = document.querySelector('header');
            if (header) {
                header.classList.toggle('sticky', window.scrollY > 0);
            }
        });
    }

    initGalleryLightbox() {
        const galleryItems = document.querySelectorAll('.gallery-item');
        
        galleryItems.forEach(item => {
            item.addEventListener('click', (e) => {
                e.preventDefault();
                const imgSrc = item.querySelector('img').src;
                this.showLightbox(imgSrc);
            });
        });
    }

    showLightbox(imgSrc) {
        const lightbox = document.createElement('div');
        lightbox.className = 'lightbox';
        lightbox.innerHTML = `
            <div class="lightbox-content">
                <img src="${imgSrc}" alt="Gallery image">
                <button class="lightbox-close" aria-label="Yopish">&times;</button>
            </div>
        `;
        
        document.body.appendChild(lightbox);
        
        lightbox.querySelector('.lightbox-close').addEventListener('click', () => {
            lightbox.remove();
        });
        
        lightbox.addEventListener('click', (e) => {
            if (e.target === lightbox) {
                lightbox.remove();
            }
        });
    }

    initForms() {
    const reservationForm = document.getElementById('reservationForm');
    if (reservationForm) {
        reservationForm.addEventListener('submit', async (e) => {
            e.preventDefault();
            
            // FormData obyektini yaratish
            const formData = new FormData(reservationForm);
            const data = Object.fromEntries(formData.entries());
            
            try {
                console.log('Sending request to backend...');
                
                const response = await fetch('http://localhost:8000/api/bookings', {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json',
                        'Accept': 'application/json'
                    },
                    body: JSON.stringify(data)
                });
                
                console.log('Response status:', response.status);
                
                const responseData = await response.json();
                console.log('Response data:', responseData);
                
                if (response.ok) {
                    this.showNotification('Arizangiz qabul qilindi! Tez orada siz bilan bog\'lanamiz.', 'success');
                    reservationForm.reset();
                } else {
                    let errorMessage = 'Xatolik yuz berdi';
                    if (responseData.errors) {
                        errorMessage = Object.values(responseData.errors).join(', ');
                    } else if (responseData.message) {
                        errorMessage = responseData.message;
                    }
                    throw new Error(errorMessage);
                }
            } catch (error) {
                console.error('Fetch error:', error);
                this.showNotification(error.message, 'error');
            }
        });
    }
    }

    showNotification(message, type = 'success') {
        const notification = document.createElement('div');
        notification.className = `notification ${type}`;
        notification.textContent = message;
        
        document.body.appendChild(notification);
        
        setTimeout(() => {
            notification.classList.add('show');
        }, 100);
        
        setTimeout(() => {
            notification.classList.remove('show');
            setTimeout(() => {
                notification.remove();
            }, 300);
        }, 5000);
    }
}

document.addEventListener('DOMContentLoaded', () => {
    new SanatoriyApp();
});