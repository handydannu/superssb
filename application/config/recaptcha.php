<?php

// To use reCAPTCHA, you need to sign up for an API key pair for your site.
// link: http://www.google.com/recaptcha/admin
$config['recaptcha_site_key'] = '6LfDbicTAAAAAPkDszz5MI06a4UR4pCLxqzJDBFA';
$config['recaptcha_secret_key'] = '6LfDbicTAAAAAFy70Df6ot1nvs2W7GZ-jJG-qMjQ';

$server_name    = $_SERVER['SERVER_ADDR'];
    switch ($server_name) {
        case  "10.5.5.56": //stagging
            $config['recaptcha_site_key'] = '6LfDbicTAAAAAPkDszz5MI06a4UR4pCLxqzJDBFA';
			$config['recaptcha_secret_key'] = '6LfDbicTAAAAAFy70Df6ot1nvs2W7GZ-jJG-qMjQ';
            break;

        default: //localhost
            $config['recaptcha_site_key'] = '6LdOqAcUAAAAANj5jx7qBBdFNMynCJpsDLtaK_Ew';
			$config['recaptcha_secret_key'] = '6LdOqAcUAAAAADcUIsIe2JRSNSlmMwPLkyrRvnWn';
            break;
       }

// reCAPTCHA supported 40+ languages listed here:
// https://developers.google.com/recaptcha/docs/language
$config['recaptcha_lang'] = 'en';

/* End of file recaptcha.php */
/* Location: ./application/config/recaptcha.php */
