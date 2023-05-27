<?php

namespace Bisix21\src\UrlShort\ORM\Models;

use Illuminate\Database\Eloquent\Model;

class UrlShort extends Model
{
	protected $table = "urls_shorts";

	public function getUrlByCode($code)
	{
		$res = UrlShort::query()->where("code", '=', $code)->first();
		if ($res !== null) {
			$res = json_decode($res);
		}
		return $res;
	}

	public function issetCode(string $code): bool
	{
		$res = true;
		$codeInDB = $this->getUrlByCode($code);
		if (isset($codeInDB->code) && $code == $codeInDB->code) {
			$res = false;
		};
		return $res;
	}
}