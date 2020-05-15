<div class="container">
    <h2 class="text-center mt-2">AUTHORIZATION</h2>

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
            <form method="post" action="/user/login">

                <input type="hidden" name="token" class="token" value="">

                <div class="form-group">
                    <label for="login">Login</label>
                    <input type="text" class="form-control" id="login" name="login" placeholder="Type your Login">
                </div>
                <div class="form-group">
                    <label for="password">Password</label>
                    <input type="password" class="form-control" id="password" name="password"
                           placeholder="Type your Password">
                </div>
                <button type="submit" class="btn btn-primary">LOGIN</button>
            </form>
        </div>
    </div>

    <hr>
    <h3 class="text-center mt-2"> You can use for enter</h3>

    <div class="row mx-auto" style="max-width: 460px">
        <div class="col-sm-6 mx-auto" style="max-width: 225px">
            <div class="border border-dark rounded mb-3 p-2">
                <img src="/public/images/faviconAdmin.ico" alt="admin"> - Admin
                <hr>
                <b>Login:</b> CatAdmin <br>
                <b>Password:</b> CatAdmin123
            </div>
        </div>
        <div class="col-sm-6 mx-auto" style="max-width: 225px">
            <div class="border border-dark rounded mb-3 p-2">
                <img src="/public/images/faviconCat.ico" alt="cat"> - User
                <hr>
                <b>Login:</b> CatUser <br>
                <b>Password:</b> CatUser123
            </div>
        </div>
    </div>

</div>

<?php \fw\libs\ReCaptchaV3::getScriptsHTML('login'); ?>