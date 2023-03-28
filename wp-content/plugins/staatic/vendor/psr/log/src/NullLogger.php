<?php

namespace Staatic\Vendor\Psr\Log;

use Stringable;
class NullLogger extends AbstractLogger
{
    /**
     * @param string|Stringable $message
     * @param mixed[] $context
     * @return void
     */
    public function log($level, $message, $context = [])
    {
    }
}
