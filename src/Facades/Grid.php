<?php

declare(strict_types=1);

namespace Accelade\Grids\Facades;

use Illuminate\Support\Facades\Facade;

/**
 * @method static \Accelade\Grids\Grid make(?string $name = null)
 *
 * @see \Accelade\Grids\Grid
 */
class Grid extends Facade
{
    protected static function getFacadeAccessor(): string
    {
        return 'accelade.grid';
    }
}
