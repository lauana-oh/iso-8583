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

    public function setSpecification(array $settings): self
    {
        $this->specification = new Specification($settings);

        return $this;
    }

    public function pack(array $fieldsData)
    {
        $fieldsData['bitmap'] = array_keys($fieldsData);

        return Pipeline::pack(new DataHolder($fieldsData))
            ->through($this->createPipes(array_keys($fieldsData)))
            ->thenReturnMessage();
    }

    public function unpack(string $message)
    {
        $message = new ByteStream($message);

        $data = Pipeline::unpack($message)
            ->through($this->createPipes([0, 'bitmap']))
            ->thenReturnData();

        return Pipeline::unpack($message, $data)
            ->through($this->createPipes($data->getField('bitmap')))
            ->thenReturnData()
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
