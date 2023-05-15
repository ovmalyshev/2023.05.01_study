<?php

namespace Speroteck\Task3\Model;

/**
 * Pay In Store payment method model
 */
class PaymentMethod extends \Magento\Payment\Model\Method\AbstractMethod
//class PaymentMethod implements Magento\Payment\Model\MethodInterface
{
    /**
     * Payment code
     *
     * @var string
     */
    protected $_code = 'custompayment';
    protected $_canAuthorize = 'true';
}