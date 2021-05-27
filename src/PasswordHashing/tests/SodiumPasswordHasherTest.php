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

namespace Vuro\Framework\Tests;

use InvalidArgumentException;
use PHPUnit\Framework\TestCase;
use Vuro\PasswordHashing\SodiumPasswordHasher as PasswordHasher;
use Vuro\PasswordHashing\StandardPasswordHasher as PwHasher;

/**
 * Test the sodium password hasher.
 */
class SodiumPasswordHasherTest extends TestCase
{
    /**
     * @return void Returns nothing.
     */
    public function testSodiumConstruction(): void
    {
        $hasher = new PasswordHasher();
        $this->assertInstanceOf(PasswordHasher::class, $hasher);
    }

    /**
     * @return void Returns nothing.
     */
    public function testSodiumCompute(): void
    {
        $hasher = new PasswordHasher();
        $this->assertInstanceOf(PasswordHasher::class, $hasher);
        $password = $hasher->compute('password');
        $this->assertTrue(is_string($password));
    }

    /**
     * @return void Returns nothing.
     */
    public function testSodiumVerify(): void
    {
        $hasher = new PasswordHasher();
        $this->assertInstanceOf(PasswordHasher::class, $hasher);
        $password = $hasher->compute('password');
        $this->assertTrue(is_string($password));
        $this->assertTrue(!$hasher->verify('incorrect', $password));
        $this->assertTrue($hasher->verify('password', $password));
    }

    /**
     * @return void Returns nothing.
     */
    public function testBcrypt2SodiumRehash(): void
    {
        $hasher = new PwHasher(PASSWORD_BCRYPT);
        $this->assertEquals(PASSWORD_BCRYPT, $hasher->passwordAlgo);
        $password = $hasher->compute('password');
        $this->assertTrue(is_string($password));
        $hasher2 = new PasswordHasher();
        $this->assertInstanceOf(PasswordHasher::class, $hasher2);
        $this->assertTrue($hasher2->needsRehash($password));
        $password = $hasher2->compute('password');
        $this->assertTrue(is_string($password));
        $this->assertTrue(!$hasher2->needsRehash($password));
    }

    /**
     * @return void Returns nothing.
     */
    public function testArgon2i2SodiumRehash(): void
    {
        $hasher = new PwHasher(PASSWORD_ARGON2I);
        $this->assertEquals(PASSWORD_ARGON2I, $hasher->passwordAlgo);
        $password = $hasher->compute('password');
        $this->assertTrue(is_string($password));
        $hasher2 = new PasswordHasher();
        $this->assertInstanceOf(PasswordHasher::class, $hasher2);
        $this->assertTrue($hasher2->needsRehash($password));
        $password = $hasher2->compute('password');
        $this->assertTrue(is_string($password));
        $this->assertTrue(!$hasher2->needsRehash($password));
    }

    /**
     * @return void Returns nothing.
     */
    public function testArgon2id2SodiumRehash(): void
    {
        $hasher = new PwHasher(PASSWORD_ARGON2ID);
        $this->assertEquals(PASSWORD_ARGON2ID, $hasher->passwordAlgo);
        $password = $hasher->compute('password');
        $this->assertTrue(is_string($password));
        $hasher2 = new PasswordHasher();
        $this->assertInstanceOf(PasswordHasher::class, $hasher2);
        $this->assertTrue($hasher2->needsRehash($password));
        $password = $hasher2->compute('password');
        $this->assertTrue(is_string($password));
        $this->assertTrue(!$hasher2->needsRehash($password));
    }
}
