<?php

namespace Staatic\Vendor\Symfony\Component\DependencyInjection\ParameterBag;

use UnitEnum;
use Staatic\Vendor\Symfony\Component\DependencyInjection\Exception\LogicException;
use Staatic\Vendor\Symfony\Component\DependencyInjection\Exception\ParameterNotFoundException;
interface ParameterBagInterface
{
    public function clear();
    /**
     * @param mixed[] $parameters
     */
    public function add($parameters);
    public function all() : array;
    /**
     * @return mixed[]|bool|string|int|float|UnitEnum|null
     * @param string $name
     */
    public function get($name);
    /**
     * @param string $name
     */
    public function remove($name);
    /**
     * @param mixed[]|bool|string|int|float|UnitEnum|null $value
     * @param string $name
     */
    public function set($name, $value);
    /**
     * @param string $name
     */
    public function has($name) : bool;
    public function resolve();
    /**
     * @param mixed $value
     */
    public function resolveValue($value);
    /**
     * @param mixed $value
     * @return mixed
     */
    public function escapeValue($value);
    /**
     * @param mixed $value
     * @return mixed
     */
    public function unescapeValue($value);
}
