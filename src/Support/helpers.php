<?php

use Lauana\Iso\Helpers\ContainerHelper;
use Lauana\Iso\Iso8583Message;
use Pimple\Container;

if (! function_exists('iso8583_container')) {
    function iso8583_container($abstract = null)
    {
        static $container;

        if (! $container) {
            $container = new Container();
            require __DIR__. '/../../config/container.php';
        }

        return $abstract !== null ? $container[$abstract] : $container;
    }
}

if (! function_exists('iso8583_encode')) {
    function iso8583_encode(array $data, array $settings = [])
    {
        return ContainerHelper::getIso8583Message()
            ->setSpecification($settings)
            ->pack($data)
            ->getCurrentBytes();
    }
}

if (! function_exists('iso8583_decode')) {
    function iso8583_decode(string $data, array $settings = [])
    {
        return ContainerHelper::getIso8583Message()
            ->setSpecification($settings)
            ->unpack($data);
    }
}

if (! function_exists('convert_bits_to_hex')) {
    function convert_bits_to_hex(string $bits): string
    {
        $hex = '';

        while (! empty($bits)) {
            $byte = substr($bits, 0, 8);
            $hex .= str_pad(dechex(bindec($byte)), 2, '0', STR_PAD_LEFT);
            $bits = substr($bits, 8);
        }

        return strtoupper($hex);
    }
}

if (! function_exists('convert_hex_to_bits')) {
    function convert_hex_to_bits(string $hex): string
    {
        $bits = '';

        while (! empty($hex)) {
            $bits .= str_pad(
                base_convert(substr($hex, 0, 2), 16, 2),
                8,
                0,
                STR_PAD_LEFT
            );

            $hex = substr($hex, 2);
        }

        return $bits;
    }
}