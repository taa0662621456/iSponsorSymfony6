<?php
namespace App\Entity;

trait DomainEventTrait
{
    /** @var object[] */
    private array $recordedEvents = [];

    protected function recordEvent(object $event): void
    {
        $this->recordedEvents[] = $event;
    }

    /**
     * Забирает все события и очищает буфер.
     *
     * @return object[]
     */
    public function releaseEvents(): array
    {
        $events = $this->recordedEvents;
        $this->recordedEvents = [];
        return $events;
    }
}
//может перенести к сущностям в папку

