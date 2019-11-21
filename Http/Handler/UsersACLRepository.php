<?php

namespace Gdevilbat\SpardaCMS\Modules\Core\Http\Handler;

use Alexusmai\LaravelFileManager\Services\ACLService\ACLRepository;

class UsersACLRepository implements ACLRepository
{
	/**
     * Get user ID
     *
     * @return mixed
     */
    public function getUserID()
    {
        return \Auth::id();
    }

    /**
     * Show the form for creating a new resource.
     * @return Response
     */
    public function getRules(): array
    {
        if (\Auth::id() == 1) {
            return [
                ['disk' => env('FILESYSTEM_DRIVER'), 'path' => '*', 'access' => 2],
            ];
        }
        
        return [
            ['disk' => env('FILESYSTEM_DRIVER'), 'path' => '/', 'access' => 1],                                  // main folder - read
            ['disk' => env('FILESYSTEM_DRIVER'), 'path' => 'users', 'access' => 1],                              // only read
            ['disk' => env('FILESYSTEM_DRIVER'), 'path' => 'users/'. \Auth::id(), 'access' => 1],        // only read
            ['disk' => env('FILESYSTEM_DRIVER'), 'path' => 'users/'. \Auth::id() .'/*', 'access' => 2],  // read and write
        ];
    }
}
