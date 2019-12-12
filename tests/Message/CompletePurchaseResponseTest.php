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
        $handler = $this->createMockeryHandler();
        $handler->shouldReceive('getParameters')->withNoArgs()
            ->andReturn([
                'foo' => 'bar',
                'errcode' => '00',
            ]);
        $response = new CompletePurchaseResponse($this->createMockeryRequest(), $handler);

        $this->assertInstanceOf(CompletePurchaseResponse::class, $response);
        $this->assertTrue($response->isSuccessful());
        $this->assertFalse($response->isRedirect());
        $this->assertFalse($response->isCancelled());
        $this->assertNull($response->getMessage());
        $this->assertSame('00', $response->getCode());
        $this->assertSame('2400009912300000019', $response->getTransactionReference());
        $this->assertEquals(['foo' => 'bar', 'errcode' => '00'], $response->getData());
    }

    public function test_failed_response_by_exception()
    {
        $response = new CompletePurchaseResponse($this->createMockeryRequest(), null, new HandlerException('Custom Error'));

        $this->assertInstanceOf(CompletePurchaseResponse::class, $response);
        $this->assertFalse($response->isSuccessful());
        $this->assertFalse($response->isRedirect());
        $this->assertTrue($response->isCancelled());
        $this->assertSame('Custom Error', $response->getMessage());
    }

    public function test_failed_response_by_esafe()
    {
        $handler = $this->createMockeryHandler();
        $handler->shouldReceive('getParameters')->withNoArgs()
            ->andReturn([
                'foo' => 'bar',
                'errcode' => '01', // Something wrong.
                'errmsg' => 'Custom Error',
            ]);
        $response = new CompletePurchaseResponse($this->createMockeryRequest(), $handler);

        $this->assertInstanceOf(CompletePurchaseResponse::class, $response);
        $this->assertFalse($response->isSuccessful());
        $this->assertFalse($response->isRedirect());
        $this->assertTrue($response->isCancelled());
        $this->assertSame('2400009912300000019', $response->getTransactionReference());
        $this->assertSame('Custom Error', $response->getMessage());
        $this->assertEquals(['foo' => 'bar', 'errcode' => '01', 'errmsg' => 'Custom Error'], $response->getData());
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

        return $handler;
    }
}
