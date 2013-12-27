<?php 
namespace Nijibelle\Shares\Facades;

use Illuminate\Support\Facades\Facade;

class Shares extends Facade {

    /**
     * Get the registered name of the component.
     *
     * @return string
     */
    protected static function getFacadeAccessor() { return 'shares'; }

}
