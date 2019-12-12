<?php

namespace Test\Message;

use Mockery;
use Muzik\EsafeSdk\Esafe;
use PHPUnit\Framework\TestCase;
use Muzik\EsafeSdk\Handlers\CreditCard;
use Muzik\EsafeSdk\Exceptions\HandlerException;
use Muzik\OmnipayEsafe\Message\AcceptNotificationRequest;

class AcceptNotificationRequestTest extends TestCase
{
    protected function tearDown(): void
    {
        Mockery::close();
        parent::tearDown(); // TODO: Change the autogenerated stub
    }

    public function test_constructable()
    {
        $request = new AcceptNotificationRequest(Mockery::mock(Esafe::class));

        $this->assertInstanceOf(AcceptNotificationRequest::class, $request);
    }

    public function test_initialize()
    {
        $request = new AcceptNotificationRequest(Mockery::mock(Esafe::class));
        $request->initialize(['handler' => Esafe::HANDLER_CREDIT_CARD] + ['foo' => 'bar']);

        $this->assertEquals([
            'handler' => Esafe::HANDLER_CREDIT_CARD,
            'foo' => 'bar',
        ], $request->getParameters());
    }

    public function test_is_testing()
    {
        $request = new AcceptNotificationRequest(Mockery::mock(Esafe::class));

        $this->assertFalse($request->isTesting());

        $request->initialize(['handler' => Esafe::HANDLER_CREDIT_CARD, 'testing' => true]);

        $this->assertTrue($request->isTesting());
    }

    public function test_send_success()
    {
        $handler = Mockery::mock(CreditCard::class);
        $sdk = Mockery::mock(Esafe::class);
        $sdk->shouldReceive('handle')
            ->with(Esafe::HANDLER_CREDIT_CARD, ['handler' => Esafe::HANDLER_CREDIT_CARD, 'foo' => 'bar'])->once()
            ->andReturn($handler);

        $request = new AcceptNotificationRequest($sdk);
        $request->initialize(['handler' => Esafe::HANDLER_CREDIT_CARD, 'foo' => 'bar']);
        $response = $request->send();

        $this->assertTrue($response->isSuccessful());
    }

    public function test_send_failed()
    {
        $sdk = Mockery::mock(Esafe::class);
        $sdk->shouldReceive('handle')
            ->with(Esafe::HANDLER_CREDIT_CARD, ['handler' => Esafe::HANDLER_CREDIT_CARD, 'foo' => 'bar'])->once()
            ->andThrow(new HandlerException('Custom Error'));

        $request = new AcceptNotificationRequest($sdk);
        $request->initialize(['handler' => Esafe::HANDLER_CREDIT_CARD, 'foo' => 'bar']);
        $response = $request->send();

        $this->assertFalse($response->isSuccessful());
    }
}
