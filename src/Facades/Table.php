<?php

declare(strict_types=1);

namespace Accelade\Tables\Facades;

use Illuminate\Support\Facades\Facade;

/**
 * @method static \Accelade\Tables\Table make(?string $name = null)
 *
 * @see \Accelade\Tables\Table
 */
class Table extends Facade
{
    protected static function getFacadeAccessor(): string
    {
        return 'accelade.table';
    }
}
