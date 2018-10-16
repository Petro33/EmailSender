<?php

class SendToInactiveCustomers extends SendEmails
{
    /**
     * Logic for query customers
     */
    public function runEmailSender(): void
    {
        //List all customers
        $listCustomers = DataLayer::ListCustomers();
        //List all orders
        $listOrders = DataLayer::ListOrders();

        //loop through list of customers
        foreach ($listCustomers as $customer) {
            // We send mail if customer hasn't put an order
            if(array_search($customer->email, array_column($listOrders, 'customerEmail')) === false){
                $this->sendEmailWithCheckDebug($customer);
            }
        }
    }

    /**
     * Logic for send email if $debugEnabled = true
     * @param Customer $customer
     */
    public function sendEmailIfDebugEnable(Customer $customer): void
    {
        //Don't send mails in debug mode, just write the emails in console
        echo("Send mail to:" . $customer->email . "\r\n");
    }

    /**
     * Logic for send email if $debugEnabled = false
     * @param Customer $customer
     * @throws Exception
     */
    public function sendEmailIfDebugDisable(Customer $customer): void
    {

        $to = $customer->email;
        $subject = "We miss you as a customer";
        $from = "infor@forbytes.com";
        $body = "Hi " . $customer->email . "<br>We miss you as a customer. Our shop is filled with nice products. Here is a voucher that gives you 50 kr to shop for.<br>Voucher: ComebackToUs<br><br>Best Regards,<br>Forbytes Team";
        $headers = 'From: '. $from . "\r\n" ;

        if(date('D', time()) === 'Mon') {
            //Send mail
            $result = mail($to, $subject, $body, $headers);
            if ($result === false) {
                throw new Exception("Cannot send email" . error_get_last()['message']);
            }
        }
    }

}