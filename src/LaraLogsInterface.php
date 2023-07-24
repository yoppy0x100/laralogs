<?php

namespace Yoppy0x100\LaraLogs;

interface LaraLogsInterface
{
    public function ip();
    public function browser();
    public function userAgent();
    public function url();
    public function path();
    public function method();
    public function request();
    public function referer();
    public function headers();

    public function languages();
    public function device();
    public function location();
    public function platform();
