<?php


namespace App\Entity;


trait AkismetTrait
{
    //TODO: скорее всего эти свойства перенести в ReviewTrait
    /**
     * @var string
     *
     * @ORM\Column(name="state", type="string",
     *     options={"default"="submitted", "comment"="Submitted, Spam and Published stats"})
     */
    private $state;

    public function __toString(): string
    {
        return $this->getState();
    }


    /**
     * @return string
     */
    public function getState(): string
    {
        return $this->state;
    }

    /**
     * @param string $state
     */
    public function setState(string $state): void
    {
        $this->state = $state;
    }


}
