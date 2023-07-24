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
 * Privacy Provider Test
 *
 * @package    lytix_config
 * @author     Günther Moser <moser@tugraz.at>
 * @copyright  2023 Educational Technologies, Graz, University of Technology
 * @license    http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */

namespace lytix_config;

use local_lytix\helper\plugin_check;

/**
 * Test local courselist privacy provider.
 *
 * @coversDefaultClass  \lytix_config\render_view
 */
class render_view_test extends \advanced_testcase {
    /**
     * Course variable.
     * @var \stdClass|null
     */
    private $course = null;

    /**
     * Course variable.
     * @var \stdClass|null
     */
    private $student = null;

    /**
     * Course variable.
     * @var \stdClass|null
     */
    private $teacher = null;

    /**
     * Course variable.
     * @var \stdClass|null
     */
    private $creator = null;

    /**
     * Lytix plugins variable.
     * @var string[]
     */
    private $pluginslearnerscorner = ['planner, grademonitor, activity, timeoverview, diary'];

    /**
     * Lytix plugins variable.
     * @var string[]
     */
    private $pluginscoursedashboard = ['planner, measure, activity, timeoverview, diary, completions'];

    /**
     * Lytix plugins variable.
     * @var string[]
     */
    private $pluginscreatorsdashboard = ['actions, completions, coursecompl, participations, timeoverview'];


    /**
     * Helper function to skip tests if plugins are not installed.
     * @param array $plugins
     * @return void
     * @throws \coding_exception
     */
    public function check_installed_plugins(array $plugins): void {
        foreach ($plugins as $plugin) {
            if (!plugin_check::is_installed($plugin)) {
                $this->markTestSkipped('Some required Lytix-plugins are not installed!');
            }
        }
    }

    /**
     * Sets up course for tests.
     */
    public function setUp(): void {
        global $DB;
        $this->resetAfterTest(true);
        $this->setAdminUser();
        $now = new \DateTime('now');
        set_config('semester_start', $now->format('Y-m-d'), 'local_lytix');
        // Create course.
        $this->course = $this->getDataGenerator()->create_course(['enablecompletion' => 1]);
        // Create Student and enrol to course.
        $studentrole = $DB->get_record('role', array('shortname' => 'student'));
        $this->student = $this->getDataGenerator()->create_user();
        $this->getDataGenerator()->enrol_user($this->student->id, $this->course->id, $studentrole->id);
        // Create Teacher and enrol to course.
        $teacherrole = $DB->get_record('role', array('shortname' => 'editingteacher'));
        $this->teacher = $this->getDataGenerator()->create_user();
        $this->getDataGenerator()->enrol_user($this->teacher->id, $this->course->id, $teacherrole->id);
        // Create Creator and enrol to course.
        $this->creator = $this->getDataGenerator()->create_user();
        $creatorrole = $DB->get_record('role', array('shortname' => 'manager'));
        $this->getDataGenerator()->enrol_user($this->creator->id, $this->course->id, $creatorrole->id);
        $creatorrole = $DB->get_record('role', array('shortname' => 'coursecreator'));
        $this->getDataGenerator()->enrol_user($this->creator->id, $this->course->id, $creatorrole->id);

        // Add course to config list.
        set_config('course_list', $this->course->id, 'local_lytix');
        // Set platform.
        set_config('platform', 'course_dashboard', 'local_lytix');
    }

    /**
     * Test render for learners_corner.
     * @covers \lytix_config\render_learners_corner::get_parameter
     * @covers \lytix_config\render_learners_corner::render
     * @covers ::is_student
     * @covers ::render
     * @return void
     * @throws \dml_exception
     */
    public function test_render_learners_corner_student_view() {
        $this->resetAfterTest();
        $this->check_installed_plugins($this->pluginslearnerscorner);

        // Set platform.
        set_config('platform', 'learners_corner', 'local_lytix');

        $renderer = new render_learners_corner();
        $out = $renderer->render($this->course, $this->student);

        $render = new \lytix_config\render_view();
        $render->render($this->course, $this->student);
        $this->expectOutputString($out);
    }


    /**
     * Test render for learners_corner.
     * @covers \lytix_config\render_learners_corner::get_parameter
     * @covers \lytix_config\render_learners_corner::render
     * @covers ::is_teacher
     * @covers ::render
     * @return void
     * @throws \dml_exception
     */
    public function test_render_learners_corner_teacher_view() {
        $this->resetAfterTest();
        $this->check_installed_plugins($this->pluginslearnerscorner);

        // Set platform.
        set_config('platform', 'learners_corner', 'local_lytix');

        $renderer = new render_learners_corner();
        $out = $renderer->render($this->course, $this->teacher);

        $render = new \lytix_config\render_view();
        $render->render($this->course, $this->teacher);
        $this->expectOutputString($out);
    }

    /**
     * Test render for course_dashboard.
     * @covers \lytix_config\render_course_dashboard::get_parameter
     * @covers \lytix_config\render_course_dashboard::render
     * @covers ::is_student
     * @covers ::render
     * @return void
     * @throws \dml_exception
     */
    public function test_render_course_dashboard_student_view() {
        $this->resetAfterTest();
        $this->check_installed_plugins($this->pluginscoursedashboard);

        // Set platform.
        set_config('platform', 'course_dashboard', 'local_lytix');

        $renderer = new render_course_dashboard();
        $out = $renderer->render($this->course, $this->student);

        $render = new \lytix_config\render_view();
        $render->render($this->course, $this->student);
        $this->expectOutputString($out);
    }

    /**
     * Test render for course_dashboard.
     * @covers \lytix_config\render_course_dashboard::get_parameter
     * @covers \lytix_config\render_course_dashboard::render
     * @covers ::is_teacher
     * @covers ::render
     * @return void
     * @throws \dml_exception
     */
    public function test_render_course_dashboard_teacher_view() {
        $this->resetAfterTest();
        $this->check_installed_plugins($this->pluginscoursedashboard);

        // Set platform.
        set_config('platform', 'course_dashboard', 'local_lytix');

        $renderer = new render_course_dashboard();
        $out = $renderer->render($this->course, $this->teacher);

        $render = new \lytix_config\render_view();
        $render->render($this->course, $this->teacher);
        $this->expectOutputString($out);
    }


    /**
     * Test render for creators_dashboard.
     * @covers \lytix_config\render_creators_dashboard::get_parameter
     * @covers \lytix_config\render_creators_dashboard::render
     * @covers ::is_creator
     * @covers ::render
     * @return void
     * @throws \dml_exception
     */
    public function test_render_creators_dashboard_view() {
        $this->resetAfterTest();
        $this->check_installed_plugins($this->pluginscreatorsdashboard);
        // Set platform.
        set_config('platform', 'creators_dashboard', 'local_lytix');

        $renderer = new render_creators_dashboard();
        $out = $renderer->render($this->course, $this->creator);

        $render = new \lytix_config\render_view();
        $render->render($this->course, $this->creator);
        $this->expectOutputString($out);
    }

    /**
     * Test render for error.
     * @covers ::render
     * @return void
     * @throws \dml_exception
     */
    public function test_render_error_view() {
        global $OUTPUT;
        $this->resetAfterTest();

        // Set platform.
        set_config('platform', 'some_platform', 'local_lytix');

        $out = $OUTPUT->render_from_template('lytix_config/error', null);

        $render = new \lytix_config\render_view();
        $render->render($this->course, $this->creator);
        $this->expectOutputString($out);
    }
}
