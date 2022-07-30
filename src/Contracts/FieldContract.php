<?php

namespace Lauana\Iso\Contracts;

interface FieldContract extends PipeContract
{
    /**
     * @param PipeContract[] $components
     */
    public function setComponents(array $components): FieldContract;

    public function setPadding(PaddingContract $padding): FieldContract;

    public function getKey(): string;
}