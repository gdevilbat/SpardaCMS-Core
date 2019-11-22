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
     * Get ACL rules list for user
     *
     * @return array
     */
    public function getRules(): array
    {
        if (\Auth::id() === 1) {
            return $this->getDiskSuperAdminAccess();
        }
        
        return [
            ['disk' => config('filesystems.default'), 'path' => '/', 'access' => 1],                                  // main folder - read
            ['disk' => config('filesystems.default'), 'path' => 'users', 'access' => 1],                              // only read
            ['disk' => config('filesystems.default'), 'path' => 'users/'. \Auth::id(), 'access' => 1],        // only read
            ['disk' => config('filesystems.default'), 'path' => 'users/'. \Auth::id() .'/*', 'access' => 2],  // read and write
            ['disk' => config('filesystems.default'), 'path' => 'shares', 'access' => 1],                              // only read
            ['disk' => config('filesystems.default'), 'path' => 'shares/*', 'access' => 2],
        ];
    }

    public function getDiskSuperAdminAccess()
    {
    	$disk = array();

    	foreach (array_keys(config('filesystems.disks')) as $key => $value) 
    	{
    		array_push($disk, ['disk' => $value, 'path' => '*', 'access' => 2]);
    	}

    	return $disk;
    }
}