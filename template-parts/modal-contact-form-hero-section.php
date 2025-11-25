<?php
/**
 * Template part for displaying contact form modal
 */
?>

<!-- Contact Form Modal -->
<div
    class="modal fade"
    id="heroContactModal"
    tabindex="-1"
    aria-labelledby="heroContactModalLabel"
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
                <h5 class="modal-title text-center text-lg-start" id="heroContactModalLabel">
                    Заявка на ремонт
                </h5>
            </div>

            <!-- Тело модального окна -->
            <div class="modal-body">
                <?php 
                echo do_shortcode('[contact-form-7 id="abda5eb" title="Главная страница Заявка на ремонт"]'); 
                ?>
            </div>
        </div>
    </div>
</div>