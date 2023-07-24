<?php

namespace Yoppy0x100\LaraLogs;

use Yoppy0x100\LaraLogs\LaraLogsInterface;

class LaraLogs extends Helper implements LaraLogsInterface
{
    public function ip()
    {
        return $this->request->ip();
    }
    public function browser()
    {
        return $this->agent->browser($this->ua);
    }
    public function useragent()
    {
        return $this->request->userAgent();
    }

    public function url(): string
    {
        return $this->request->fullUrl();
    }

    public function path()
    {
        return $this->request->path();
    }

    public function method(): string
    {
        return $this->request->getMethod();
    }

    public function request()
    {
        return $this->request->all();
    }

    public function referer()
    {
        return $_SERVER['HTTP_REFERER'] ?? null;
    }

    public function headers()
    {
        return $this->request->headers->all();
    }

    public function device()
    {
        return $this->agent->device($this->ua);
    }

    public function languages()
    {
        return $this->agent->languages();
    }

    public function platform()
    {
        return $this->agent->platform($this->ua);
    }
}
