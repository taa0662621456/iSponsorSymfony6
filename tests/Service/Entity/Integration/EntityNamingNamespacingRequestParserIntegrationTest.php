<?php

namespace App\Tests\Service\Entity\Integration;

use App\DataTransferObject\ObjectProps;
use App\Service\Entity\EntityNamingNamespacing;
use App\Service\Entity\EntityNamingRequestParametersParser;
use PHPUnit\Framework\TestCase;
use Symfony\Component\HttpFoundation\Request;

class EntityNamingNamespacingRequestParserIntegrationTest extends TestCase
{
    public function testFullFlowFromRequestToEntityName(): void
    {
        $request = new Request();
        $request->attributes->set('entity', 'Order');
        $request->attributes->set('subEntity', 'Item');
        $request->attributes->set('_route', 'order_item_create');

        $fromRequest = new EntityNamingRequestParametersParser();
        $props = $fromRequest->buildEntityNamingFromRequest($request);

        $this->assertInstanceOf(ObjectProps::class, $props);
        $this->assertSame('Order', $props->entity);
        $this->assertSame('Item', $props->subEntity);
        $this->assertSame('create', $props->action);

        $builder = new EntityNamingNamespacing();

        $this->assertSame('OrderItem', $builder->getEntityClassName($props));
        $this->assertSame('App\\Entity\\OrderItem', $builder->getEntityClassNamespace($props));
        $this->assertSame('App\\Repository\\OrderItemRepository', $builder->getEntityRepositoryNamespace($props));
        $this->assertSame('App\\Form\\OrderItemType', $builder->getEntityTypeNamespace($props));
    }
}
