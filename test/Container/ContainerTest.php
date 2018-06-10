<?php

use Honey\Container\Container;
use PHPUnit\Framework\TestCase;

class ContainerTest extends TestCase
{

    public function testBindAbstractToConcrete()
    {
        $container = new Container();
        $bind_result = $container->bind(Psr\Container\ContainerInterface::class, Honey\Container\Container::class);
        $this->assertEquals(true, $bind_result);
        return $container;
    }

    /**
     * @depends testBindAbstractToConcrete
     * @param Container $container
     */
    public function testRebindAbstractToConcrete(Honey\Container\Container $container){
        $bind_result = $container->bind(Psr\Container\ContainerInterface::class, Honey\Container\Container::class);
        $this->assertEquals(false, $bind_result);
    }

    /**
     * @depends testBindAbstractToConcrete
     * @param Container $container
     */
    public function testGetService(Honey\Container\Container $container)
    {
        $service = $container->get(Psr\Container\ContainerInterface::class);
        $this->assertInstanceOf(Honey\Container\Container::class, $service);
    }

    /**
     * @depends testBindAbstractToConcrete
     * @param Container $container
     */
    public function testGetServiceNotExist(Honey\Container\Container $container)
    {
        $this->expectException(Psr\Container\NotFoundExceptionInterface::class);
        $container->get('some other class');
    }

    /**
     * @depends testBindAbstractToConcrete
     * @param Container $container
     */
    public function testHas(Honey\Container\Container $container)
    {
        $hasResult = $container->has(Psr\Container\ContainerInterface::class);
        $this->assertEquals(true, $hasResult);
    }
}