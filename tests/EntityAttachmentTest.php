<?php

namespace App\Tests;

use App\Service\Entity\EntityAttachment;
use PHPUnit\Framework\TestCase;

class EntityAttachmentTest extends TestCase
{
    private EntityAttachment $attachment;

    protected function setUp(): void
    {
        $this->attachment = new EntityAttachment();
    }

    public function testGetAttachmentClass(): void
    {
        $attachmentClass = $this->attachment->getEntityAttachmentClassName('App\\Entity\\User');
        $this->assertSame('App\\Entity\\UserAttachment', $attachmentClass);
    }

    public function testCreateAttachment(): void
    {
        $this->expectException(\InvalidArgumentException::class);
        $this->attachment->createEntityAttachmentObject('NonExistentClass');
    }
}

