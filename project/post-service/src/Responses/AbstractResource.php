<?php

namespace App\Responses;

use Exception;
use Symfony\Component\HttpFoundation\Response;

abstract class AbstractResource
{
    protected function __construct(array $params)
    {
        try {
            $reflectionClass = new \ReflectionClass($this);

            foreach ($params as $index => $param) {
                if ($reflectionClass->hasProperty($index)) {
                    $property = $reflectionClass->getProperty($index);
                    if ($property->isPublic()) {
                        $typeName = $this->getNormalizedType($param);
                        if ($property->getType()->getName() === $typeName) {
                            $property->setValue($this, $param);
                        }
                    }
                }
            }
        } catch (Exception $exception) {
            return null;
        }
    }

    private function getNormalizedType($var): string
    {
        if (is_int($var)) {
            return 'int';
        } elseif (is_float($var)) {
            return 'float';
        } elseif (is_string($var)) {
            return 'string';
        } elseif (is_bool($var)) {
            return 'bool';
        } elseif (is_array($var)) {
            return 'array';
        } elseif (is_object($var)) {
            return 'object';
        } elseif (is_null($var)) {
            return 'null';
        } elseif (is_resource($var)) {
            return 'resource';
        }

        return 'unknown';
    }

    public static function make(array $params): Response
    {
        return new Response(self::toString(new static($params)), Response::HTTP_OK);
    }


    /**
     * @throws Exception
     */
    public static function collection(array $entities, int $count): Response
    {
        try {
            $resources = [];
            foreach ($entities as $entity) {
                $arr = $entity->toArray();
                $resources[] = new static($arr);
            }
            return new Response(self::toString($resources), Response::HTTP_OK);
        } catch (Exception $exception) {
            throw new Exception("Не удалось преобразовать в ресурс");
        }
    }

    public static function toString(array|object $resource): string
    {
        if (is_array($resource)) {
            return json_encode(['data' => $resource, 'count' => count($resource)]);
        }
        return json_encode(['data' => $resource]);
    }
}