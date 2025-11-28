<!-- overlay -->
<div class="mobile-menu-overlay" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav"
  aria-expanded="true"></div>

<?php
$inn = get_field('inn', 'option');
$ep = get_field('ep', 'option');
$phone = get_field('phone', 'option');
$work_hours = get_field('work_hours', 'option');
$address_2 = get_field('address_2', 'option');
$company_name = get_bloginfo('name');
$current_year = date('Y');

$vk = get_field('vk_link', 'option');
$tg = get_field('telegram_link', 'option');
$ok = get_field('ok_link', 'option');
$viber = get_field('viber_link', 'option');
?>

<footer class="footer">
  <div class="container-xl">
    <div class="footer-col footer-col-1">
      <p>Copyright © <?= $current_year ?> <?= esc_html($company_name) ?></p>
		
		<?php if (!empty($ep)) : ?>
			<p>ИП <?= esc_html($ep) ?></p>
		<?php endif; ?>
		
		<?php if (!empty($inn)) : ?>
			<p>ИНН: <?= esc_html($inn) ?></p>
		<?php endif; ?>

        <p><a href="<?= get_template_directory_uri(); ?>/docs/Consent-to-the-processing-of-personal-data.pdf" target="blank">Политика конфиденциальности</a></p>
        <p><a href="<?= get_template_directory_uri(); ?>/docs/Privacy-Policy.pdf" target="blank">Обработка персональных данных</a></p>

      <button type="button" class="btn" data-bs-toggle="modal" data-bs-target="#contactModal">
        Написать нам
      </button>
    </div>

    <div class="footer-col footer-col-2">
      <div class="d-flex align-items-center">
        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 43 43">
          <path data-name="78standardSed.svg"
            d="M32 43A32.209 32.209 0 0 1 0 11a7.009 7.009 0 0 1 2.391-5.27l4.853-4.624a3.99 3.99 0 0 1 6.07.66l4.942 6.917a3.985 3.985 0 0 1-.61 5.312l-3.967 3.508A2.266 2.266 0 0 0 13 19c-.01 1.92 1.525 4.7 3.91 7.086s5.15 3.91 7.069 3.91H24a2.292 2.292 0 0 0 1.543-.724l3.467-3.922a4.087 4.087 0 0 1 5.309-.613l6.941 4.959a3.989 3.989 0 0 1 .638 6.056l-4.652 4.883A6.98 6.98 0 0 1 32 43zM10 2a1.986 1.986 0 0 0-1.377.554L3.74 7.206A5.036 5.036 0 0 0 2 11a30.211 30.211 0 0 0 30 30 5.005 5.005 0 0 0 3.765-1.71l4.681-4.913a1.991 1.991 0 0 0-.333-3.035l-6.961-4.973a2.037 2.037 0 0 0-2.649.311L27 30.644A4.255 4.255 0 0 1 24 32h-.02c-2.461 0-5.709-1.721-8.484-4.5s-4.508-6.046-4.5-8.509a4.227 4.227 0 0 1 1.309-2.948l4.012-3.55A2.005 2.005 0 0 0 17 11a1.969 1.969 0 0 0-.37-1.152l-4.957-6.941A2.021 2.021 0 0 0 10 2z"
            fill-rule="evenodd"></path>
        </svg>
        <a href="tel:<?= esc_attr($phone) ?>"><?= esc_html($phone) ?></a>
      </div>
      <p class="time">
        Время работы <br />
        <?= esc_html($work_hours) ?>
      </p>
      <p><?= esc_html($address_2) ?></p>
      <div class="social-links">
        <?php if ($vk): ?><a href="<?= esc_url($vk) ?>"><img
              src="<?= get_template_directory_uri() ?>/asset/img/icons/vk.svg" alt="VK" /></a><?php endif; ?>
        <?php if ($tg): ?><a href="<?= esc_url($tg) ?>"><img
              src="<?= get_template_directory_uri() ?>/asset/img/icons/telegram.svg" alt="Telegram" /></a><?php endif; ?>
        <?php if ($ok): ?><a href="<?= esc_url($ok) ?>"><img
              src="<?= get_template_directory_uri() ?>/asset/img/icons/classmates.svg"
              alt="Одноклассники" /></a><?php endif; ?>
        <?php if ($viber): ?><a href="<?= esc_url($viber) ?>"><img
              src="<?= get_template_directory_uri() ?>/asset/img/icons/viber.svg" alt="Viber" /></a><?php endif; ?>
      </div>
    </div>

    <div class="footer-col footer-col-3">
      <button class="to-top-btn btn">
        <img src="<?= get_template_directory_uri() ?>/asset/img/icons/arrow-top.svg" alt="Наверх" loading="lazy" />
      </button>
    </div>
  </div>
</footer>


<?php get_template_part('template-parts/modal-contact-form'); ?>
<?php get_template_part('template-parts/modal-contact-form-hero-section'); ?>
<?php get_template_part('template-parts/modal-contact-form-one-time'); ?>
<?php get_template_part('template-parts/modal-contact-form-year'); ?>
<?php get_template_part('template-parts/modal-contact-form-price'); ?>


<?php wp_footer(); ?>

<!-- Всплывающая форма Политики конфиденциальности -->
<div class="popup-form py-3" id="popupForm">
    <div class="form-content container">
        <div class="row justify-content-center align-items-center">
            <div class="col-md-9">
                <p class="mb-md-0">
                    На нашем сайте используются cookie-файлы, в том числе сервисов
                    веб-аналитики. Используя сайт, вы соглашаетесь на <a
                        href="<?= get_template_directory_uri(); ?>/docs/Consent-to-the-processing-of-personal-data.pdf"
                        target="blank"
                        >обработку персональных данных</a
                    > при помощи cookie-файлов. Подробнее об обработке персональных данных
                    вы можете узнать в <a
                        href="<?= get_template_directory_uri(); ?>/docs/Privacy-Policy.pdf"
                        target="blank"
                        >Политике конфиденциальности.</a
                    >
                </p>
            </div>
            <div class="col-md-3 text-md-center">
                <button id="closeBtn" class="btn action-btn">Понятно</button>
            </div>
        </div>
    </div>
</div>
<script>
    document.addEventListener('DOMContentLoaded', function () {
        const popupForm = document.getElementById('popupForm');
        const closeBtn = document.getElementById('closeBtn');

        // Проверяем нужно ли показывать форму
        function shouldShowPopup() {
            const lastClosed = localStorage.getItem('popupLastClosed');

            // Если пользователь никогда не закрывал форму
            if (!lastClosed) return true;

            // Если прошло более 1 часа (3600000 миллисекунд) с последнего закрытия
            const now = new Date().getTime();
            return now - parseInt(lastClosed) > 3600000;
        }

        // Показываем форму если нужно
        if (shouldShowPopup()) {
            setTimeout(() => {
                popupForm.classList.add('active');
            }, 3000);
        }

        // Функция закрытия формы
        function closePopup() {
            popupForm.classList.remove('active');

            // Сохраняем время закрытия
            localStorage.setItem('popupLastClosed', new Date().getTime().toString());
        }

        // Закрытие по кнопке
        closeBtn.addEventListener('click', closePopup);
    });
</script>
<!-- /Всплывающая форма Политики конфиденциальности -->

<script>
/**
 * Обработка тарифов и услуг
 */
document.addEventListener('DOMContentLoaded', function() {
    
    // Раскрытие/закрытие списка
    document.querySelectorAll('.services-dropdown-toggle').forEach(button => {
        button.addEventListener('click', function() {
            const dropdown = document.getElementById(this.dataset.target);
            const icon = this.querySelector('.dropdown-icon img');
            const isOpen = dropdown.style.display === 'block';
            
            dropdown.style.display = isOpen ? 'none' : 'block';
            icon.style.transform = isOpen ? 'rotate(0deg)' : 'rotate(180deg)';
            this.classList.toggle('active');
        });
    });

    // Обработка выбора
    document.querySelectorAll('.annual-service-checkbox').forEach(checkbox => {
        checkbox.addEventListener('change', function() {
            const container = this.closest('[data-form-id]');
            const formId = container.dataset.formId;
            const isTariff = this.name === 'tariffs[]';
            
            // Для тарифов - только один выбор
            if (isTariff && this.checked) {
                container.querySelectorAll('input[name="tariffs[]"]').forEach(cb => {
                    if (cb !== this) cb.checked = false;
                });
            }
            
            // Обновляем отображение
            updateDisplay(formId, isTariff);
        });
    });

    // Обновление выбранных элементов
    function updateDisplay(formId, isTariff) {
        const type = isTariff ? 'Tariffs' : 'Services';
        const display = document.getElementById(`selectedAnnual${type}Display_${formId}`);
        const list = document.getElementById(`selectedAnnual${type}List_${formId}`);
        const checked = document.querySelectorAll(`[data-form-id="${formId}"] input[name="${isTariff ? 'tariffs' : 'services'}[]"]:checked`);
        
        if (checked.length > 0) {
            display.style.display = 'block';
            list.innerHTML = Array.from(checked).map(cb => 
                `<span>${cb.value}</span>`
            ).join('');
        } else {
            display.style.display = 'none';
        }
    }

    // Закрытие при клике вне
    document.addEventListener('click', e => {
        if (!e.target.closest('.services-dropdown-container')) {
            document.querySelectorAll('.services-dropdown-content').forEach(dropdown => {
                dropdown.style.display = 'none';
                const button = document.querySelector(`[data-target="${dropdown.id}"]`);
                if (button) {
                    button.classList.remove('active');
                    button.querySelector('.dropdown-icon img').style.transform = 'rotate(0deg)';
                }
            });
        }
    });
});
</script>

<script>
document.addEventListener('DOMContentLoaded', function () {
    let currentOpenDropdown = null;

    console.log('Скрипт загружен');
    console.log('Найдено кнопок:', document.querySelectorAll('.services-dropdown-toggle').length);

    // Клик по кнопке дропдауна
    document.addEventListener('click', function(e) {
        const toggle = e.target.closest('.services-dropdown-toggle');
        
        // Пропускаем клики не по дропдаунам
        if (!toggle) return;
        
        e.preventDefault();
        e.stopPropagation();
        
        console.log('=== КЛИК ПО ДРОПДАУНУ ===');
        
        const target = toggle.getAttribute('data-target');
        const content = document.getElementById(target);
        const icon = toggle.querySelector('.dropdown-icon img');
        
        console.log('Target ID:', target);
        console.log('Content найден:', !!content);
        
        // Если кликнули по уже открытому - закрываем его
        if (currentOpenDropdown === content) {
            content.style.display = 'none';
            content.classList.remove('show'); // Добавь эту строку
            if (icon) icon.style.transform = 'rotate(0deg)';
            toggle.classList.remove('active');
            currentOpenDropdown = null;
            console.log('Закрыли текущий');
            return;
        }
        
        // Закрываем предыдущий открытый
        if (currentOpenDropdown) {
            console.log('Закрываем предыдущий:', currentOpenDropdown.id);
            currentOpenDropdown.style.display = 'none';
            currentOpenDropdown.classList.remove('show'); 
            const prevToggle = document.querySelector(`[data-target="${currentOpenDropdown.id}"]`);
            if (prevToggle) {
                prevToggle.classList.remove('active');
                const prevIcon = prevToggle.querySelector('.dropdown-icon img');
                if (prevIcon) prevIcon.style.transform = 'rotate(0deg)';
            }
        }
        
        // Открываем новый
        console.log('Открываем новый:', target);
        content.style.display = 'block';
        content.classList.add('show'); // Добавь эту строку
        if (icon) icon.style.transform = 'rotate(180deg)';
        toggle.classList.add('active');
        currentOpenDropdown = content;
    });

    // Закрытие при клике вне дропдауна
    document.addEventListener('click', function(e) {
        if (!e.target.closest('.services-dropdown-container') && currentOpenDropdown) {
            console.log('Закрываем по клику вне');
            currentOpenDropdown.style.display = 'none';
            currentOpenDropdown.classList.remove('show');
            const toggle = document.querySelector(`[data-target="${currentOpenDropdown.id}"]`);
            if (toggle) {
                toggle.classList.remove('active');
                const icon = toggle.querySelector('.dropdown-icon img');
                if (icon) icon.style.transform = 'rotate(0deg)';
            }
            currentOpenDropdown = null;
        }
    });
});
</script>

</body>

</html>