<?php

namespace Test\Message;

use Mockery;
use Muzik\EsafeSdk\Esafe;
use PHPUnit\Framework\TestCase;
use Muzik\EsafeSdk\Services\RefundService;
use Muzik\OmnipayEsafe\Message\RefundRequest;
use Muzik\EsafeSdk\Exceptions\RefundException;
use Muzik\OmnipayEsafe\Message\RefundResponse;

class RefundRequestTest extends TestCase
{
    public function tearDown(): void
    {
        Mockery::close();
        parent::tearDown();
    }

    public function test_constructable()
    {
        $request = new RefundRequest(Mockery::mock(Esafe::class));

        $this->assertInstanceOf(RefundRequest::class, $request);
    }

    public function test_initialize()
    {
        $request = new RefundRequest(Mockery::mock(Esafe::class));
        $request->initialize(['foo' => 'bar']);

        $this->assertEquals(['foo' => 'bar'], $request->getParameters());
    }

    public function test_is_testing()
    {
        $request = new RefundRequest(Mockery::mock(Esafe::class));

        $this->assertFalse($request->isTesting());

        $request->initialize(['testing' => true]);

        $this->assertTrue($request->isTesting());
    }

    public function test_send_success()
    {
        $refundService = Mockery::mock(RefundService::class);
        $refundService->shouldReceive('send')->once();
        $sdk = Mockery::mock(Esafe::class);
        $sdk->shouldReceive('refund')->with(['foo' => 'bar'], false)->once()->andReturn($refundService);

        $request = new RefundRequest($sdk);
        $request->initialize(['foo' => 'bar']);
        $response = $request->send();

        $this->assertInstanceOf(RefundResponse::class, $response);
        $this->assertTrue($response->isSuccessful());
    }

    public function test_send_failed()
    {
        $refundService = Mockery::mock(RefundService::class);
        $refundService->ShouldReceive('send')->once()->andThrow(new RefundException('Custom Error', 0));
        $sdk = Mockery::mock(Esafe::class);
        $sdk->shouldReceive('refund')->with(['foo' => 'bar'], false)->once()->andReturn($refundService);

        $request = new RefundRequest($sdk);
        $request->initialize(['foo' => 'bar']);
        $response = $request->send();

        $this->assertInstanceOf(RefundResponse::class, $response);
        $this->assertFalse($response->isSuccessful());
    }
}
