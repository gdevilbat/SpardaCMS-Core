<?php

namespace Gdevilbat\SpardaCMS\Modules\Core\Services\Repository;

use Storage;
use Image;
use Arr;

/**
 * Interface CoreRepository
 * @package Modules\Core\Repositories
 */
class StorageService implements \Gdevilbat\SpardaCMS\Modules\Core\Services\Contract\BaseStorageService
{
	public function putImageAs(string $path, $file, $filename, bool $thumbnail = false, string $thumb_path = null): object
	{
		$original = Storage::putFileAs($path, $file, $filename);

		if($thumb_path == null)
		{
			$thumb_path = config('core.storage.thumbnail.folder');
		}

		$response = ['file' => $original];

		if($thumbnail)
		{
			$small = $this->getSmallImage($thumb_path, $file, $filename, $path);
			$response = Arr::add($response, 'small', $small);

			$thumb = $this->getThumbImage($thumb_path, $file, $filename, $path);
			$response = Arr::add($response, 'thumb', $thumb);

			$medium = $this->getMediumImage($thumb_path, $file, $filename, $path);
			$response = Arr::add($response, 'medium', $medium);
		}

		return json_decode(json_encode($response));
	}

	public function getSmallImage(string $thumb_path, $file, string $filename, string $path): string
	{
		if(config('core.storage.thumbnail.resolution.small.compress'))
		{
			$img = Image::make($file);

			if(config('core.storage.thumbnail.resolution.small.size.width') == 'auto')
			{
				// resize the image to a height of 200 and constrain aspect ratio (auto width)
				$img->resize(null, config('core.storage.thumbnail.resolution.small.size.height'), function ($constraint) {
				    $constraint->aspectRatio();
				});
			}
			elseif(config('core.storage.thumbnail.resolution.small.size.height') == 'auto') 
			{
				// resize the image to a height of 200 and constrain aspect ratio (auto width)
				$img->resize(config('core.storage.thumbnail.resolution.small.size.width'), null, function ($constraint) {
				    $constraint->aspectRatio();
				});
			}
			else
			{
				// resize the image to a height of 200 and constrain aspect ratio (auto width)
				$img->resize(config('core.storage.thumbnail.resolution.small.size.width'), config('core.storage.thumbnail.resolution.small.size.height'), function ($constraint) {
				    $constraint->aspectRatio();
				});
			}

			$location = $thumb_path.'/small/'.$path.'/'.$filename;

			$status = Storage::put($location, (string) $img->encode());

			if($status)
				return $location;
		}

		return '';
	}

	public function getThumbImage(string $thumb_path, $file, string $filename, string $path): string
	{
		$img = Image::make($file);

		if(config('core.storage.thumbnail.resolution.thumb.compress'))
		{
			if(config('core.storage.thumbnail.resolution.thumb.size.width') == 'auto')
			{
				// resize the image to a height of 200 and constrain aspect ratio (auto width)
				$img->resize(null, config('core.storage.thumbnail.resolution.thumb.size.height'), function ($constraint) {
				    $constraint->aspectRatio();
				});
			}
			elseif(config('core.storage.thumbnail.resolution.thumb.size.height') == 'auto') 
			{
				// resize the image to a height of 200 and constrain aspect ratio (auto width)
				$img->resize(config('core.storage.thumbnail.resolution.thumb.size.width'), null, function ($constraint) {
				    $constraint->aspectRatio();
				});
			}
			else
			{
				// resize the image to a height of 200 and constrain aspect ratio (auto width)
				$img->resize(config('core.storage.thumbnail.resolution.thumb.size.width'), config('core.storage.thumbnail.resolution.thumb.size.height'), function ($constraint) {
				    $constraint->aspectRatio();
				});
			}

			$location = $thumb_path.'/thumb/'.$path.'/'.$filename;

			$status = Storage::put($location, (string) $img->encode());

			if($status)
				return $location;
		}

		return '';
	}

	public function getMediumImage(string $thumb_path, $file, string $filename, string $path): string
	{
		if(config('core.storage.thumbnail.resolution.medium.compress'))
		{
			$img = Image::make($file);

			if(config('core.storage.thumbnail.resolution.medium.size.width') == 'auto')
			{
				// resize the image to a height of 200 and constrain aspect ratio (auto width)
				$img->resize(null, config('core.storage.thumbnail.resolution.medium.size.height'), function ($constraint) {
				    $constraint->aspectRatio();
				});
			}
			elseif(config('core.storage.thumbnail.resolution.medium.size.height') == 'auto') 
			{
				// resize the image to a height of 200 and constrain aspect ratio (auto width)
				$img->resize(config('core.storage.thumbnail.resolution.medium.size.width'), null, function ($constraint) {
				    $constraint->aspectRatio();
				});
			}
			else
			{
				// resize the image to a height of 200 and constrain aspect ratio (auto width)
				$img->resize(config('core.storage.thumbnail.resolution.medium.size.width'), config('core.storage.thumbnail.resolution.medium.size.height'), function ($constraint) {
				    $constraint->aspectRatio();
				});
			}

			$location = $thumb_path.'/medium/'.$path.'/'.$filename;

			$status = Storage::put($location, (string) $img->encode());

			if($status)
				return $location;
		}

		return '';
	}
}
