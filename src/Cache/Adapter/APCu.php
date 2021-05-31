<?php declare(strict_types=1);
/**
 * MIT License
 *
 * Copyright (c) 2021 Ashley
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

namespace Vuro\Cache\Adapter;

use Traversable;

/**
 *  The APCu cache adapter.
 */
class APCu extends AbstractCacheAdapter implements AdapterInterface
{
    /**
     * Construct a new APCu adapter.
     *
     * @return void Returns nothing.
     */
    public function __construct()
    {
        if (!apcu_enabled() || (!extension_loaded('apc') && !extension_loaded('apcu'))) {
            throw new RuntimeException('APCu cache is not usable in this environment.');
        }
    }

    /**
     * Deletes all items in the pool.
     *
     * @return bool Returns true if the pool was successfully cleared and false if not.
     */
    public function clear(): bool
    {
        return apcu_clear_cache();
    }

    /**
     * Decrease a stored number.
     *
     * @param string|int|array|Traversable $key    The key to decrease.
     * @param int                          $amount The amount to decrease by.
     *
     * @return bool Returns the new decreased value or false on failure.
     */
    public function decrease(string|int|array|Traversable $key, int $amount = 1): int|false
    {
        return apcu_dec($key, $amount);
    }

    /**
     * Removes the item from the pool.
     *
     * @param string|int|array|Traversable $key The key to delete.
     *
     * @return bool Returns true if the key has been deleted and false if not.
     */
    public function delete(string|int|array|Traversable $key): bool
    {
        return apcu_delete($key);
    }

    /**
     * Confirms if the cache contains specified cache item.
     *
     * @param string|int|array|Traversable $key The key for which to check existence.
     *
     * @return bool Returns true if the key exists and false if not.
     */
    public function exists(string|int|array|Traversable $key): bool
    {
        return apcu_exists($key);
    }

    /**
     * Fetch an item from the pool.
     *
     * @param string|int|array|Traversable $key The key to fetch.
     *
     * @return bool Returns the stored variable or array of variables on success and false otherwise.
     */
    public function fetch(string|int|array|Traversable $key): mixed
    {
        return apcu_fetch($key);
    }

    /**
     * Increase a stored number.
     *
     * @param string|int|array|Traversable $key    The key to increment.
     * @param int                          $amount The amount to increment by.
     *
     * @return bool Returns the new incremented value or false on failure.
     */
    public function increment(string|int|array|Traversable $key, int $amount = 1): int|false
    {
        return apcu_inc($key, $amount);
    }

    /**
     * Store a cache value.
     *
     * @param string|int $key     The key to bind to the value.
     * @param mixed      $value   The value to store.
     * @param int        $expires When should this value expire.
     *
     * @return bool Returns true on success or false on failure. 
     */
    public function store(string|int $key, mixed $value, int $expires = 0): bool
    {
        return apcu_store($key, $value, $expires);
    }
}
