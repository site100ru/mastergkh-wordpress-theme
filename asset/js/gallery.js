document.addEventListener('DOMContentLoaded', function () {
  const modalElement = document.getElementById('galleryModal');
  const modal = new bootstrap.Modal(modalElement);
  const glideWrapper = document.getElementById('glide-wrapper');
  if (!glideWrapper) return; // Блок не найден

  const glideCounter = document.getElementById('glide-counter');

  let images = [];
  let glide = null;
  let currentIndex = 0;

  // Collect gallery images
  document.querySelectorAll('.gallery-item img, .wp-block-gallery img').forEach((img, index) => {
    const caption = img.closest('figure')?.querySelector('figcaption')?.textContent?.trim() || '';
    images.push({ src: img.src, alt: img.alt, caption });

    img.dataset.index = index;
    img.style.cursor = 'pointer';
    img.addEventListener('click', () => {
      openModal(index);
    });
  });

  function openModal(startIndex) {
    currentIndex = startIndex || 0;

    // Build HTML for Glide
    let slidesHTML = images.map(img => `
      <li class="glide__slide text-center">
        <img src="${img.src}" class="img-fluid mx-auto d-block" alt="${img.alt}" style="max-height: 80vh;" />
        ${img.caption ? `<div class="text-white small mt-2">${img.caption}</div>` : ''}
      </li>
    `).join('');

    // Build thumbnails HTML
    let thumbsHTML = images.map((img, i) => `
      <img 
        src="${img.src}" 
        alt="${img.alt}" 
        class="img-thumbnail ${i === currentIndex ? 'border border-3 border-primary' : ''}" 
        style="cursor: grab;" 
        data-index="${i}" 
      />
    `).join('');

    // Insert HTML markup into modal - now with thumbs wrapper inside
    glideWrapper.innerHTML = `
      <div class="glide w-100 d-flex align-items-center">
        <div class="glide__track" data-glide-el="track">
          <ul class="glide__slides">${slidesHTML}</ul>
        </div>
        <div class="glide__arrows" data-glide-el="controls">
          <button class="glide__arrow glide__arrow--left" data-glide-dir="<">
            <img src="${galleryBlockVars.themeUrl}/asset/img/icons/arrow-left.svg" alt="Назад" />
          </button>
          <button class="glide__arrow glide__arrow--right" data-glide-dir=">">
            <img src="${galleryBlockVars.themeUrl}/asset/img/icons/arrow-right.svg" alt="Вперёд" />
          </button>
        </div>
      </div>
      
      <!-- Image description and thumbnails now inside glide-wrapper -->
      <div class="glide-thumbs-wrapper">
        <div id="glide-image-description" class="text-center text-white mb-3">
          ${images[currentIndex]?.alt || ''}
        </div>
        <div id="glide-thumbs" class="d-flex justify-content-center gap-2 flex-wrap">
          ${thumbsHTML}
        </div>
      </div>
    `;

    // Set up click events for thumbnails (since they're now created dynamically)
    document.querySelectorAll('#glide-thumbs img').forEach(thumb => {
      thumb.addEventListener('click', () => {
        const index = parseInt(thumb.dataset.index);
        if (glide) glide.go(`=${index}`);
      });
    });

    // Update counter
    glideCounter.textContent = `${currentIndex + 1} / ${images.length}`;

    // Show modal first
    modal.show();
  }

  // Function to update image description
  function updateImageDescription(index) {
    const descriptionEl = document.getElementById('glide-image-description');
    if (descriptionEl) {
      const description = images[index]?.alt || '';
      descriptionEl.textContent = description;
    }
  }

  // Function to update thumbnail highlighting
  function updateThumbnails(index) {
    document.querySelectorAll('#glide-thumbs img').forEach((thumb, i) => {
      if (i === index) {
        thumb.classList.add('border', 'border-3', 'border-primary');
      } else {
        thumb.classList.remove('border', 'border-3', 'border-primary');
      }
    });
  }

  modalElement.addEventListener('shown.bs.modal', () => {
    document.documentElement.style.overflow = 'hidden';

    // Initialize Glide after modal is shown
    glide = new Glide('.glide', {
      type: 'carousel',
      startAt: currentIndex,
      perView: 1,
      gap: 0,
      animationDuration: 300
    });

    glide.on(['mount.after', 'run'], () => {
      // Update counter
      glideCounter.textContent = `${glide.index + 1} / ${images.length}`;

      // Update image description
      updateImageDescription(glide.index);

      // Update thumbnails
      updateThumbnails(glide.index);
    });

    glide.mount();
  });

  modalElement.addEventListener('hidden.bs.modal', () => {
    if (glide) {
      glide.destroy();
      glide = null;
    }
    glideWrapper.innerHTML = '';
    glideCounter.textContent = '';

    document.documentElement.style.overflow = 'hidden';
    document.documentElement.style.overflowY = '';
  });


});