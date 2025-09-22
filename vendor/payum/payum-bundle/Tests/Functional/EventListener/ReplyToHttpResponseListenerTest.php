<?php
namespace Payum\Bundle\PayumBundle\Tests\Functional\EventListener;

use Payum\Bundle\PayumBundle\Tests\Functional\WebTestCase;

class ReplyToHttpResponseListenerTest extends WebTestCase
{
    /**
     * @test
     */
    public function couldBeGetFromContainerAsService(): void
    {
        $listener = static::getContainer()->get('payum.listener.reply_to_http_response');

        $this->assertInstanceOf('Payum\Bundle\PayumBundle\EventListener\ReplyToHttpResponseListener', $listener);
    }
}
