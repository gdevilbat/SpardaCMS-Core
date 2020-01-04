<?php

return [
    'storage' => [
    	'repository' => \Gdevilbat\SpardaCMS\Modules\Core\Services\Repository\StorageService::class,
    	'thumbnail' => [
    		'folder' => 'thumbnail',
    		'resolution' => [
    			'small' => [
    				'size' => [
    					'width' => 400,
    					'height' => 'auto',
    				],
                    'compress' => true, 
    			],
    			'thumb' => [
    				'size' => [
    					'width' => 640,
    					'height' => 'auto',
    				],
                    'compress' => true,
    			],
    			'medium' => [
    				'size' => [
    					'width' => 800,
    					'height' => 'auto',
    				],
                    'compress' => true,
    			]
    		]
    	]
    ]
];