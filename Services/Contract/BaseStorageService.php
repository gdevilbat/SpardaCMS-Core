<?php

namespace Gdevilbat\SpardaCMS\Modules\Core\Services\Contract;

/**
 * Interface CoreRepository
 * @package Modules\Core\Repositories
 */
interface BaseStorageService
{
	public function putImageAs(string $path, $file, string $filename, bool $thumbnail = false, string $thumb_path = null): object;
	public function getSmallImage(string $thumb_path, $file, string $filename, string $path): string;
	public function getThumbImage(string $thumb_path, $file, string $filename, string $path): string;
	public function getMediumImage(string $thumb_path, $file, string $filename, string $path): string;
}
