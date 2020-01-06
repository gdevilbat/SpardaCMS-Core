<?php

namespace Gdevilbat\SpardaCMS\Modules\Core\Services\Contract;

/**
 * Interface CoreRepository
 * @package Modules\Core\Repositories
 */
interface BaseStorageService
{
	public function putImageAs(string $path, $file, $filename, bool $thumbnail = false, string $thumb_path = null): object;
	public function getOriginalImage(string $path, $file, $filename): string;
	public function getSmallImage(string $thumb_path, $file, $filename, string $path): string;
	public function getThumbImage(string $thumb_path, $file, $filename, string $path): string;
	public function getMediumImage(string $thumb_path, $file, $filename, string $path): string;
	public function isOriginalImageCompress(): bool;
}
