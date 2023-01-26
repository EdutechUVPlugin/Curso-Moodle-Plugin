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
//require_once($CFG->dirroot . '/blocks/block_weather.php');
/**
 * Block plugin for the weather.
 *
 * @package     block_weather
 * @copyright   2023 Edutech
 * @license     https://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */
//Documentation for block plugin development at https://moodledev.io/docs/apis/plugintypes/blocks
class block_weather extends block_base { // Additional block_base documentation at https://docs.moodle.org/dev/Blocks/Appendix_A#Appendix_A:_block_base_Reference
    /**
     * Initializes class member variables. Serves as the constructor for the block
     */
    public function init() {
        // Needed by Moodle to differentiate between blocks. Adds the name of the plugin as a title for the block
        $this->title = get_string('pluginname', 'block_weather'); 
        // get_string returns language strings for i18n
    }

    /**
     * Returns the block contents.
     *
     * @return stdClass The block contents.
     */
    public function get_content() {
        if ($this->content !== null) {
          return $this->content; // Further class variable documentation at https://docs.moodle.org/dev/Blocks/Appendix_A#.24this-.3Econtent_type
        }
    
        $this->content =  new stdClass;
        
        if (! empty($this->config->location)) {
            $this->content->text = self::get_temperature();
        } else {
            $this->content->text = get_string('welcomemessage', 'block_weather');
        }

        $this->content->footer = get_string('footer', 'block_weather');
     
        return $this->content;
    }

    /**
     * Defines configuration data.
     *
     * The function is called immediately after init().
     */
    public function specialization() {
        // Load user defined title
        if (isset($this->config->title)) {
            $this->title = format_string($this->config->title, true, ['context' => $this->context]);
        } else {
            $this->title = get_string('pluginname', 'block_weather'); // Ensure the title is never empty
        }

        // Load user defined location
        if (isset($this->config->location)) {
            $this->location = format_string($this->config->location, true, ['context' => $this->context]);
        } else {
            $this->location = get_string('locationname', 'block_weather'); // Ensure the title is never empty
        }
    }

    /**
     * Queries the temperature for a location.
     *
     * @return string Teperature message.
     */
    public function get_temperature(){
        $response = block_weather\weather::get_weather($this->location);
        if(isset($response->failed)){
            $message = get_string('locationerror', 'block_weather');
        } else{
            $location = $response['location']['name'];
            //$current = $response['current'];
            $temperature = $response['current']['temp_c'];
            $weather = $response['current']['condition']['text'];

            if($location != "" && $temperature != "" && $weather != ""){
                $this->config->location = $location;
                $message = get_string('locationintro', 'block_weather').
                        $location.get_string('weatherintro', 'block_weather').
                        $temperature.get_string('weatheroutro', 'block_weather').
                        $weather;
    
            }else {
                $message = get_string('locationerror', 'block_weather');
            }

        }
        
        return $message;
    }
    /**
     * Sets the applicable formats for the block.
     *
     * @return string[] Array of pages and permissions.
     */
    public function applicable_formats() {
        return [
            'admin' => true,
            'site-index' => true,
            'course-view' => true,
            'mod' => true,
            'my' => true,
        ];
    }

    /**
     * Sets the option to allow multiple instances of the same block in the same page.
     *
     * @return true permission to allow multiple instances.
     */
    public function instance_allow_multiple() {
        return true;
    }
}