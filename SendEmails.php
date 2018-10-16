<?php

abstract class SendEmails
{
    /** @var bool  */
    public static $debugEnabled = false;

    /**
     * Write in this method logic for query customers
     */
    abstract protected function runEmailSender(): void;

    /**
     * Logic for send email if $debugEnabled = true
     * @param Customer $customer
     */
    abstract protected function sendEmailIfDebugEnable(Customer $customer): void;

    /**
     * Logic for send email if $debugEnabled = false
     * @param Customer $customer
     */
    abstract protected function sendEmailIfDebugDisable(Customer $customer): void;

    /**
     * Check environment
     * @param Customer $customer
     */
    protected function sendEmailWithCheckDebug(Customer $customer): void {
        if (self::$debugEnabled) {
            $this->sendEmailIfDebugEnable($customer);
        } else {
            $this->sendEmailIfDebugDisable($customer);
        }
    }

}