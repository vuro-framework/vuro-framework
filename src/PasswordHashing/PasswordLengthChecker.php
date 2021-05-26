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

use ParagonIE\ConstantTime\Binary;

/**
 * The password length checker.
 */
trait PasswordLengthChecker
{
    /** @const int MAX_LENGTH The max length of the password. */
    const MAX_LENGTH = 72;

    /**
     * Check to see if a password is too long.
     *
     * @param string $password The user's password.
     *
     * @return bool Returns true if the password is too long
     *              else return false.
     */
    public function isPasswordTooLong(string $password): bool
    {
        return Binary::safeStrlen($password) > self::MAX_LENGTH;
    }
}
