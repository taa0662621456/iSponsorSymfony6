<?php

namespace App\Tests\Service;

use PHPUnit\Framework\TestCase;
use App\Service\AkismetSpamChecker;
use App\Entity\Product\ProductReview;
use Symfony\Component\HttpClient\MockHttpClient;
use Symfony\Component\HttpClient\Response\MockResponse;
use Symfony\Contracts\HttpClient\Exception\TransportExceptionInterface;

class SpamCheckerTest extends TestCase
{
    /**
     * @throws \Exception|TransportExceptionInterface
     */
    public function testSpamScoreWithInvalidRequest(): void
    {
        $comment = new ProductReview();
        $comment->setCreatedAt();
        $context = [];

        $client = new MockHttpClient([
            new MockResponse('invalid', [
                'response_header' => 'x-akismet-debug-help: Invalid key',
            ]),
        ]);
        $checker = new AkismetSpamChecker($client, 'Something text');

        $this->expectException(\RuntimeException::class);
        $this->expectExceptionMessage('Unable to check for spam: invalid (invalid key).');
        $checker->getSpamScore($comment, $context);
    }
}
