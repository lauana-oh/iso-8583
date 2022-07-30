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

    public static function send(DataHolder $data, ByteStream $message): self
    {
        return new self($data, $message);
    }

    public function through($pipes): self
    {
        $this->pipes = is_array($pipes) ? $pipes : func_get_args();

        return $this;
    }

    public function validate(): self
    {
        return $this->via('validate')->run();
    }

    public function pack(): self
    {
        return $this->via('pack')->run();
    }

    public function unpack(): self
    {
        return $this->via('unpack')->run();
    }

    public function andReturnData(): DataHolder
    {
        return $this->data;
    }

    public function andReturnMessage(): ByteStream
    {
        return $this->message;
    }

    public function via(string $method): self
    {
        $this->method = $method;

        return $this;
    }

    public function run(): self
    {
        $this->then(fn (DataHolder $data, ByteStream $message) => null);

        return $this;
    }

    public function then(Closure $destination)
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
