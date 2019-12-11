<?php

namespace Test\Message;

use Mockery;
use Muzik\EsafeSdk\Exceptions\RefundException;
use Muzik\OmnipayEsafe\Message\RefundRequest;
use Muzik\OmnipayEsafe\Message\RefundResponse;
use Omnipay\Common\Message\RequestInterface;
use PHPUnit\Framework\TestCase;

class RefundResponseTest extends TestCase
{
    protected function tearDown(): void
    {
        Mockery::close();
        parent::tearDown();
    }

    public function test_success_response()
    {
        $response = new RefundResponse($this->createMockeryRequest());

        $this->assertInstanceOf(RefundResponse::class, $response);
        $this->assertTrue($response->isSuccessful());
        $this->assertFalse($response->isRedirect());
        $this->assertFalse($response->isCancelled());
        $this->assertSame('E0', $response->getMessage());
        $this->assertSame('E0', $response->getCode());
    }

    public function test_failed_response()
    {
        $response = new RefundResponse($this->createMockeryRequest(), new RefundException('Custom Error', 0));

        $this->assertInstanceOf(RefundResponse::class, $response);
        $this->assertFalse($response->isSuccessful());
        $this->assertFalse($response->isRedirect());
        $this->assertTrue($response->isCancelled());
        $this->assertSame('Custom Error', $response->getMessage());
        $this->assertSame(0, $response->getCode());
    }

    protected function createMockeryRequest()
    {
        return Mockery::mock(RefundRequest::class);
    }
}