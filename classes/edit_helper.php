<?php
// This file is part of Moodle - http://moodle.org/
//
// Moodle is free software: you can redistribute it and/or modify
// it under the terms of the GNU General Public License as published by
// the Free Software Foundation, either version 3 of the License, or
// (at your option) any later version.
//
// Moodle is distributed in the hope that it will be useful,
// but WITHOUT ANY WARRANTY; without even the implied warranty of
// MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
// GNU General Public License for more details.
//
// You should have received a copy of the GNU General Public License
// along with Moodle.  If not, see <http://www.gnu.org/licenses/>.

/**
 * Configuration edit form helper.
 *
 * @package    block_horario
 * @copyright  2016 José Puente
 * @license    http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */

namespace block_horario;

defined('MOODLE_INTERNAL') || die();

/**
 * Configuration edit form helper.
 * Get form options.
 *
 * @package    block_horario
 * @copyright  2016 José Puente
 * @license    http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */
class edit_helper {

    const MAX_HOUR = 24;
    const MAX_MINUTE = 59;
    const STEP = 1;

    /**
     * Returns all cohorts.
     *
     * @global stdClass $CFG
     * @return array $cohortsoptions
     */
    public static function get_cohorts_options() {
        global $CFG;
        require_once("$CFG->dirroot/cohort/lib.php");

        $cohorts = \cohort_get_all_cohorts();

        $cohortsoptions = array();
        foreach ($cohorts['cohorts'] as $cohort) {
            $cohortsoptions[$cohort->id] = strip_tags($cohort->description);
        }

        return $cohortsoptions;
    }

    /**
     * Returns week days.
     *
     * @return array $daysoptions
     */
    public static function get_days_options() {
        $daysoptions = [
            get_string('sunday', 'block_horario'),
            get_string('monday', 'block_horario'),
            get_string('tuesday', 'block_horario'),
            get_string('wednesday', 'block_horario'),
            get_string('thursday', 'block_horario'),
            get_string('friday', 'block_horario'),
            get_string('saturday', 'block_horario'),
        ];

        return $daysoptions;
    }

    /**
     * Returns array hour for select element.
     *
     * @return array $hours
     */
    public static function get_hour_options() {
        $hours = array();
        for ($index = 0; $index < self::MAX_HOUR; $index += self::STEP) {
            $hours[$index] = $index;
        }
        return $hours;
    }

    /**
     * Returns array minutes for select element.
     *
     * @return array $minutes
     */
    public static function get_minute_options() {
        $minutes = array();
        for ($index = 0; $index <= self::MAX_MINUTE; $index += self::STEP) {
            $minutes[$index] = $index;
        }
        return $minutes;
    }
}