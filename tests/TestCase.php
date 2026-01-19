<?php

declare(strict_types=1);

namespace Accelade\Tables\Tests;

use Accelade\AcceladeServiceProvider;
use Accelade\Actions\ActionsServiceProvider;
use Accelade\Filters\FiltersServiceProvider;
use Accelade\QueryBuilder\QueryBuilderServiceProvider;
use Accelade\Tables\TablesServiceProvider;
use Orchestra\Testbench\TestCase as BaseTestCase;

abstract class TestCase extends BaseTestCase
{
    protected function getPackageProviders($app): array
    {
        return [
            AcceladeServiceProvider::class,
            QueryBuilderServiceProvider::class,
            FiltersServiceProvider::class,
            ActionsServiceProvider::class,
            TablesServiceProvider::class,
        ];
    }

    protected function getEnvironmentSetUp($app): void
    {
        $app['config']->set('tables.enabled', true);
        $app['config']->set('tables.demo.enabled', true);
        $app['config']->set('database.default', 'testing');
        $app['config']->set('database.connections.testing', [
            'driver' => 'sqlite',
            'database' => ':memory:',
            'prefix' => '',
        ]);
    }
}
