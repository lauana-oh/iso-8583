<?php

namespace LauanaOh\Iso8583;

use LauanaOh\Iso8583\Contracts\Iso8583MessageContract;
use LauanaOh\Iso8583\Entities\ByteStream;
use LauanaOh\Iso8583\Entities\DataHolder;
use LauanaOh\Iso8583\Entities\Specification;
use LauanaOh\Iso8583\Support\Pipeline;

class Iso8583Message implements Iso8583MessageContract
{
    private Specification $specification;

    public function __construct(array $setting = [])
    {
        $this->setSpecification($setting);
    }

    public function setSpecification(array $settings): self
    {
        $this->specification = new Specification($settings);

        return $this;
    }

    public function pack(array $fieldsData)
    {
        $fieldsData['bitmap'] = array_keys($fieldsData);

        return Pipeline::send(new DataHolder($fieldsData), new ByteStream())
            ->through($this->createPipes(array_keys($fieldsData)))
            ->pack()
            ->andReturnMessage();
    }

    public function unpack(string $message)
    {
        $message = new ByteStream($message);

        $data = Pipeline::send(new DataHolder(), $message)
            ->through($this->createPipes([0, 'bitmap']))
            ->unpack()
            ->andReturnData();

        return Pipeline::send($data, $message)
            ->through($this->createPipes($data->getField('bitmap')))
            ->unpack()
            ->andReturnData()
            ->unsetField('bitmap')
            ->toArray();
    }

    protected function createPipes(array $fields): array
    {
        foreach ($fields as $field) {
            $fieldPipe = $this->specification->getFieldPipe($field);
            $pipes[$fieldPipe->getKey()] = $fieldPipe;
        }

        ksort($pipes);

        return $pipes;
    }
}
