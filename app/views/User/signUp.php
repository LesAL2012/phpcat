<div class="container">
    <h2 class="text-center mt-2">REGISTRATION</h2>
    <?php if (isset($_SESSION['captcha']) && $_SESSION['captcha'] == 'bot') : ?>
        <div class="bg-dark rounded p-2 my-2 text-center">
            <h3
                    class="text-danger">Are you BOT?
            </h3>
            <img src="/images/skull_48.png" alt="skull">
        </div>
    <?php endif;
    unset($_SESSION['captcha']); ?>
    <div class="row">
        <div class="col-lg-6 col-md-8 col-sm-10 border border-dark mx-auto m-2 p-3 rounded">
            <form method="post" action="/user/signUp">

                <input type="hidden" name="token" class="token" value="">

                <div class="form-group">
                    <label for="login">Login</label>
                    <input type="text" class="form-control" id="login" name="login" placeholder="Type your Login"
                           value="<?= isset($_SESSION['form_data']['login']) ? h($_SESSION['form_data']['login']) : ''; ?>">
                </div>
                <div class="form-group">
                    <label for="password">Password</label>
                    <input type="password" class="form-control" id="password" name="password"
                           placeholder="Type your Password">
                </div>
                <div class="form-group">
                    <label for="name">Name</label>
                    <input type="text" class="form-control" id="name" name="name" placeholder="Type your Name"
                           value="<?= isset($_SESSION['form_data']['name']) ? h($_SESSION['form_data']['name']) : ''; ?>">
                </div>
                <div class="form-group">
                    <label for="email">Email</label>
                    <input type="text" class="form-control" id="email" name="email" placeholder="Type your Email"
                           value="<?= isset($_SESSION['form_data']['email']) ? h($_SESSION['form_data']['email']) : ''; ?>">
                </div>
                <button type="submit" class="btn btn-primary">SIGNUP</button>
            </form>
            <?php
            if (isset($_SESSION['form_data'])) {
                unset($_SESSION['form_data']);
            }
            ?>
        </div>
    </div>
</div>

<?php \fw\libs\ReCaptchaV3::getScriptsHTML('login'); ?>
