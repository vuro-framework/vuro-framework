<?php declare(strict_types=1);
/**
 * MIT License
 *
 * Copyright (c) 2021 Vuro Framework
 *
 * Permission is hereby granted, free of charge, to any person obtaining a copy
 * of this software and associated documentation files (the "Software"), to deal
 * in the Software without restriction, including without limitation the rights
 * to use, copy, modify, merge, publish, distribute, sublicense, and/or sell
 * copies of the Software, and to permit persons to whom the Software is
 * furnished to do so, subject to the following conditions:
 *
 * The above copyright notice and this permission notice shall be included in all
 * copies or substantial portions of the Software.
 *
 * THE SOFTWARE IS PROVIDED "AS IS", WITHOUT WARRANTY OF ANY KIND, EXPRESS OR
 * IMPLIED, INCLUDING BUT NOT LIMITED TO THE WARRANTIES OF MERCHANTABILITY,
 * FITNESS FOR A PARTICULAR PURPOSE AND NONINFRINGEMENT. IN NO EVENT SHALL THE
 * AUTHORS OR COPYRIGHT HOLDERS BE LIABLE FOR ANY CLAIM, DAMAGES OR OTHER
 * LIABILITY, WHETHER IN AN ACTION OF CONTRACT, TORT OR OTHERWISE, ARISING FROM,
 * OUT OF OR IN CONNECTION WITH THE SOFTWARE OR THE USE OR OTHER DEALINGS IN THE
 * SOFTWARE.
 */

namespace Vuro\PasswordHashing;

use ArrayAccess;
use RuntimeException;

/**
 * The sodium password hasher.
 */
abstract class AbstractPasswordHasher implements ArrayAccess
{
    /**
     * Type-Hints are not needed for this method.
     * This method is not supported.
     */
    public function offsetExists($offset)
    {
        throw new RuntimeException('The ArrayAccess `exists` method is not supported.');
    }

    /**
     * Compute a hash.
     * Type-Hints are not needed for this method.
     *
     * @param mixed $offset The password to hash.
     *
     * @return mixed Can return all value types.
     */
    public function offsetGet($offset)
    {
        return $this->compute($offset);
    }

    /**
     * Type-Hints are not needed for this method.
     * This method is not supported.
     */
    public function offsetSet($offset, $value)
    {
        throw new RuntimeException('The ArrayAccess `set` method is not supported.');
    }

    /**
     * Type-Hints are not needed for this method.
     * This method is not supported.
     */
    public function offsetUnset($offset)
    {
        throw new RuntimeException('The ArrayAccess `unset` method is not supported.');
    }
}
