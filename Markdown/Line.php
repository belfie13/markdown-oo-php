<?php
/**
 * Copyright (C) 2011, Maxim S. Tsepkov
 *
 * Permission is hereby granted, free of charge, to any person obtaining a copy
 * of this software and associated documentation files (the "Software"), to deal
 * in the Software without restriction, including without limitation the rights
 * to use, copy, modify, merge, publish, distribute, sublicense, and/or sell
 * copies of the Software, and to permit persons to whom the Software is
 * furnished to do so, subject to the following conditions:
 *
 * The above copyright notice and this permission notice shall be included in
 * all copies or substantial portions of the Software.
 *
 * THE SOFTWARE IS PROVIDED "AS IS", WITHOUT WARRANTY OF ANY KIND, EXPRESS OR
 * IMPLIED, INCLUDING BUT NOT LIMITED TO THE WARRANTIES OF MERCHANTABILITY,
 * FITNESS FOR A PARTICULAR PURPOSE AND NONINFRINGEMENT. IN NO EVENT SHALL THE
 * AUTHORS OR COPYRIGHT HOLDERS BE LIABLE FOR ANY CLAIM, DAMAGES OR OTHER
 * LIABILITY, WHETHER IN AN ACTION OF CONTRACT, TORT OR OTHERWISE, ARISING FROM,
 * OUT OF OR IN CONNECTION WITH THE SOFTWARE OR THE USE OR OTHER DEALINGS IN
 * THE SOFTWARE.
 */

namespace Markdown;

/**
 * Text consist of lines. This is a line.
 *
 * @package Markdown
 * @subpackage Text
 * @author Max Tsepkov <max@garygolden.me>
 * @version 1.0
 */
class Line extends \ArrayObject
{
    const NONE        = 0;
    const NOMARKDOWN  = 1;
    const CODEBLOCK   = 2;
    const LISTS       = 4;

    protected $_flags = self::NONE;

    public function __construct($line)
    {
        if (is_string($line) || method_exists($line, '__toString')) {
            $line = str_split((string) $line);
        }

        if (is_array($line)) {
            parent::__construct($line);
        }
        else {
            throw new \InvalidArgumentException('Line constructor expects array, string or stringable object.');
        }
    }

    public function __toString()
    {
        return implode('', (array) $this);
    }

    /**
     * Get or set flags.
     *
     * @param int $flags
     */
    public function flags($flags = null)
    {
        if ($flags !== null) {
            if (is_integer($flags)) {
                $this->_flags = $flags;
            }
            else {
                throw new \InvalidArgumentException('Flags must be an integer value.');
            }
        }

        return $this->_flags;
    }
}