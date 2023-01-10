<?php

namespace App\Tests\Service;

use App\Entity\Product\ProductReview;
use App\Service\AkismetSpamChecker;
use Exception;
use PHPUnit\Framework\TestCase;
use RuntimeException;
use Symfony\Component\HttpClient\MockHttpClient;
use Symfony\Component\HttpClient\Response\MockResponse;
use Symfony\Contracts\HttpClient\Exception\TransportExceptionInterface;

class SpamCheckerTest extends TestCase
{
    /**
     * @throws Exception|TransportExceptionInterface
     */
    public function testSpamScoreWithInvalidRequest(): void
    {
        $comment = new ProductReview();
        $comment->setCreatedAt();
        $context =[];

        $client = new MockHttpClient([
            new MockResponse('invalid', [
                'response_header' => 'x-akismet-debug-help: Invalid key'
            ])
        ]);
        $checker = new AkismetSpamChecker($client, 'Something text');

        $this->expectException(RuntimeException::class);
        $this->expectExceptionMessage('Unable to check for spam: invalid (invalid key).');
        $checker->getSpamScore($comment, $context);
    }
}
