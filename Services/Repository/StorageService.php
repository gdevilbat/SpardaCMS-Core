<?php

namespace Gdevilbat\SpardaCMS\Modules\Core\Services\Repository;

use Storage;
use Image;
use Arr;
use Str;

use Illuminate\Http\UploadedFile;

/**
 * Interface CoreRepository
 * @package Modules\Core\Repositories
 */
class StorageService implements \Gdevilbat\SpardaCMS\Modules\Core\Services\Contract\BaseStorageService
{
	public function putImageAs(string $path, $file, $filename, bool $thumbnail = false, string $thumb_path = null): object
	{
		$original = $this->getOriginalImage($path, $file, $filename);

		if($thumb_path == null)
		{
			$thumb_path = config('storage-service.thumbnail.folder');
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

	public function putImageUrl(string $path, $url, bool $thumbnail = false, string $thumb_path = null): object
	{
		$info = pathinfo($url);
		$contents = file_get_contents($url);
		$file = '/tmp/' . $info['basename'];
		file_put_contents($file, $contents);
		$uploaded_file = new UploadedFile($file, $info['basename']);

		$filename = pathinfo($uploaded_file, PATHINFO_FILENAME);
        $extension = pathinfo($uploaded_file, PATHINFO_EXTENSION);

		return $this->putImageAs($path, $uploaded_file, Str::slug(md5(microtime()).'-'.$filename, '-').'.'.$extension, $thumbnail, $thumb_path);
	}

	public function getOriginalImage(string $path, $file, $filename): string
	{
		if($this->isOriginalImageCompress())
		{
			$img = Image::make($file);

			$dimension = getimagesize($file);

			if(config('storage-service.thumbnail.resolution.original.size.width') == 'auto')
			{
				if($dimension[1] > config('storage-service.thumbnail.resolution.original.size.height'))
				{
					// resize the image to a height of 200 and constrain aspect ratio (auto width)
					$img->resize(null, config('storage-service.thumbnail.resolution.original.size.height'), function ($constraint) {
					    $constraint->aspectRatio();
					});
				}
			}
			elseif(config('storage-service.thumbnail.resolution.original.size.height') == 'auto') 
			{
				if($dimension[0] > config('storage-service.thumbnail.resolution.original.size.width'))
				{
					// resize the image to a height of 200 and constrain aspect ratio (auto width)
					$img->resize(config('storage-service.thumbnail.resolution.original.size.width'), null, function ($constraint) {
					    $constraint->aspectRatio();
					});
				}
			}
			else
			{
				// resize the image to a height of 200 and constrain aspect ratio (auto width)
				$img->resize(config('storage-service.thumbnail.resolution.original.size.width'), config('storage-service.thumbnail.resolution.original.size.height'), function ($constraint) {
				    $constraint->aspectRatio();
				});
			}

			$location = $path.'/'.$filename;

			$status = Storage::put($location, (string) $img->encode());

			if($status)
				return $location;

			return '';
		}
		{
			$location = Storage::putFileAs($path, $file, $filename);

			return $location;
		}
	}

	public function isOriginalImageCompress(): bool
	{
		if(config('storage-service.thumbnail.resolution.original.compress'))
			return true;

		return false;
	}

	public function getSmallImage(string $thumb_path, $file, $filename, string $path): string
	{
		if(config('storage-service.thumbnail.resolution.small.compress'))
		{
			$img = Image::make($file);

			if(config('storage-service.thumbnail.resolution.small.size.width') == 'auto')
			{
				// resize the image to a height of 200 and constrain aspect ratio (auto width)
				$img->resize(null, config('storage-service.thumbnail.resolution.small.size.height'), function ($constraint) {
				    $constraint->aspectRatio();
				});
			}
			elseif(config('storage-service.thumbnail.resolution.small.size.height') == 'auto') 
			{
				// resize the image to a height of 200 and constrain aspect ratio (auto width)
				$img->resize(config('storage-service.thumbnail.resolution.small.size.width'), null, function ($constraint) {
				    $constraint->aspectRatio();
				});
			}
			else
			{
				// resize the image to a height of 200 and constrain aspect ratio (auto width)
				$img->resize(config('storage-service.thumbnail.resolution.small.size.width'), config('storage-service.thumbnail.resolution.small.size.height'), function ($constraint) {
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

	public function getThumbImage(string $thumb_path, $file, $filename, string $path): string
	{
		$img = Image::make($file);

		if(config('storage-service.thumbnail.resolution.thumb.compress'))
		{
			if(config('storage-service.thumbnail.resolution.thumb.size.width') == 'auto')
			{
				// resize the image to a height of 200 and constrain aspect ratio (auto width)
				$img->resize(null, config('storage-service.thumbnail.resolution.thumb.size.height'), function ($constraint) {
				    $constraint->aspectRatio();
				});
			}
			elseif(config('storage-service.thumbnail.resolution.thumb.size.height') == 'auto') 
			{
				// resize the image to a height of 200 and constrain aspect ratio (auto width)
				$img->resize(config('storage-service.thumbnail.resolution.thumb.size.width'), null, function ($constraint) {
				    $constraint->aspectRatio();
				});
			}
			else
			{
				// resize the image to a height of 200 and constrain aspect ratio (auto width)
				$img->resize(config('storage-service.thumbnail.resolution.thumb.size.width'), config('storage-service.thumbnail.resolution.thumb.size.height'), function ($constraint) {
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

	public function getMediumImage(string $thumb_path, $file, $filename, string $path): string
	{
		if(config('storage-service.thumbnail.resolution.medium.compress'))
		{
			$img = Image::make($file);

			if(config('storage-service.thumbnail.resolution.medium.size.width') == 'auto')
			{
				// resize the image to a height of 200 and constrain aspect ratio (auto width)
				$img->resize(null, config('storage-service.thumbnail.resolution.medium.size.height'), function ($constraint) {
				    $constraint->aspectRatio();
				});
			}
			elseif(config('storage-service.thumbnail.resolution.medium.size.height') == 'auto') 
			{
				// resize the image to a height of 200 and constrain aspect ratio (auto width)
				$img->resize(config('storage-service.thumbnail.resolution.medium.size.width'), null, function ($constraint) {
				    $constraint->aspectRatio();
				});
			}
			else
			{
				// resize the image to a height of 200 and constrain aspect ratio (auto width)
				$img->resize(config('storage-service.thumbnail.resolution.medium.size.width'), config('storage-service.thumbnail.resolution.medium.size.height'), function ($constraint) {
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
