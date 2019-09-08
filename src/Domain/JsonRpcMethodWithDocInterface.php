<?php
declare(strict_types=1);

namespace App\Domain;

use Yoanm\JsonRpcServerDoc\Domain\Model\ErrorDoc;
use Yoanm\JsonRpcServerDoc\Domain\Model\Type\TypeDoc;

interface JsonRpcMethodWithDocInterface
{
    /**
     * @return TypeDoc
     */
    public function getDocResponse(): TypeDoc;

    /**
     * @return ErrorDoc[]
     */
    public function getDocErrors(): array;

    /**
     * @return string
     */
    public function getDocDescription(): string;

    /**
     * @return string
     */
    public function getDocTag(): string;
}