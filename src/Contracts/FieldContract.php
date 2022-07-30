<?php

namespace Lauana\Iso\Contracts;

interface FieldContract extends PipeContract
{
    /**
     * @param PipeContract[] $components
     */
    public function setComponents(array $components): self;

    public function setPadding(PaddingContract $padding): self;

    public function getKey(): string;
}
