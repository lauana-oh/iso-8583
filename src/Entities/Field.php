<?php

namespace Lauana\Iso\Entities;

use Closure;
use Lauana\Iso\Contracts\PipeContract;
use Lauana\Iso\Support\Pipeline;

class Field implements PipeContract
{
    /**
     * @var PipeContract[]
     */
    protected array $components = [];

    protected string $key = '';

    /**
     * @param PipeContract[] $components
     */
    public function setComponents(array $components): self
    {
        $this->components = $components;

        if (isset($this->components['key'])) {
            $this->key = $this->components['key']->getValue();
        }

        return $this;
    }

    public function getKey(): string
    {
        return $this->key;
    }

    public function pack(DataHolder $data, ByteStream $message, Closure $next)
    {
        $message = Pipeline::pack(new DataHolder(['value' => $data->getField($this->key)]), $message)
            ->through($this->components)
            ->thenReturnMessage();

        return $next($data, $message);
    }

    public function unpack(DataHolder $data, ByteStream $message, Closure $next)
    {
        $fieldData = Pipeline::unpack($message)->through($this->components)->thenReturnData();

        $data->setField($fieldData->getField('key'), $fieldData->getField('value'));

        return $next($data, $message);
    }
}