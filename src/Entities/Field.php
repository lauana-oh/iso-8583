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
    protected ?Padding $padding = null;

    public function pack(DataHolder $data, ByteStream $message, Closure $next)
    {
        $dataHolder = new DataHolder([
            'value' => $data->getField($this->key),
            'padding' => $this->padding,
        ]);

        $message = Pipeline::pack($dataHolder, $message)
            ->through($this->components)
            ->thenReturnMessage();

        return $next($data, $message);
    }

    public function unpack(DataHolder $data, ByteStream $message, Closure $next)
    {
        $fieldData = Pipeline::unpack($message, new DataHolder(['padding' => $this->padding]))
            ->through($this->components)
            ->thenReturnData();

        $data->setField($fieldData->getField('key'), $fieldData->getField('value'));

        return $next($data, $message);
    }

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

    public function setPadding(Padding $padding): self
    {
        $this->padding = $padding;
        return $this;
    }

    public function getKey(): string
    {
        return $this->key;
    }
}