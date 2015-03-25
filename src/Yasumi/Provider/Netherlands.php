<?php
/*
 * This file is part of the Yasumi package.
 *
 * Copyright (c) 2015 AzuyaLabs
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */
namespace Yasumi\Provider;

use Carbon\Carbon;
use Yasumi\Holiday;

/**
 * Provider for all holidays in the Netherlands.
 */
class Netherlands extends AbstractProvider
{
    /**
     * Initialize holidays for the Netherlands.
     */
    public function initialize()
    {
        $this->timezone = 'Europe/Amsterdam';

        /*
         * New Year's Day
         */
        $this->addHoliday(new Holiday('newYearsDay', ['en-US' => 'New Year\'s Day', 'nl-NL' => 'Nieuwjaar'],
            Carbon::create($this->year, 1, 1, 0, 0, 0, $this->timezone), $this->locale));

        /*
         * Epiphany
         */
        $this->addHoliday(new Holiday('epiphany', ['en-US' => 'Epiphany', 'nl-NL' => 'Drie Koningen'],
            Carbon::create($this->year, 1, 6, 0, 0, 0, $this->timezone), $this->locale, Holiday::TYPE_OBSERVANCE));

        /*
         * Valentine's Day
         */
        $this->addHoliday(new Holiday('valentinesDay', ['en-US' => 'Valentine\'s Day', 'nl-NL' => 'Valentijnsdag'],
            Carbon::create($this->year, 2, 14, 0, 0, 0, $this->timezone), $this->locale, Holiday::TYPE_OBSERVANCE));

        /*
         * Labour Day
         */
        $this->addHoliday(new Holiday('labourDay', ['en-US' => 'Labour Day', 'nl-NL' => 'Dag van de Arbeid'],
            Carbon::create($this->year, 5, 1, 0, 0, 0, $this->timezone), $this->locale, Holiday::TYPE_OBSERVANCE));

        /*
         * Commemoration Day and Liberation Day. Instituted after WWII in 1947.
         */
        if ($this->year >= 1947) {
            $this->addHoliday(new Holiday('commemorationDay',
                ['en-US' => 'Commemoration Day', 'nl-NL' => 'Dodenherdenking'],
                Carbon::create($this->year, 5, 4, 0, 0, 0, $this->timezone), $this->locale, Holiday::TYPE_OBSERVANCE));
            $this->addHoliday(new Holiday('liberationDay', ['en-US' => 'Liberation Day', 'nl-NL' => 'Bevrijdingsdag'],
                Carbon::create($this->year, 5, 5, 0, 0, 0, $this->timezone), $this->locale, Holiday::TYPE_OBSERVANCE));
        }

        /*
         * World Animal Day
         */
        $this->addHoliday(new Holiday('worldAnimalDay', ['en-US' => 'World Animal Day', 'nl-NL' => 'Dierendag'],
            Carbon::create($this->year, 10, 4, 0, 0, 0, $this->timezone), $this->locale, Holiday::TYPE_OBSERVANCE));

        /*
         * Halloween
         */
        $this->addHoliday(new Holiday('halloween', ['en-US' => 'Halloween', 'nl-NL' => 'Halloween'],
            Carbon::create($this->year, 10, 31, 0, 0, 0, $this->timezone), $this->locale, Holiday::TYPE_OBSERVANCE));

        /**
         * St. Martins Day
         */
        $this->addHoliday(new Holiday('stMartinsDay', ['en-US' => 'St. Martin\'s Day', 'nl-NL' => 'Sint Maarten'],
            Carbon::create($this->year, 11, 11, 0, 0, 0, $this->timezone), $this->locale, Holiday::TYPE_OBSERVANCE));

        /**
         * St. Nicholas' Day
         */
        $this->addHoliday(new Holiday('stNicholasDay', ['en-US' => 'St. Nicholas\' Day', 'nl-NL' => 'Sinterklaas'],
            Carbon::create($this->year, 12, 5, 0, 0, 0, $this->timezone), $this->locale, Holiday::TYPE_OBSERVANCE));

        /**
         * Christmas day
         */
        $this->addHoliday(new Holiday('christmasDay', ['en-US' => 'Christmas', 'nl-NL' => 'Eerste Kerstdag'],
            Carbon::create($this->year, 12, 25, 0, 0, 0, $this->timezone), $this->locale));

        /**
         * Second Christmas Day / Boxing Day
         */
        $this->addHoliday(new Holiday('secondChristmasDay', ['en-US' => 'Boxing Day', 'nl-NL' => 'Tweede Kerstdag'],
            Carbon::create($this->year, 12, 26, 0, 0, 0, $this->timezone), $this->locale));

        /**
         * Kings Day.
         *
         * King's Day is celebrated from 2014 onwards on April 27th. If this happens to be on a Sunday, it will be
         * celebrated the day before instead.
         */
        if ($this->year >= 2014) {
            $date = Carbon::create($this->year, 4, 27, 0, 0, 0, $this->timezone);

            if ($date->dayOfWeek === 0) {
                $date = $date->subDay();
            }

            $this->addHoliday(new Holiday('kingsDay', ['en-US' => 'Kings Day', 'nl-NL' => 'Koningsdag'], $date,
                $this->locale));
        }

        /**
         * Queen's Day.
         *
         * Queen's Day was celebrated between 1891 and 1948 (inclusive) on August 31. Between 1949 and 2013 (inclusive) it
         * was celebrated April 30. If these dates are on a Sunday, Queen's Day was celebrated one day later until 1980
         * (on the following Monday), starting 1980 one day earlier (on the preceding Saturday).
         */
        if ($this->year >= 1891 && $this->year <= 2013) {
            $date = Carbon::create($this->year, 4, 30, 0, 0, 0, $this->timezone);
            if ($this->year <= 1948) {
                $date = Carbon::create($this->year, 8, 31, 0, 0, 0, $this->timezone);
            }

            // Determine substitution day
            if ($date->dayOfWeek === 0) {
                $date = ($this->year < 1980) ? $date->addDay() : $date->subDay();
            }

            $this->addHoliday(new Holiday('queensDay', ['en-US' => 'Queen\'s Day', 'nl-NL' => 'Koninginnedag'], $date,
                $this->locale));
        }

        /**
         * Summertime.
         *
         * Start of Summertime takes place on the last sunday of march. (Summertime is the common name for Daylight Saving
         * Time).
         */
        $this->addHoliday(new Holiday('summerTime', ['en-US' => 'Summertime', 'nl-NL' => 'Zomertijd'],
            new Carbon('last sunday of march ' . $this->year, $this->timezone), $this->locale, Holiday::TYPE_SEASON));

        /**
         * Wintertime.
         *
         * Start of Wintertime takes place on the last sunday of october. (Wintertime is actually the end of Summertime.
         * Summertime is the common name for Daylight Saving Time).
         */
        $this->addHoliday(new Holiday('winterTime', ['en-US' => 'Wintertime', 'nl-NL' => 'Wintertijd'],
            new Carbon('last sunday of october ' . $this->year, $this->timezone), $this->locale, Holiday::TYPE_SEASON));
    }
}
