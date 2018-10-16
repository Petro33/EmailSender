<?php
function __autoload($class)
{
    require $class . '.php';
}

//uncomment this for run script in debug environment
//SendEmails::$debugEnabled = true;

//sending the mails to new customers
echo "Send Welcomemail\r\n";
$sendToNewCustomers = new SendToNewCustomers();
$sendToNewCustomers->runEmailSender();

//sending the mails to inactive customers
echo "Send Comebackmail\r\n";
$sendToInactiveCustomers = new SendToInactiveCustomers();
$sendToInactiveCustomers->runEmailSender();

echo "All mails are sent\r\n";
echo "Done\r\n";