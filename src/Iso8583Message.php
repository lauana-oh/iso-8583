<?php

namespace Lauana\Iso;

use Lauana\Iso\Entities\DataHolder;
use Lauana\Iso\Entities\Specification;
use Lauana\Iso\Support\Pipeline;

class Iso8583Message
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