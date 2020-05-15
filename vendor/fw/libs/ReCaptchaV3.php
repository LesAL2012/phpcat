<?php


namespace fw\libs;


class ReCaptchaV3
{
    /**
     *$case: Use case - homepage, login, social, e-commerce
     */
    public static function getScriptsHTML($case)
    {
        require ROOT . '/config/config_captcha.php';

        $out = '<script src="https://www.google.com/recaptcha/api.js?render=' . KEY_CAPTCHA_V3_HTML . '"></script>';
        $out .= '<script>';
        $out .= "grecaptcha.ready(() => grecaptcha.execute('" . KEY_CAPTCHA_V3_HTML . "', {action: '" . $case . "'})";
        $out .= '.then(token => document.querySelectorAll(".token").forEach(element => element.value = token)));';
        $out .= '</script>';
        echo $out;
    }

    public static function getCaptchaVerify($key, $score, $redirect = '/')
    {
        require ROOT . '/config/config_captcha.php';

        $response = file_get_contents("https://www.google.com/recaptcha/api/siteverify?secret=" . KEY_CAPTCHA_V3_REQUEST . "&response=" . $key);
        $response = json_decode($response);

        if($response->success != 1 || ($response->success = 1 && $response->score < $score) ){
            $_SESSION['captcha'] = 'bot';
            redirect($redirect);
            die;
        }
    }
}

