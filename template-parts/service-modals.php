<?php
/**
 * Template part for displaying service modals on single service pages
 */
?>

<!-- Modal for One-Time Services -->
<div class="modal fade" id="oneTimeServiceModal" tabindex="-1" aria-labelledby="oneTimeServiceModalLabel"
  aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered">
    <div class="modal-content position-relative">
      <!-- Крестик фиксированный в углу -->
      <button type="button" class="btn-close position-absolute top-0 end-0" data-bs-dismiss="modal"
        aria-label="Закрыть"></button>
      <!-- Заголовок -->
      <div class="modal-header border-0">
        <h5 class="modal-title text-center text-lg-start" id="oneTimeServiceModalLabel">
          Заявка на услугу
        </h5>
      </div>
      <!-- Тело модального окна -->
      <div class="modal-body">
        <?php
        // Форма для разовых услуг - замените ID на реальный
        echo do_shortcode('[contact-form-7 id="a44fd50" title="Разовая услуга (для страницы услуг)"]');
        ?>

        <div class="services-display mb-3" style="display: none;">
          <label class="form-label">Выбранная услуга:</label>
          <div class="selected-services-list" id="oneTimeSelectedServicesList"></div>
          <input type="hidden" name="preselected_service" id="oneTimePreselectedService" value="">
          <input type="hidden" name="service_category" value="one_time">
        </div>
      </div>
    </div>
  </div>
</div>

<!-- Modal for Annual Services -->
<div class="modal fade" id="annualServiceModal" tabindex="-1" aria-labelledby="annualServiceModalLabel"
  aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered">
    <div class="modal-content position-relative">
      <!-- Крестик фиксированный в углу -->
      <button type="button" class="btn-close position-absolute top-0 end-0" data-bs-dismiss="modal"
        aria-label="Закрыть"></button>
      <!-- Заголовок -->
      <div class="modal-header border-0">
        <h5 class="modal-title text-center text-lg-start" id="annualServiceModalLabel">
          Заявка на годовую услугу
        </h5>
      </div>
      <!-- Тело модального окна -->
      <div class="modal-body">
        <?php
        // Форма для годовых услуг - замените ID на реальный
        echo do_shortcode('[contact-form-7 id="d21b12e" title="Годовая услуга (для страницы услуг)"]');
        ?>

        <!-- Контейнер для отображения предзаполненной услуги -->
        <div class="services-display mb-3" style="display: none;">
          <label class="form-label">Выбранная услуга:</label>
          <div class="selected-services-list" id="annualSelectedServicesList"></div>
          <input type="hidden" name="preselected_service" id="annualPreselectedService" value="">
          <input type="hidden" name="service_category" value="annual">
        </div>
      </div>
    </div>
  </div>
</div>

<script>
  document.addEventListener('DOMContentLoaded', function () {
    // Функция для предзаполнения модального окна услугой
    function populateServiceModal(modalId, serviceTitle, serviceCategory) {
      const modal = document.getElementById(modalId);
      if (!modal) return;

      // Находим элементы для отображения услуги
      const servicesDisplay = modal.querySelector('.services-display');
      const servicesList = modal.querySelector('.selected-services-list');
      const preselectedInput = modal.querySelector('input[name="preselected_service"]');
      const modalTitle = modal.querySelector('.modal-title');

      if (servicesDisplay && servicesList && preselectedInput) {
        // Показываем блок с услугой
        servicesDisplay.style.display = 'block';

        // Очищаем предыдущий контент
        servicesList.innerHTML = '';

        // Добавляем услугу в список
        const serviceElement = document.createElement('div');
        serviceElement.className = 'service-item mb-1';
        serviceElement.innerHTML = `
                <span class="service-name">${serviceTitle}</span>
                <input type="hidden" name="selected_services[]" value="${serviceTitle}">
            `;
        servicesList.appendChild(serviceElement);

        // Устанавливаем значение в скрытое поле
        preselectedInput.value = serviceTitle;
      }
    }

    // Обработчики для кнопок заявок
    document.addEventListener('click', function (e) {
      const button = e.target.closest('[data-bs-toggle="modal"]');
      if (!button) return;

      const serviceTitle = button.getAttribute('data-service-title');
      const serviceCategory = button.getAttribute('data-service-category');
      const targetModal = button.getAttribute('data-bs-target');

      if (serviceTitle && serviceCategory && targetModal) {
        const modalId = targetModal.replace('#', '');

        // Небольшая задержка для корректного отображения модального окна
        setTimeout(() => {
          populateServiceModal(modalId, serviceTitle, serviceCategory);
        }, 100);
      }
    });

    // Очистка модальных окон при закрытии
    ['oneTimeServiceModal', 'annualServiceModal'].forEach(modalId => {
      const modal = document.getElementById(modalId);
      if (modal) {
        modal.addEventListener('hidden.bs.modal', function () {
          // Скрываем блок с услугами
          const servicesDisplay = this.querySelector('.services-display');
          if (servicesDisplay) {
            servicesDisplay.style.display = 'none';
          }

          // Очищаем список услуг
          const servicesList = this.querySelector('.selected-services-list');
          if (servicesList) {
            servicesList.innerHTML = '';
          }

          // Очищаем скрытые поля
          const preselectedInput = this.querySelector('input[name="preselected_service"]');
          if (preselectedInput) {
            preselectedInput.value = '';
          }

          // Сбрасываем форму
          const form = this.querySelector('.wpcf7-form');
          if (form) {
            form.reset();
          }
        });
      }
    });
  });
</script>