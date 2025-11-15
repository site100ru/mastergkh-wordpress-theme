<?php
/**
 * Template part for displaying contact form modal
 */
?>

<!-- Contact Form Modal -->
<div
    class="modal fade"
    id="contactModalPrice"
    tabindex="-1"
    aria-labelledby="contactModalLabel"
    aria-hidden="true"
>
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content position-relative">
            <!-- Крестик фиксированный в углу -->
            <button
                type="button"
                class="btn-close position-absolute top-0 end-0"
                data-bs-dismiss="modal"
                aria-label="Закрыть"
            ></button>

            <!-- Заголовок -->
            <div class="modal-header border-0">
                <h5 class="modal-title text-center text-lg-start" id="contactModalLabel">
                    Отправить сообщение
                </h5>
            </div>

            <!-- Тело модального окна -->
            <div class="modal-body">
                <?php 
                echo do_shortcode('[contact-form-7 id="79bddb1" title="Контактная форма 1 Для формы на странице"]'); 
                ?>
            </div>
        </div>
    </div>
</div>