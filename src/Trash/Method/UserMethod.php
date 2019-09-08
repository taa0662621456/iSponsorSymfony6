<?php
declare(strict_types=1);

namespace App\Method;

use App\Domain\JsonRpcMethodWithDocInterface;
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
use Yoanm\JsonRpcServerDoc\Domain\Model\ErrorDoc;
use Yoanm\JsonRpcServerDoc\Domain\Model\Type\ArrayDoc;
use Yoanm\JsonRpcServerDoc\Domain\Model\Type\NumberDoc;
use Yoanm\JsonRpcServerDoc\Domain\Model\Type\ObjectDoc;
use Yoanm\JsonRpcServerDoc\Domain\Model\Type\StringDoc;
use Yoanm\JsonRpcServerDoc\Domain\Model\Type\TypeDoc;

class UserMethod implements JsonRpcMethodInterface, MethodWithValidatedParamsInterface, JsonRpcMethodWithDocInterface
{
    public function apply(array $paramList = null)
    {
        return [
            'name' => $paramList['name'],
            'age' => $paramList['age'],
            'sex' => $paramList['sex'] ?? null,
        ];
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

    public function getDocDescription(): string
    {
        return 'User method';
    }

    public function getDocTag(): string
    {
        return 'main';
    }

    public function getDocErrors(): array
    {
        return [new ErrorDoc('Error 1', 1)];
    }

    public function getDocResponse(): TypeDoc
    {
        $response = new ObjectDoc();
        $response->setNullable(false);

        $response->addSibling((new StringDoc())
            ->setNullable(false)
            ->setDescription('Name of user')
            ->setName('name')
        );

        $response->addSibling((new NumberDoc())
            ->setNullable(false)
            ->setDescription('Age of user')
            ->setName('age')
        );

        $response->addSibling((new StringDoc())
            ->setNullable(true)
            ->setDescription('Sex of user')
            ->setName('sex')
        );

        return $response;
    }
}