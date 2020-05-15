<div class="container">
    <h1>Email Options</h1>
    <?php if (isset($_SESSION['mail']['success'])) : ?>
        <div class="alert-success border border-dark rounded"><h3
                    class="text-center"><?= $_SESSION['mail']['success']; ?></h3>
        </div>
    <?php endif; ?>
    <?php if (isset($_SESSION['mail']['danger'])) : ?>
        <div class="alert-danger border border-dark rounded"><h3
                    class="text-center"><?= $_SESSION['mail']['danger']; ?></h3>
        </div>
    <?php endif;
    unset($_SESSION['mail']); ?>
    <?php if (isset($_SESSION['captcha']) && $_SESSION['captcha'] == 'bot') : ?>
        <div class="bg-dark rounded p-2 my-2 text-center">
            <h3
                    class="text-danger">Are you BOT?
            </h3>
            <img src="/images/skull_48.png" alt="skull">
        </div>
    <?php endif;
    unset($_SESSION['captcha']); ?>
    <hr>
    <div class="row ">
        <div class="col-lg-6 col-md-6 col-sm-12 ">

            <div class="border border-dark rounded p-2 mail-div mb-3">
                <h2><img src="/public/images/php_mail.png" alt="php" class="rounded "></h2>
                <hr>
                <form action="/mail/mail-Php" method="POST" enctype="multipart/form-data">
                    <input type="hidden" name="option" value="php-mail">
                    <input type="hidden" name="token" class="token" value="">

                    <input type="email" name="email"
                           value="<?= isset($_SESSION['form_data']['email']) ? h($_SESSION['form_data']['email']) : ""; ?>"
                           size="28" required> :your email
                    <hr>
                    <input type="text" name="subject"
                           value="<?= isset($_SESSION['form_data']['subject']) ? h($_SESSION['form_data']['subject']) : "Checking: PHP mail"; ?>"
                           size="28" required> :subject
                    <br><b>Message:</b>
                    <textarea name="message" cols="28" id="editor1"
                              rows="3" required><?= isset($_SESSION['form_data']['message']) ? h($_SESSION['form_data']['message']) : "This mail was sent:
by PHP mail."; ?></textarea>
                    <hr>
                    <input type="file" name="filePHP[]" multiple>
                    <hr>
                    <input type="submit" class="btn btn-success border border-dark" value="Send by PHP mail">
                </form>
            </div>
        </div>
        <div class="col-lg-6 col-md-6 col-sm-12">

            <div class="border border-dark rounded p-2 mail-div">
                <h2><img src="/public/images/swift_mailer.png" alt="php" class="rounded "></h2>
                <hr>
                <form action="/mail/mail-Swift" method="POST" enctype="multipart/form-data">
                    <input type="hidden" name="option" value="mail-swift">
                    <input type="hidden" name="token" class="token" value="">

                    <input type="email" name="email"
                           value="<?= isset($_SESSION['form_data']['email']) ? h($_SESSION['form_data']['email']) : ""; ?>"
                           size="28" required> :your email
                    <hr>
                    <input type="text" name="subject"
                           value="<?= isset($_SESSION['form_data']['subject']) ? h($_SESSION['form_data']['subject']) : "Checking: Swift Mailer"; ?>"
                           size="28" required> :subject
                    <br><b>Message:</b>
                    <textarea name="message" cols="28" id="editor2"
                              rows="3" required><?= isset($_SESSION['form_data']['message']) ? h($_SESSION['form_data']['message']) : "This mail was sent:
by Swift Mailer."; ?></textarea>
                    <hr>
                    <input type="file" name="fileSwift[]" multiple>
                    <hr>
                    <input type="submit" class="btn btn-success border border-dark" value="Send by Swift Mailer">
                </form>
                <?php
                if (isset($_SESSION['form_data'])) {
                    unset($_SESSION['form_data']);
                }
                ?>
            </div>
        </div>
    </div>
</div>

<?php \fw\core\App::$app->captcha->getScriptsHTML('homepage'); ?>
<?php \fw\core\App::$app->ckeditor->getEditorFirst('editor1'); ?>
<?php \fw\core\App::$app->ckeditor->getEditorSecond('editor2'); ?>
