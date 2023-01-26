<?php
// This file is part of Moodle - https://moodle.org/
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
// along with Moodle.  If not, see <https://www.gnu.org/licenses/>.

/**
 * Block edit form class for the block_pluginname plugin.
 *
 * @package     block_weather
 * @copyright   2023 Edutech
 * @license     https://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */
class block_weather_edit_form extends block_edit_form {
        
    protected function specific_definition($mform) { //Moodle mform doc at https://docs.moodle.org/dev/Form_API
        
        // Add a header for the configuration setting.
        $mform->addElement('header', 'config_header', get_string('blocksettings', 'block'));

        // Title string variable with a default value.
        $mform->addElement('text', 'config_title', get_string('blocktitle', 'block_weather'));
        $mform->setDefault('config_title', get_string('pluginname', 'block_weather'));
        $mform->setType('config_title', PARAM_TEXT);

        // Location string variable with a default value.
        // When defining elements always start with 'config_' 
        // so they are saved within the block in within the block via $this->config.
        $mform->addElement('text', 'config_location', get_string('location', 'block_weather')); // addElement params include button, text, header, html, hidden, password, etc.
        $mform->setDefault('config_location', get_string('locationname', 'block_weather')); // Default location is Cuenca, Ecuador
        $mform->setType('config_location', PARAM_TEXT); 
    }
}