<?php

namespace Gdevilbat\SpardaCMS\Modules\Core\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Response;

use Gdevilbat\SpardaCMS\Modules\Core\Http\Controllers\CoreController;
use Storage;

use GuzzleHttp\Client;

class DashboardController extends CoreController
{
    /**
     * Show the form for creating a new resource.
     * @return Response
     */
    public function index()
    {
        return view('core::admin.'.$this->data['theme_cms']->value.'.content.dashboard', $this->data);
    }

    public function getStorageURL($path)
    {
    	$url = Storage::temporaryUrl(
		    $path, now()->addMinutes(5)
		);

		try {
	    	$client = new Client();
	    	$request = $client->get($url);
	    	$response = $request->getBody()->getContents();
		} catch (\GuzzleHttp\Exception\ClientException $e) {
			abort(404);
		}


    	header('Content-Type: '.$request->getHeaders()['Content-Type'][0]);
    	echo $response;
    }
}
