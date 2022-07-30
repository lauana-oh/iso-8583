<?php

namespace LauanaOh\Iso8583\Entities;

use Closure;
use LauanaOh\Iso8583\Contracts\FieldContract;
use LauanaOh\Iso8583\Contracts\PaddingContract;
use LauanaOh\Iso8583\Contracts\PipeContract;
use LauanaOh\Iso8583\Exceptions\DecodeException;
use LauanaOh\Iso8583\Exceptions\EncodeException;
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

            $message = Pipeline::send($dataHolder, $message)
                ->through($this->components)
                ->validate()
                ->pack()
                ->andReturnMessage();
        } catch (Throwable $exception) {
            throw EncodeException::invalidField($this->type, $this->getKey(), $exception);
        }

        return $next($data, $message);
    }

    public function unpack(DataHolder $data, ByteStream $message, Closure $next)
    {
        try {
            $fieldData = Pipeline::send(new DataHolder(['padding' => $this->padding]), $message)
                ->through($this->components)
                ->unpack()
                ->validate()
                ->andReturnData();

            $data->setField($fieldData->getField('key'), $fieldData->getField('value'));
        } catch (Throwable $exception) {
            throw DecodeException::invalidField($this->type, $this->getKey(), $exception);
        }

        return $next($data, $message);
    }

    public function validate(DataHolder $data, ByteStream $message, Closure $next)
    {
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
