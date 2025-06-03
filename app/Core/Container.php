<?php
namespace App\Core;
use ReflectionClass;
use Exception;
class Container
{
    public function resolve(string $class)
    {
        if (!class_exists($class)) {
            throw new Exception("Class {$class} does not exist");
        }

        $reflection = new ReflectionClass($class);

        $constructor = $reflection->getConstructor();
        if (!$constructor) {
            return new $class;
        }

        $parameters = $constructor->getParameters();
        $dependencies = [];

        foreach ($parameters as $parameter) {
            $paramClass = $parameter->getType()?->getName();
            if (!$paramClass || !class_exists($paramClass)) {
                throw new Exception("Cannot resolve class dependency {$parameter->getName()}");
            }
            $dependencies[] = $this->resolve($paramClass); // рекурсивно
        }

        return $reflection->newInstanceArgs($dependencies);
    }
}