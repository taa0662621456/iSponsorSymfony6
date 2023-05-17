<?php

namespace App\Dto\Address;

use ApiPlatform\Doctrine\Orm\Filter\SearchFilter;
use ApiPlatform\Metadata\ApiFilter;
use App\Dto\Abstraction\ObjectDTO;
use App\Interface\Object\ObjectApiResourceInterface;

#[ApiFilter(SearchFilter::class, properties: [
    'firstTitle' => 'partial',
    'lastTitle' => 'partial',
])]
final class AddressDTO extends ObjectDTO implements ObjectApiResourceInterface
{

    private string $firstAddressLineDTO;
    private string $secondAddressLineDTO;
    private string $nameAddressLineDTO;


    public function __construct(string $firstAddressLine, string $secondAddressLine, string $nameAddressLine)
    {
        parent::__construct();
        $this->firstTitle = $firstAddressLine;
        $this->middleTitle = $secondAddressLine;
        $this->lastTitle = $nameAddressLine;

    }

    /**
     * @return string
     */
    public function getFirstAddressLine(): string
    {
        return $this->firstAddressLine;
    }

    /**
     * @param string $firstAddressLine
     */
    public function setFirstAddressLine(string $firstAddressLine): void
    {
        $this->firstAddressLine = $firstAddressLine;
    }

    /**
     * @return string
     */
    public function getSecondAddressLine(): string
    {
        return $this->secondAddressLine;
    }

    /**
     * @param string $secondAddressLine
     */
    public function setSecondAddressLine(string $secondAddressLine): void
    {
        $this->secondAddressLine = $secondAddressLine;
    }

    /**
     * @return string
     */
    public function getNameAddressLine(): string
    {
        return $this->nameAddressLine;
    }

    /**
     * @param string $nameAddressLine
     */
    public function setNameAddressLine(string $nameAddressLine): void
    {
        $this->nameAddressLine = $nameAddressLine;
    }

}
