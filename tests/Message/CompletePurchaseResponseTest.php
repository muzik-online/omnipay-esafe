<?php

namespace Test\Message;

use Mockery;
use PHPUnit\Framework\TestCase;
use Muzik\EsafeSdk\Contracts\Handler;
use Muzik\EsafeSdk\Exceptions\HandlerException;
use Muzik\OmnipayEsafe\Message\CompletePurchaseRequest;
use Muzik\OmnipayEsafe\Message\CompletePurchaseResponse;

class CompletePurchaseResponseTest extends TestCase
{
    protected function tearDown(): void
    {
        Mockery::close();
        parent::tearDown();
    }

    public function test_success_response()
    {
        $response = new CompletePurchaseResponse($this->createMockeryRequest(), $this->createMockeryHandler());

        $this->assertInstanceOf(CompletePurchaseResponse::class, $response);
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
        $response = new CompletePurchaseResponse($this->createMockeryRequest(), null, new HandlerException('Custom Error'));

        $this->assertInstanceOf(CompletePurchaseResponse::class, $response);
        $this->assertFalse($response->isSuccessful());
        $this->assertFalse($response->isRedirect());
        $this->assertTrue($response->isCancelled());
        $this->assertSame('Custom Error', $response->getMessage());
    }

    protected function createMockeryRequest()
    {
        return Mockery::mock(CompletePurchaseRequest::class);
    }

    protected function createMockeryHandler()
    {
        $handler = Mockery::mock(Handler::class);
        $handler->shouldReceive('getTransactionReference')->withNoArgs()->once()
            ->andReturn('2400009912300000019');
        $handler->shouldReceive('getParameters')->withNoArgs()->once()
            ->andReturn(['foo' => 'bar']);

        return $handler;
    }
}
