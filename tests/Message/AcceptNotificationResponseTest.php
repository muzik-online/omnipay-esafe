<?php

namespace Test\Message;

use Mockery;
use Muzik\EsafeSdk\Contracts\Handler;
use Muzik\EsafeSdk\Exceptions\HandlerException;
use Muzik\OmnipayEsafe\Message\AcceptNotificationRequest;
use Muzik\OmnipayEsafe\Message\AcceptNotificationResponse;
use PHPUnit\Framework\TestCase;

class AcceptNotificationResponseTest extends TestCase
{
    protected function tearDown(): void
    {
        Mockery::close();
        parent::tearDown();
    }

    public function test_success_response()
    {
        $handler = $this->createMockeryHandler();
        $handler->shouldReceive('getParameters')->withNoArgs()->once()->andReturn(['foo' => 'bar']);
        $response = new AcceptNotificationResponse($this->createMockeryRequest(), $handler);

        $this->assertInstanceOf(AcceptNotificationResponse::class, $response);
        $this->assertTrue($response->isSuccessful());
        $this->assertFalse($response->isRedirect());
        $this->assertFalse($response->isCancelled());
        $this->assertNull($response->getMessage());
        $this->assertNull($response->getCode());
        $this->assertSame('2400009912300000019', $response->getTransactionReference());
        $this->assertEquals(['foo' => 'bar'], $response->getData());
    }

    public function test_failed_response()
    {
        $response = new AcceptNotificationResponse($this->createMockeryRequest(), null, new HandlerException('Custom Error'));

        $this->assertFalse($response->isSuccessful());
        $this->assertFalse($response->isRedirect());
        $this->assertFalse($response->isCancelled());
        $this->assertSame('Custom Error', $response->getMessage());
    }

    protected function createMockeryRequest()
    {
        return Mockery::mock(AcceptNotificationRequest::class);
    }

    public function createMockeryHandler()
    {
        $handler = Mockery::mock(Handler::class);
        $handler->shouldReceive('getTransactionReference')->withNoArgs()->once()
            ->andReturn('2400009912300000019');

        return $handler;
    }
}