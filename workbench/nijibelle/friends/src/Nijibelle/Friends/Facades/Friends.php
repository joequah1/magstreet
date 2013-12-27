<?php 
namespace Nijibelle\Friends\Facades;

use Illuminate\Support\Facades\Facade;

class Friends extends Facade {

    /**
     * Get the registered name of the component.
     *
     * @return string
     */
    protected static function getFacadeAccessor() { return 'friends'; }

}
