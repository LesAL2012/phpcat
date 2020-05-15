<?php


namespace app\controllers;

use app\models\Mail;
use fw\core\App;
use fw\core\base\View;
use Swift_Attachment;
use Swift_Mailer;
use Swift_Message;
use Swift_SendmailTransport;

class MailController extends AppController
{
    protected $fileArr = [];

    public function indexAction()
    {
        View::setMeta('Mail', 'PHP mail, Swift Mailer', 'Some variant of mail sending');
    }

    public function mailPhpAction()
    {
        $this->postValidator();

        App::$app->captcha->getCaptchaVerify($_POST['token'], 0.9, '/mail');

        if (isset($_POST['option']) && $_POST['option'] == 'php-mail') {
            $to = $_POST['email'];
            $subject = h($_POST['subject']);
            $message = $_POST['message']; //if use CKEDITOR -> function h() is present

            if (isset($_FILES['filePHP']) && !empty($_FILES['filePHP']['name'][0])) {
                $this->loadFiles('filePHP');

                $from = "examplePHPmail@sample.com";
                $headers = "From: $from";

                // boundary
                $semi_rand = md5(time());
                $mime_boundary = "==Multipart_Boundary_x{$semi_rand}x";

                // headers for attachment
                $headers .= "\nMIME-Version: 1.0\n"
                    . "Content-Type: multipart/mixed;\n"
                    . " boundary=\"{$mime_boundary}\"";

                // multipart boundary
                $message = "This is a multi-part message in MIME format.\n\n"
                    . "--{$mime_boundary}\n"
                    . "Content-Type: text/plain; charset=\"iso-8859-1\"\n"
                    . "Content-Transfer-Encoding: 7bit\n\n"
                    . $message . "\n\n";
                $message .= "--{$mime_boundary}\n";

                // preparing attachments
                for ($i = 0; $i < count($this->fileArr['fileName']); $i++) {
                    $file = fopen($this->fileArr['filePath'][$i], "rb");
                    $data = fread($file, filesize($this->fileArr['filePath'][$i]));
                    fclose($file);
                    $data = chunk_split(base64_encode($data));
                    $message .= "Content-Type: {\"application/octet-stream\"};\n"
                        . " name=\"{$this->fileArr['filePath'][$i]}\"\n"
                        . "Content-Disposition: attachment;\n"
                        . " filename=\"{$this->fileArr['filePath'][$i]}\"\n"
                        . "Content-Transfer-Encoding: base64\n\n" . $data . "\n\n";
                    $message .= "--{$mime_boundary}\n";
                }

                // send
                @mail($to, $subject, $message, $headers);

                if (time_nanosleep(5, 0)) {
                    foreach ($this->fileArr['filePath'] as $filepath) {
                        unlink($filepath);
                    }
                }
            } else {
                $headers = "Content-type: text/html; charset=UTF-8 \r\n";
                $headers .= "From: Test-site <examplePHPmail@sample.com>\r\n";
                $headers .= "Reply-To: No-reply reply-to@example.com\r\n";

                mail($to, $subject, $message, $headers);
            }

            $_SESSION['mail']['success'] = 'Message has been sent';
        }

        redirect('/mail');
    }

    public function mailSwiftAction()
    {
        $this->postValidator();

        App::$app->captcha->getCaptchaVerify($_POST['token'], 0.9, '/mail');

        if (isset($_POST['option']) && $_POST['option'] == 'mail-swift') {
            $to = $_POST['email'];
            $subject = h($_POST['subject']);
            $message = $_POST['message']; //if use CKEDITOR -> function h() is present

            // Create the Transport/
            $transport = new Swift_SendmailTransport('/usr/sbin/sendmail -bs');

            // Create the Mailer using your created Transport
            $mailer = new Swift_Mailer($transport);

            // Create a message
            $message = (new Swift_Message($subject))
                ->setFrom(['sm@sm.com.ua' => 'Test-site: Swift Mailer'])
                ->setTo([$to => 'Les'])
                ->setBody($message, 'text/html');

            $headers = $message->getHeaders();
            $headers->addTextHeader('Content-type', 'text/plain; charset="iso-8859-1"\n');

            // Add an "Attachment" (Also, the dynamic data can be attached)
            if (isset($_FILES['fileSwift']) && !empty($_FILES['fileSwift']['name'][0])) {
                $this->loadFiles('fileSwift');

                for ($i = 0; $i < count($this->fileArr['filePath']); $i++) {
                    $attachment = Swift_Attachment::fromPath($this->fileArr['filePath'][$i]);
                    $attachment->setFilename($this->fileArr['fileName'][$i]);
                    $message->attach($attachment);
                }
            }

            // Send the message
            $result = $mailer->send($message);

            if (isset($this->fileArr['filePath']) && !empty($this->fileArr['filePath'])) {
                if (time_nanosleep(5, 0)) {
                    foreach ($this->fileArr['filePath'] as $filepath) {
                        unlink($filepath);
                    }
                }
            }

            if ($result) {
                $_SESSION['mail']['success'] = 'Message has been sent';
            }
        }

        redirect('/mail');
    }

    protected function loadFiles($method)
    {
        $dirSizeTmpMail = 0;
        $dir = scandir('tmp/mail/');
        foreach ($dir as $file) {
            if ($file != '.' && $file != '..') {
                $dirSizeTmpMail += filesize('tmp/mail/' . $file);
            }
        }

        if ($dirSizeTmpMail > 100000000) {
            $this->clearTmpMailDir();
        }

        for ($i = 0; $i < count($_FILES[$method]['name']); $i++) {
            if (file_exists('tmp/mail/' . $_FILES[$method]['name'][$i])) {
                $this->fileArr['filePath'][$i] = 'tmp/mail/' . date("dHis") . '-' . $_FILES[$method]['name'][$i];
                $this->fileArr['fileName'][$i] = date("dHis") . '-' . $_FILES[$method]['name'][$i];
            } else {
                $this->fileArr['filePath'][$i] = 'tmp/mail/' . $_FILES[$method]['name'][$i];
                $this->fileArr['fileName'][$i] = $_FILES[$method]['name'][$i];
            }

            if ($_FILES[$method]['size'][$i] > 20000000) {
                $_SESSION['mail']['danger'] = "Файл <i>{$_FILES[$method]['name'][$i]}</i> больше 20 МБ";
                $_SESSION['form_data'] = $_POST;
                $this->clearTmpMailDir();
                redirect();
                die;
            } else {
                move_uploaded_file($_FILES[$method]['tmp_name'][$i], $this->fileArr['filePath'][$i]);
            }
        }
    }

    protected function clearTmpMailDir()
    {
        $filesFromDir = scandir('tmp/mail/');
        foreach ($filesFromDir as $item) {
            if ($item != '.' && $item != '..') {
                unlink('tmp/mail/' . $item);
            }
        }
    }

    protected function postValidator()
    {
        if (!empty($_POST)) {
            $mail = new Mail();
            $mail->load($_POST);

            if (!$mail->validate($_POST)) {
                $mail->getErrors();
                $_SESSION['form_data'] = $_POST;
                redirect();
            }
        }
    }

}