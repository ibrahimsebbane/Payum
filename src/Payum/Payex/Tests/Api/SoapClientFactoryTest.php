<?php

namespace Payum\Payex\Tests\Api;

use Payum\Payex\Api\SoapClientFactory;
use PHPUnit\Framework\TestCase;
use SoapClient;

class SoapClientFactoryTest extends TestCase
{
    public function testShouldAllowCreateSoapClientWithDefaultClassAndOptions()
    {
        $factory = new SoapClientFactory();

        $client = $factory->createWsdlClient('https://external.externaltest.payex.com/pxorder/pxorder.asmx?WSDL');

        $this->assertInstanceOf(SoapClient::class, $client);
    }

    public function testShouldAllowCreateSoapClientWithCustomClassAndOptions()
    {
        $options = [
            'trace' => true,
            'exceptions' => true,
        ];

        $factory = new SoapClientFactory($options, 'Payum\Payex\Tests\Api\CustomSoapClient');

        $client = $factory->createWsdlClient('https://external.externaltest.payex.com/pxorder/pxorder.asmx?WSDL');

        $this->assertInstanceOf(CustomSoapClient::class, $client);
    }
}

class CustomSoapClient extends SoapClient
{
}
