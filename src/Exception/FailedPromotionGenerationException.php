<?php

namespace App\Exception;

final class FailedPromotionGenerationException extends \InvalidArgumentException
{
    public function __construct(
        PromotionCouponGeneratorInstructionInterface $instruction,
        int $exceptionCode = 0,
        \Exception $previousException = null,
    ) {
        $message = sprintf(
            'Invalid coupon code length or coupons amount. It is not possible to generate %d unique coupons with %d code length',
            $instruction->getAmount(),
            $instruction->getCodeLength(),
        );

        parent::__construct($message, $exceptionCode, $previousException);
    }
}
