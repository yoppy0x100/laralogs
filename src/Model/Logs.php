<?php

namespace Yoppy0x100\LaraLogs\Model;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Logs extends Model
{
    use HasFactory;

    protected $guarded = ['id'];

    protected $casts = [
        'request'   => 'array',
        'languages' => 'array',
        'headers'   => 'array',
    ];

    public function __construct(array $attr = [])
    {
        if (!isset($this->table)) {
            $this->setTable(config('logs.table'));
        }
        parent::__construct($attr);
    }
}
