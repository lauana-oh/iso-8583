<?php

namespace LauanaOh\Iso8583\Normalizers;

use Closure;
use LauanaOh\Iso8583\Contracts\NormalizerContract;
use Symfony\Component\OptionsResolver\Options;

class EncodeNormalizer implements NormalizerContract
{
    public function createCallable(): Closure
    {
        return static function (Options $options, $encodes) {
            return [
                'value' => $encodes[1] ?? $encodes[0],
                'length' => $encodes[0],
            ];
        };
    }
}
