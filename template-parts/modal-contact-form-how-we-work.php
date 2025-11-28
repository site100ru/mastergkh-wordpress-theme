<?php
/**
 * Template part for displaying contact form modal
 */
?>

<!-- Contact Form Modal -->
<div
    class="modal fade"
    id="howWeWork"
    tabindex="-1"
    aria-labelledby="howWeWorkLabel"
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
                <h5 class="modal-title text-center text-lg-start" id="howWeWorkLabel">
                    Оставить заявку
                </h5>
            </div>

            <!-- Тело модального окна -->
            <div class="modal-body">
                <?php 
                echo do_shortcode('[contact-form-7 id="8d98895" title="Контактная форма Как мы работаем"]'); 
                ?>
            </div>
        </div>
    </div>
</div>