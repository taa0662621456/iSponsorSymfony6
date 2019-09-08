<?php
declare(strict_types=1);

namespace App\Method;

use Symfony\Component\Validator\Constraint;
use Symfony\Component\Validator\Constraints\Choice;
use Symfony\Component\Validator\Constraints\Collection;
use Symfony\Component\Validator\Constraints\Length;
use Symfony\Component\Validator\Constraints\NotBlank;
use Symfony\Component\Validator\Constraints\Optional;
use Symfony\Component\Validator\Constraints\Positive;
use Symfony\Component\Validator\Constraints\Required;
use Yoanm\JsonRpcParamsSymfonyValidator\Domain\MethodWithValidatedParamsInterface;
use Yoanm\JsonRpcServer\Domain\JsonRpcMethodInterface;

class ParamsMethod implements JsonRpcMethodInterface, MethodWithValidatedParamsInterface
{
    public function apply(array $paramList = null)
    {
        return $paramList;
    }

    public function getParamsConstraint() : Constraint
    {
        return new Collection(['fields' => [
            'name' => new Required([
                new Length(['min' => 1, 'max' => 32])
            ]),
            'age' => new Required([
                new Positive()
            ]),
            'sex' => new Optional([
                new Choice(['f', 'm'])
            ]),
        ]]);
    }

}