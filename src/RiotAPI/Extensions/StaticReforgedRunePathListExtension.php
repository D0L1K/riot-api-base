<?php

/**
 * Copyright (C) 2016-2018  Daniel Dolejška
 *
 * This program is free software: you can redistribute it and/or modify
 * it under the terms of the GNU General Public License as published by
 * the Free Software Foundation, either version 3 of the License, or
 * (at your option) any later version.
 *
 * This program is distributed in the hope that it will be useful,
 * but WITHOUT ANY WARRANTY; without even the implied warranty of
 * MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
 * GNU General Public License for more details.
 *
 * You should have received a copy of the GNU General Public License
 * along with this program.  If not, see <http://www.gnu.org/licenses/>.
 */

namespace RiotAPI\Extensions;

use RiotAPI\Objects\IApiObject;
use RiotAPI\Objects\IApiObjectExtension;
use RiotAPI\Objects\StaticData\StaticReforgedRuneDto;
use RiotAPI\Objects\StaticData\StaticReforgedRunePathDto;
use RiotAPI\Objects\StaticData\StaticReforgedRunePathList;
use RiotAPI\Objects\StaticData\StaticReforgedRuneSlotDto;
use RiotAPI\RiotAPI;


/**
 *   Class StaticReforgedRunePathListExtension
 *
 * @package RiotAPI\Extensions
 */
class StaticReforgedRunePathListExtension implements IApiObjectExtension
{
	/** @var StaticReforgedRunePathList $object */
	protected $object;

	/** @var array $rune_list */
	protected $rune_list = [];

	/**
	 *   StaticReforgedRunePathListExtension constructor.
	 *
	 * @param IApiObject|StaticReforgedRunePathList $apiObject
	 * @param RiotAPI                               $api
	 */
	public function __construct( IApiObject &$apiObject, RiotAPI &$api )
	{
		$this->object = $apiObject;

		/** @var StaticReforgedRunePathDto $path */
		foreach ($this->object as $path)
		{
			/** @var StaticReforgedRuneSlotDto $slot */
			foreach ($path as $slot)
			{
				/** @var StaticReforgedRuneDto $rune */
				foreach ($slot as $rune)
				{
					$this->rune_list[$rune->id] = $rune;
				}
			}
		}
	}

	public function getRuneById( int $rune_id )
	{
		return @$this->rune_list[$rune_id];
	}
}