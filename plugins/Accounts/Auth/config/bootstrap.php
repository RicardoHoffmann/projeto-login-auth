<?php

use Cake\Core\Configure;

/* Reports the time the user has to wait if he is locked after n attempts */
Configure::write('Accounts.auth.login.timeblocked', '00:30:00');

/* Reports the time interval between the current time compared to the time of the last login attempt */
Configure::write('Accounts.auth.login.timeInterval', '00:30:00');

/* Reports the number of login attempts before locking the account for x time; */
Configure::write('Accounts.auth.login.loginAttempts', 5);

/* Reports the number of login attempts before request the captcha */
Configure::write('Accounts.auth.login.attemptsBeforeCaptcha', 3);

/* SiteKey Recaptcha Google */
Configure::write('Accounts.auth.login.siteKey', '6Le9myAUAAAAAEi_BnZFlR0sl-OwbFagrLJwjCkF');

/* SecretKey Recaptcha Google */
Configure::write('Accounts.auth.login.secretKey', '6Le9myAUAAAAAD7zCG0ZC8j85KSRhaw5owWMuMp4');

/* Language Recaptcha Google */
Configure::write('Accounts.auth.login.lang', 'pt-BR');


?>