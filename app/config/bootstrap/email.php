<?php

use li3_swiftmailer\mailer\Transports;

#### SMTP

// Transports::config(array('default' => array(
//     'adapter' => 'Smtp',
//     'host' => 'smtp.gmail.com',
//     'port' => 587,
//     'encryption' => 'tls',
//     'username' => 'you@gmail.com',
//     'password' => '#########',
//     //'domain' => 'your.server', // Used during the EHLO phase
//                                  // leave empty if unsure.
// )));

#### Sendmail

// Transports::config(array('sendmail' => array(
//     'adapter' => 'Sendmail',
//     'command' => '/usb/sbin/sendmail -bs -i'
// )));


#### PHP `mail()`

Transports::config(array('default' => array(
    'adapter' => 'PhpMail'
)));


// #### Multi-env system


// use li3_swiftmailer\mailer\Transports;

// Transports::config(array('default' => array(
//     'production' => array(/* … */),
//     'development' => array(/* … */),
//     'test' => array(/* … */)
// )));

?>