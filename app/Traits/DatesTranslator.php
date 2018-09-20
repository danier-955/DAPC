<?php

namespace App\Traits;

use Jenssegers\Date\Date;

trait DatesTranslator
{
	/**
     * Traduce el campo fecha created_at al español.
     *
     * @var date
     * @return Date
     */
	public function getCreatedAtAttribute($date)
	{
		return Date::parse($date);
	}

	/**
     * Traduce el campo fecha updated_at al español.
     *
     * @var date
     * @return Date
     */
	public function getUpdatedAtAttribute($date)
	{
		return Date::parse($date);
	}

	/**
     * Traduce el campo fecha fech_ingr al español.
     *
     * @var date
     * @return Date
     */
	public function getFechIngrAttribute($date)
	{
		return Date::parse($date);
	}

	/**
     * Traduce el campo fecha fech_plan al español.
     *
     * @var date
     * @return Date
     */
	public function getFechPlanAttribute($date)
	{
		return Date::parse($date);
	}

	/**
     * Traduce el campo fecha inic_prac al español.
     *
     * @var date
     * @return Date
     */
	public function getInicPracAttribute($date)
	{
		return Date::parse($date);
	}

	/**
     * Traduce el campo fecha fina_prac al español.
     *
     * @var date
     * @return Date
     */
	public function getFinaPracAttribute($date)
	{
		return Date::parse($date);
	}

	/**
     * Traduce el campo fecha fech_segu al español.
     *
     * @var date
     * @return Date
     */
	public function getFechSeguAttribute($date)
	{
		return Date::parse($date);
	}

	/**
     * Traduce el campo fecha inic_even al español.
     *
     * @var date
     * @return Date
     */
	public function getInicEvenAttribute($date)
	{
		return Date::parse($date);
	}

	/**
     * Traduce el campo fecha fina_even al español.
     *
     * @var date
     * @return Date
     */
	public function getFinaEvenAttribute($date)
	{
		return Date::parse($date);
	}

}
