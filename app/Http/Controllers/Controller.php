<?php

namespace App\Http\Controllers;




use Laramin\Utility\Onumoti;

abstract class Controller
{
    public function __construct()
    {
        $className = get_called_class();
        Onumoti::mySite($this,$className);
    }

    public static function middleware()
    {
        return [];
    }
    
    

public function binaryMatchingCron()
{
    $service = new BinaryMatchingService();

    $users = DB::table('users')->get();

    foreach ($users as $user) {

        // Example values
        $pair = 2;
        $half = 100;

        $service->matchingBound(
            $user,
            $pair,
            $half,
            request()->get('dry_run') == 1 // dry run switch
        );
    }

    return 'Binary matching completed';
}


}
