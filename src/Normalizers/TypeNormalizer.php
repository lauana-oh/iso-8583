<?php

namespace LauanaOh\Iso8583\Normalizers;

use Closure;
use LauanaOh\Iso8583\Contracts\NormalizerContract;
use Symfony\Component\OptionsResolver\Options;

class TypeNormalizer implements NormalizerContract
{
    public function createCallable(): Closure
    {
        return static function(Options $options, $value) {
            $value = str_replace('.', '', $value, $length);

            return compact('value', 'length');
        };
    }
}