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
 * Plugin version and other meta-data are defined here. Version info can be seen at https://docs.moodle.org/dev/Releases
 *
 * @package     block_weather
 * @copyright   2023 Edutech 
 * @license     https://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */
defined('MOODLE_INTERNAL') || die();
$plugin->component = 'block_weather';  // Full plugin name in Frankenstyle used for installation, upgrade process and diagnostics
$plugin->version = 2022122800;  // Release date of the plugin in format YYYYMMDDHHXX (year, month, day, version counter -- version counter increases with each new release of the plugin)
$plugin->requires = 2010112400; // Minimum required version of Moodle in format YYYYMMDDHHXX (This is the release version for Moodle 2.0)