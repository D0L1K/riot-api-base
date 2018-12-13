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

declare(strict_types=1);

use RiotAPI\Definitions\Region;
use RiotAPI\Objects\ApiObjectLinkable;
use RiotAPI\Objects\ChampionMasteryDto;
use RiotAPI\RiotAPI;


class ApiObjectLinkableTest extends RiotAPITestCase
{
	public function testInit()
	{
		$api = new RiotAPI([
			RiotAPI::SET_KEY                => getenv('API_KEY'),
			RiotAPI::SET_REGION             => Region::EUROPE_EAST,
			RiotAPI::SET_USE_DUMMY_DATA     => true,
			RiotAPI::SET_DATADRAGON_INIT    => true,
			RiotAPI::SET_STATICDATA_LINKING => true,
			RiotAPI::SET_CACHE_CALLS        => true,
		]);

		$this->assertInstanceOf(RiotAPI::class, $api);

		return $api;
	}

	/**
	 * @depends testInit
	 *
	 * @param RiotAPI $api
	 */
	public function testStaticDataLinking_ChampionMastery( RiotAPI $api )
	{
		/** @var ChampionMasteryDto $data */
		$data = $api->getChampionMastery("KnNZNuEVZ5rZry3IyWwYSVuikRe0y3qTWSkr1wxcmV5CLJ8", 61);

		$this->assertSame(61, $data->championId);
		$this->assertSame("61", $data->key);
		$this->assertSame($data->key, $data->staticData->key);
		$this->assertSame("Orianna", $data->name);
		$this->assertSame($data->name, $data->staticData->name);
	}

	public function testInvalidLinkableProperty()
	{
		$this->assertFalse(ApiObjectLinkable::getLinkablePropertyData("INVALID_PROPERTY"));
	}
}
