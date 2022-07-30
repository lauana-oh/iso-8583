<?php

namespace LauanaOh\Iso8583\Entities;

use Closure;
use LauanaOh\Iso8583\Contracts\FieldContract;
use LauanaOh\Iso8583\Contracts\PaddingContract;
use LauanaOh\Iso8583\Contracts\PipeContract;
use LauanaOh\Iso8583\Exceptions\InvalidValueException;
use LauanaOh\Iso8583\Support\Pipeline;
use Throwable;

class Field implements FieldContract
{
    /**
     * @var PipeContract[]
     */
    protected array $components = [];

    protected string $type = 'field';
    protected string $key = '';
    protected ?PaddingContract $padding = null;

    public function pack(DataHolder $data, ByteStream $message, Closure $next)
    {
        try {
            $dataHolder = new DataHolder([
                'value' => $data->getField($this->key),
                'padding' => $this->padding,
            ]);

            $message = Pipeline::pack($dataHolder, $message)
                ->through($this->components)
                ->thenReturnMessage();
        } catch (Throwable $exception) {
            throw InvalidValueException::invalidField($this->type, $this->getKey(), $exception);
        }

        return $next($data, $message);
    }

    public function unpack(DataHolder $data, ByteStream $message, Closure $next)
    {
        try {
            $fieldData = Pipeline::unpack($message, new DataHolder(['padding' => $this->padding]))
                ->through($this->components)
                ->thenReturnData();

            $data->setField($fieldData->getField('key'), $fieldData->getField('value'));
        } catch (Throwable $exception) {
            throw InvalidValueException::invalidField($this->type, $this->getKey(), $exception);
        }

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

    public function setPadding(PaddingContract $padding): self
    {
        $this->padding = $padding;

        return $this;
    }

    public function getKey(): string
    {
        return $this->key;
    }
}
