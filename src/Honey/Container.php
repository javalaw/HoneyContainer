<?php
/**
 * the service container of honey
 */

namespace Honey\Container;


use Honey\Container\Exception\ContainerException;
use Honey\Container\Exception\ContainerNotFoundException;
use Psr\Container\ContainerExceptionInterface;
use Psr\Container\ContainerInterface;
use Psr\Container\NotFoundExceptionInterface;

/**
 * Class Container
 * @package Honey\Container
 */
class Container implements ContainerInterface
{

    protected static $services = [];

    /**
     * Finds an entry of the container by its identifier and returns it.
     *
     * @param string $id Identifier of the entry to look for.
     *
     * @throws NotFoundExceptionInterface  No entry was found for **this** identifier.
     * @throws ContainerExceptionInterface Error while retrieving the entry.
     *
     * @return mixed Entry.
     */
    public function get($id)
    {
        if (!$this->exists($id)) {
            throw (new ContainerNotFoundException());
        }
        return self::$services[$id];
    }

    /**
     * Returns true if the container can return an entry for the given identifier.
     * Returns false otherwise.
     *
     * `has($id)` returning true does not mean that `get($id)` will not throw an exception.
     * It does however mean that `get($id)` will not throw a `NotFoundExceptionInterface`.
     *
     * @param string $id Identifier of the entry to look for.
     *
     * @return bool
     */
    public function has($id): bool
    {
        return $this->exists($id);
    }

    /**
     * @param string $id
     * @return bool
     */
    public function exists(string $id): bool
    {
        return isset(static::$services[$id]);
    }

    /**
     * @param string $abstract
     * @param string $concrete
     * @return bool
     */
    public function bind(string $abstract, string $concrete): bool
    {
        if (isset(self::$services[$abstract])){
            return false;
        }
        self::$services[$abstract] = $concrete;
        return true;
    }
}