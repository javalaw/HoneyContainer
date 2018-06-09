<?php

namespace Honey\Container\Exception;

use Psr\Container\NotFoundExceptionInterface;

/**
 * Class ContainerNotFoundException
 * @package Honey\Container\Exception
 */
class ContainerNotFoundException extends \Exception implements NotFoundExceptionInterface
{

}