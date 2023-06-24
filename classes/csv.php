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
 * Library of interface functions and constants.
 *
 * @package     mod_srg
 * @copyright  2022 Universtity of Stuttgart <kasra.habib@iste.uni-stuttgart.de>
 * @license     https://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */

defined('MOODLE_INTERNAL') || die();

/**
 * Class holding helper methods corresponding to .csv
 */
class srg_CSV
{
    // Transforms simple table (from db_conn) into .csv
    public static function simple_table_to_CSV($table)
    {
        $csv = '';

        if (!$table) return $csv;
        $first_row = array_shift($table);
        if (!$first_row) return $csv;
        $first_cell = array_shift($first_row);

        $csv .= '"' . preg_replace(array('/\n/', '/"/'), array('', '""'), $first_cell) . '"';

        foreach ($first_row as $cell) {
            $csv .= ",";
            $csv .= '"' . preg_replace(array('/\n/', '/"/'), array('', '""'), $cell) . '"';
        }

        foreach ($table as $row) {
            $csv .= "\n";

            if (!$row) return $csv;
            $first_cell = array_shift($row);

            $csv .= '"' . preg_replace(array('/\n/', '/"/'), array('', '""'), $first_cell) . '"';

            foreach ($row as $cell) {
                $csv .= ",";
                $csv .= '"' . preg_replace(array('/\n/', '/"/'), array('', '""'), $cell) . '"';
            }
        }

        return $csv;
    }
}
