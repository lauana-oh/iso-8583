<?php

namespace LauanaOh\Iso8583\Types;

use Closure;
use LauanaOh\Iso8583\Contracts\CompoundTypeContract;
use LauanaOh\Iso8583\Contracts\PipeContract;
use LauanaOh\Iso8583\Entities\ByteStream;
use LauanaOh\Iso8583\Entities\DataHolder;
use LauanaOh\Iso8583\Support\Pipeline;
use LauanaOh\Iso8583\Traits\HasEncoder;

class FixedCompound implements CompoundTypeContract
{
    use HasEncoder;

    /**
     * @var PipeContract[]
     */
    protected array $components;

    public function pack(DataHolder $data, ByteStream $message, Closure $next)
    {
        $dataHolder = new DataHolder($data->getField('value'));

        $fieldMessage = Pipeline::send($dataHolder, new ByteStream())
            ->through($this->components)
            ->pack()
            ->validate()
            ->andReturnMessage();

        $message->concat($fieldMessage);

        $data->setField('valueSize', $this->encoder->getSize(strlen($fieldMessage->getCurrentBytes())));

        return $next($data, $message);
    }

    public function unpack(DataHolder $data, ByteStream $message, Closure $next)
    {
        $length = $data->getField('length');

        $compoundData = new DataHolder();
        $compoundMessage = $message->getNewByteStreamAndMoveCursor($this->encoder->getDigits($length));
        $data->setField('valueSize', $this->encoder->getSize(strlen($compoundMessage->getCurrentBytes())));

        $fieldData = Pipeline::send($compoundData, $compoundMessage)
            ->through($this->components)
            ->unpack()
            ->validate()
            ->andReturnData();

        $data->setField('value', $fieldData->toArray());
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

        return $this;
    }
}