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

/**
 * The sodium password hasher.
 */
class SodiumPasswordHasher extends AbstractPasswordHasher implements PasswordHasherInterface
{
    /**
     * Compute the user's passwod hash.
     *
     * @param string $password The user's password.
     *
     * @return string|false Returns the hashed password, or false on failure. 
     */
    public function compute(string $password): string|false
    {
        $generatedHash = sodium_crypto_pwhash_str(
            $password,
            SODIUM_CRYPTO_PWHASH_OPSLIMIT_INTERACTIVE,
            SODIUM_CRYPTO_PWHASH_MEMLIMIT_INTERACTIVE
        );
        sodium_memzero($password);
        return $generatedHash;
    }

    /**
     * Verifies that a password matches a hash.
     *
     * @param string $password The user's password.
     * @param string $hash     A hash created by self::compute().
     *
     * @return bool Returns true if the password and hash match, or false otherwise. 
     */
    public function verify(string $password, string $hash): bool
    {
        $verified = sodium_crypto_pwhash_str_verify($hash, $password);
        sodium_memzero($password);
        return $verified;
    }

    /**
     * Checks if the given hash matches the options of the hasher.
     *
     * @param string $hash A hash created by self::compute().
     *
     * @return bool Returns true if the hash should be rehashed to match the current
     *              hasher algo and options, or false otherwise. 
     */
    public function needsRehash(string $hash): bool
    {
        return sodium_crypto_pwhash_str_needs_rehash(
            $hash,
            SODIUM_CRYPTO_PWHASH_OPSLIMIT_INTERACTIVE,
            SODIUM_CRYPTO_PWHASH_MEMLIMIT_INTERACTIVE
        );
    }
}
