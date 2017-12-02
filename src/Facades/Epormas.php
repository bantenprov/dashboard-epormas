<?php namespace Bantenprov\DashboardEpormas\Facades;

use Illuminate\Support\Facades\Facade;

/**
 * The Epormas facade.
 *
 * @package Bantenprov\DashboardEpormas
 * @author  Esza Herdi <unme.loved@gmail.com>
 */
class Epormas extends Facade
{
    /**
     * Get the registered name of the component.
     *
     * @return string
     */
    protected static function getFacadeAccessor()
    {
        return 'epormas';
    }
}
