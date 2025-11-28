<?php
/**
 * Template Name: Front Page
 * Description: Шаблон для главной страницы сайта.
 */

get_header(); // подключаем header.php
?>

<section>

  <?php
  // Проверим, есть ли контент у страницы
  while (have_posts()):
    the_post();
    the_content();
  endwhile;
  ?>

</section>

<script>
    document.addEventListener('DOMContentLoaded', function () {
        // ИСПРАВЛЕННАЯ функция расчета стоимости по принципу 1+1=3
        function calculatePrice(selectedCount, basePrice = 5000) {
            if (selectedCount === 0) return 0;

            // Универсальная формула: каждые 3 услуги стоят как 2
            const fullGroups = Math.floor(selectedCount / 3);  // Полные группы по 3
            const remainder = selectedCount % 3;               // Остаток

            return (fullGroups * 2 + remainder) * basePrice;
        }

        // Обновление цены и управление формой
        function updatePriceAndForm() {
            const checkboxes = document.querySelectorAll('.page-service-checkbox');
            const selectedServices = Array.from(checkboxes).filter(cb => cb.checked);

            // Находим ВСЕ элементы цены (и для мобильной, и для десктопной версии)
            const priceElements = document.querySelectorAll('.price');
            // Находим ВСЕ кнопки модального окна
            const submitButtons = document.querySelectorAll('[data-bs-target="#contactModalPrice"]');

            // Расчет стоимости
            const totalPrice = calculatePrice(selectedServices.length);

            // Обновляем отображение цены во ВСЕХ элементах
            priceElements.forEach(priceElement => {
                if (priceElement) {
                    priceElement.textContent = totalPrice.toLocaleString('ru-RU') + ' р';
                }
            });

            // Активируем/деактивируем ВСЕ кнопки
            submitButtons.forEach(submitButton => {
                if (submitButton) {
                    if (selectedServices.length > 0) {
                        submitButton.disabled = false;
                        submitButton.classList.remove('disabled');
                    } else {
                        submitButton.disabled = true;
                        submitButton.classList.add('disabled');
                    }
                }
            });

            // Сохраняем выбранные услуги для передачи в модальное окно
            window.selectedPageServices = selectedServices.map(cb => ({
                id: cb.dataset.serviceId,
                title: cb.dataset.serviceTitle,
                price: parseInt(cb.dataset.servicePrice),
                category: cb.dataset.serviceCategory
            }));

            window.selectedPageServicesTotal = totalPrice;
        }

        // Добавляем обработчики для всех чекбоксов услуг на странице
        const pageCheckboxes = document.querySelectorAll('.page-service-checkbox');
        pageCheckboxes.forEach(checkbox => {
            checkbox.addEventListener('change', updatePriceAndForm);
        });

        // Инициализация
        updatePriceAndForm();

        // Обработчик открытия модального окна для ВСЕХ кнопок
        const modalTriggers = document.querySelectorAll('[data-bs-target="#contactModalPrice"]');
        modalTriggers.forEach(modalTrigger => {
            modalTrigger.addEventListener('click', function (e) {
                if (window.selectedPageServices && window.selectedPageServices.length > 0) {
                    // Передаем данные в модальное окно
                    setTimeout(() => {
                        populateModalWithServices();
                    }, 100);
                } else {
                    e.preventDefault();
                    return false;
                }
            });
        });
    });

    // Функция заполнения модального окна выбранными услугами
    function populateModalWithServices() {
        if (!window.selectedPageServices) return;

        // Ищем контейнер для услуг в модальном окне
        const modalServicesContainer = document.querySelector('#contactModalPrice .services-display');
        if (!modalServicesContainer) {
            // Создаем контейнер если его нет
            const modalBody = document.querySelector('#contactModalPrice .modal-body');
            if (modalBody) {
                const servicesHTML = `
                <div class="services-display mb-3">
                    <label class="form-label">Выбранные услуги:</label>
                    <div class="selected-services-list" id="modalServicesList"></div>
                    <div class="promotion-hint mb-2">
                        <small class="text-muted">🎉 Действует акция: каждая 3-я услуга бесплатно!</small>
                    </div>
                </div>
            `;

                // Вставляем перед последним элементом (кнопками)
                const lastElement = modalBody.querySelector('.mb-3:last-child');
                if (lastElement) {
                    lastElement.insertAdjacentHTML('beforebegin', servicesHTML);
                } else {
                    modalBody.insertAdjacentHTML('afterbegin', servicesHTML);
                }
            }
        }

        // Заполняем список услуг
        const servicesList = document.querySelector('#modalServicesList');
        if (servicesList) {
            servicesList.innerHTML = '';
            window.selectedPageServices.forEach((service, index) => {
                const serviceElement = document.createElement('div');
                serviceElement.className = 'service-item mb-1';

                // Определяем, какие услуги бесплатные (каждая 3-я)
                const isFreeDueToPromotion = (index + 1) % 3 === 0;

                serviceElement.innerHTML = `
                <span class="service-name">
                    ${service.title}
                </span>
                <input type="hidden" name="selected_services[]" value="${service.title}">
            `;
                servicesList.appendChild(serviceElement);
            });
        }

        // Обновляем общую стоимость
        const totalPriceElement = document.querySelector('#modalTotalPrice');
        if (totalPriceElement) {
            totalPriceElement.textContent = window.selectedPageServicesTotal.toLocaleString('ru-RU') + ' р';
        }
    }

    // Функция для добавления анимации обновления цены
    window.animatePriceUpdate = function () {
        const priceElements = document.querySelectorAll('.price');
        priceElements.forEach(priceElement => {
            if (priceElement) {
                priceElement.classList.add('price-updated');
                setTimeout(() => {
                    priceElement.classList.remove('price-updated');
                }, 500);
            }
        });
    };

    // Дополнительные функции для работы с модальным окном
    document.addEventListener('DOMContentLoaded', function () {
        // Обработчик события показа модального окна
        const contactModal = document.getElementById('contactModalPrice');
        if (contactModal) {
            contactModal.addEventListener('shown.bs.modal', function () {
                // Фокус на первое поле при открытии модального окна
                const firstInput = contactModal.querySelector('input[type="text"], input[type="tel"]');
                if (firstInput) {
                    setTimeout(() => firstInput.focus(), 100);
                }

                // Показываем блок с услугами если он скрыт
                const servicesDisplay = contactModal.querySelector('.services-display');
                if (servicesDisplay && window.selectedPageServices && window.selectedPageServices.length > 0) {
                    servicesDisplay.style.display = 'block';
                }
            });

            // Обработчик закрытия модального окна
            contactModal.addEventListener('hidden.bs.modal', function () {
                // Очищаем форму при закрытии
                const form = contactModal.querySelector('.wpcf7-form');
                if (form) {
                    form.reset();
                }
            });
        }

        // Улучшенная функция заполнения модального окна
        window.populateModalWithServices = function () {
            if (!window.selectedPageServices || window.selectedPageServices.length === 0) return;

            const modal = document.getElementById('contactModalPrice');
            if (!modal) return;

            // Ищем или создаем контейнер для услуг
            let servicesDisplay = modal.querySelector('.services-display');
            if (!servicesDisplay) {
                const modalBody = modal.querySelector('.modal-body');
                if (modalBody) {
                    const servicesHTML = `
                        <div class="services-display mb-3">
                            <label class="form-label">Выбранные услуги:</label>
                            <div class="selected-services-list" id="modalServicesList"></div>
                            <div class="promotion-hint">
                                <small class="text-muted">🎉 Действует акция: при выборе 3 услуг третья - бесплатно!</small>
                            </div>
                            <input type="hidden" name="total_price" id="hiddenTotalPrice" value="">
                        </div>
                    `;

                    // Вставляем перед полем согласия
                    const acceptanceField = modalBody.querySelector('.form-check');
                    if (acceptanceField) {
                        acceptanceField.insertAdjacentHTML('beforebegin', servicesHTML);
                        servicesDisplay = modal.querySelector('.services-display');
                    }
                }
            }

            // Заполняем список услуг
            const servicesList = modal.querySelector('#modalServicesList');
            if (servicesList) {
                servicesList.innerHTML = '';
                window.selectedPageServices.forEach((service, index) => {
                    const serviceElement = document.createElement('div');
                    serviceElement.className = 'service-item';
                    serviceElement.innerHTML = `
                        <span class="service-name"> 
                            ${service.title}
                        </span>
                        <input type="hidden" name="selected_services[]" value="${service.title}">
                    `;
                    servicesList.appendChild(serviceElement);
                });
            }

            // Обновляем общую стоимость
            const totalPriceElement = modal.querySelector('#modalTotalPrice');
            const hiddenPriceElement = modal.querySelector('#hiddenTotalPrice');
            if (totalPriceElement && hiddenPriceElement) {
                const formattedPrice = window.selectedPageServicesTotal.toLocaleString('ru-RU') + ' р';
                totalPriceElement.textContent = formattedPrice;
                hiddenPriceElement.value = window.selectedPageServicesTotal;
            }

            // Показываем контейнер
            if (servicesDisplay) {
                servicesDisplay.style.display = 'block';
            }
        };
    });
</script>

<?php
get_footer(); // подключаем footer.php
?>