<?php

namespace LauanaOh\Iso8583\Contracts;

interface CompoundTypeContract extends TypeContract
{
    public function setComponents(array $components): self;
}
