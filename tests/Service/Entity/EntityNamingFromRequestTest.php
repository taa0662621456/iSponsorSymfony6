<?php

namespace App\Tests\Service\Entity;

use App\DataTransferObject\ObjectProps;
use App\Service\Entity\EntityNamingRequestParametersParser;
use PHPUnit\Framework\TestCase;
use Symfony\Component\HttpFoundation\Request;

class EntityNamingFromRequestTest extends TestCase
{
    public function testBuildFromRequestExtractsEntityProps(): void
    {
        $request = new Request();
        $request->attributes->set('entity', 'Order');
        $request->attributes->set('subEntity', 'Item');
        $request->attributes->set('_route', 'order_item_create');

        $builder = new EntityNamingRequestParametersParser();
        $props = $builder->buildEntityNamingFromRequest($request);

        $this->assertInstanceOf(ObjectProps::class, $props);
        $this->assertSame('Order', $props->entity);
        $this->assertSame('Item', $props->subEntity);
        $this->assertSame('create', $props->action);
    }

    public function testBuildFromRequestHandlesMissingValues(): void
    {
        $request = new Request();

        $builder = new EntityNamingRequestParametersParser();
        $props = $builder->buildEntityNamingFromRequest($request);

        $this->assertSame('', $props->entity);
        $this->assertNull($props->subEntity);
        $this->assertNull($props->action);
    }

    public function testBuildFromRequestParsesCrudAction(): void
    {
        $request = new Request();
        $request->attributes->set('_route', 'vendor_channel_edit');

        $builder = new EntityNamingRequestParametersParser();
        $props = $builder->buildEntityNamingFromRequest($request);

        $this->assertSame('edit', $props->action);
    }
}
