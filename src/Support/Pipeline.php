<?php

namespace LauanaOh\Iso8583\Support;

use Closure;
use LauanaOh\Iso8583\Contracts\PipeContract;
use LauanaOh\Iso8583\Entities\ByteStream;
use LauanaOh\Iso8583\Entities\DataHolder;

class Pipeline
{
    /**
     * @var PipeContract[]
     */
    protected array $pipes;
    protected DataHolder $data;
    protected ByteStream $message;
    protected string $method;

    protected function __construct(DataHolder $data, ByteStream $message)
    {
        $this->data = $data;
        $this->message = $message;
    }

    protected static function send(DataHolder $data, ByteStream $message): self
    {
        return new static($data, $message);
    }

    public static function pack(DataHolder $data, ByteStream $message = null): self
    {
        $message ??= new ByteStream();

        return self::send($data, $message)->via('pack');
    }

    public static function unpack(ByteStream $message, DataHolder $data = null): self
    {
        $data ??= new DataHolder();

        return self::send($data, $message)->via('unpack');
    }

    public function through($pipes): self
    {
        $this->pipes = is_array($pipes) ? $pipes : func_get_args();

        return $this;
    }

    public function thenReturnData(): DataHolder
    {
        return $this->then(function (DataHolder $data, ByteStream $message) {
            return $data;
        });
    }

    public function thenReturnMessage(): ByteStream
    {
        return $this->then(function (DataHolder $data, ByteStream $message) {
            return $message;
        });
    }

    protected function via(string $method): self
    {
        $this->method = $method;

        return $this;
    }

    protected function then(Closure $destination)
    {
        $pipeline = array_reduce(array_reverse($this->pipes), $this->carry(), $this->prepareDestination($destination));

        return $pipeline($this->data, $this->message);
    }

    protected function carry(): Closure
    {
        return function (Closure $stack, PipeContract $pipe) {
            return function (DataHolder $data, ByteStream $message) use ($stack, $pipe) {
                return $pipe->{$this->method}($data, $message, $stack);
            };
        };
    }

    protected function prepareDestination(Closure $destination): Closure
    {
        return function (DataHolder $data, ByteStream $message) use ($destination) {
            return $destination($data, $message);
        };
    }
}
