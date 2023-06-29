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
 * This is a one-line short description of the file.
 *
 * You can have a rather longer description of the file as well,
 * if you like, and it can span multiple lines.
 *
 * @package    lytix_config
 * @author     Guenther Moser
 * @copyright  2021 Educational Technologies, Graz, University of Technology
 * @license    http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */

namespace lytix_config;


/**
 * Renders the view for a platform
 */
class render_view {

    /**
     * Helper function to check the user's role.
     * @param \context|null $context
     * @param int $userid
     * @return bool
     */
    public static function is_student($context, $userid) {
        $isstudent = false;
        $roles     = get_user_roles($context, $userid);
        foreach ($roles as $role) {
            if ($role->shortname == 'student') {
                $isstudent = true;
                break;
            }
        }
        return $isstudent;
    }

    /**
     * Helper function to check the user's role.
     * @param \context|null $context
     * @param int $userid
     * @return bool
     */
    public static function is_teacher($context, $userid) {
        $isteacher = false;
        $roles     = get_user_roles($context, $userid);
        foreach ($roles as $role) {
            if ($role->shortname == 'teacher' || $role->shortname == 'editingteacher' ||
                $role->shortname == 'manager') {
                $isteacher = true;
                break;
            }
        }
        return ($isteacher|| is_siteadmin($userid));
    }

    /**
     * Helper function to check the user's role.
     * @param \context|null $context
     * @param int $userid
     * @return bool
     */
    public static function is_creator($context, $userid) {
        $iscreator = false;
        $roles     = get_user_roles($context, $userid);
        foreach ($roles as $role) {
            if ($role->shortname == 'creator' || $role->shortname == 'manager' || $role->shortname == 'coursecreator') {
                $iscreator = true;
                break;
            }
        }
        return ($iscreator || is_siteadmin($userid));
    }

    /**
     * Renders the view according to the platform setting.
     * @param \stdClass|null $course
     * @param \stdClass|null $user
     * @throws \dml_exception
     */
    public function render($course, $user) {
        $platform = get_config('local_lytix', 'platform');
        switch ($platform) {
            case 'learners_corner':
                $renderer = new render_learners_corner();
                echo $renderer->render($course, $user);
                break;
            case 'creators_dashboard':
                $renderer = new render_creators_dashboard();
                echo $renderer->render($course, $user);
                break;
            case 'course_dashboard';
                $renderer = new render_course_dashboard();
                echo $renderer->render($course, $user);
                break;
            default:
                global $OUTPUT;
                echo $OUTPUT->render_from_template('lytix_config/error', null);
                break;
        }
    }
}
