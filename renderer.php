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
 * Renderer for block block_horario
 *
 * @package    block_horario
 * @copyright  2016 José Puente
 * @license    http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */

defined('MOODLE_INTERNAL') || die;

use block_horario\plugin_config;

/**
 * block_horario block renderer
 *
 * @package    block_horario
 * @copyright  2016 José Puente
 * @license    http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */
class block_horario_renderer extends plugin_renderer_base {

    /**
     * Returns HTML error access to course message.
     *
     * @global stdClass $SESSION
     * @return string $output
     */
    public function schedule_message() {
        global $SESSION;

        $output = html_writer::tag('div',
            $SESSION->block_horario_flash,
            array('class' => 'alert alert-error'));
        $output .= $this->continue_button('/');

        return $output;
    }

    /**
     * Returns HTML block text.
     *
     * @param plugin_config $pluginconfig
     * @return string $output
     */
    public function text(plugin_config $pluginconfig) {
        if ($pluginconfig->get_restrict_mode()) {
            $mode = get_string('restricted_access', 'block_horario');
        } else {
            $mode = get_string('granted_access', 'block_horario');
        }
        $output = html_writer::tag('p', $mode);
        $output .= html_writer::tag('p', $pluginconfig->get_week_days());
        $output .= html_writer::tag('p',
                '[ ' . $pluginconfig->get_time_from() .
                ' - ' . $pluginconfig->get_time_to() .
                ' ]'
                );

        return $output;
    }

    /**
     * Returns shedule course text that is shown
     * in schedule message.
     *
     * @param plugin_config $pluginconfig
     * @return string $output
     */
    public function flash_notification(plugin_config $pluginconfig) {
        $output = $pluginconfig->get_week_days() . ' [ ';
        $output .= $pluginconfig->get_time_from() . ' - ' .
                    $pluginconfig->get_time_to() . ' ] ';

        return $output;
    }
}