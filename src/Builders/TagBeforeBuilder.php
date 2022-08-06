<?php

namespace LauanaOh\Iso8583\Builders;

use LauanaOh\Iso8583\Constants\Tag;
use LauanaOh\Iso8583\Contracts\TagContract;
use LauanaOh\Iso8583\Helpers\ContainerHelper;

class TagBeforeBuilder extends DefaultFieldBuilder
{
    protected function getTagPipe(string $field, array $settings): TagContract
    {
        return ContainerHelper::getTag(Tag::TYPE_VISIBLE)
            ->setValue($field)
            ->setEncoder(ContainerHelper::getEncoder($settings['encode']['tag']));
    }
}