<?php

class SendToNewCustomers extends SendEmails
{
    /**
     * Logic for query customers
     */
    public function runEmailSender(): void
    {
        //List all customers
        /** @var Customer[] $listCustomers */
        $listCustomers = DataLayer::ListCustomers();

        //loop through list of new customers
        foreach ($listCustomers as $customer){
            //We send mail if customer is newly registered, one day back in time
            if ($customer->createdAt > (new DateTime())->modify('-1 day')) {
                $this->sendEmailWithCheckDebug($customer);
            }
        }
    }

    /**
     * Logic for send email if $debugEnabled = true
     * @param Customer $customer
     * @return null
     */
    public function sendEmailIfDebugEnable(Customer $customer): void
    {
        //Don't send mails in debug mode, just write the emails in console
        echo "Send mail to:" . $customer->email . "\r\n";
    }

    /**
     * Logic for send email if $debugEnabled = false
     * @param Customer $customer
     * @throws Exception
     */
    public function sendEmailIfDebugDisable(Customer $customer): void
    {

        $to = $customer->email;
        $subject = "Welcome as a new customer";
        $from = "info@forbytes.com";
        $body = "Hi " . $customer->email . "<br>We would like to welcome you as customer on our site!<br><br>Best Regards,<br>Forbytes Team";
        $headers = 'From: '. $from . "\r\n" ;

        $result = mail($to, $subject, $body, $headers);
        if($result === false) {
            throw new Exception("Cannot send email");
        }
    }
}