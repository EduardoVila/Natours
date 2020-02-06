<?php

defined('MOODLE_INTERNAL') || die();

class block_section extends block_list {
  public function init() {
    $this->title = get_string('pluginname', 'block_section');
  }

  public function specialization() {
    if (!empty($this->config->title)) {
      $this->title = $this->config->title;
    } else {
      $this->title = get_string('blocktitle', 'block_section');
    }
    if (empty($this->config->section)) {
      $this->section = 0;
    } else {
      $this->section = $this->config->section;
    }
  }

  public function applicable_formats() {
    return [
      'course-view' => true,
      'site-index' => true,
      'my' => true
    ];
  }

  public function instance_allow_multiple() {
    return true;
  }

  public function get_content() {
    global $CFG, $DB, $USER, $PAGE, $OUTPUT;

    if ($this->content !== null) {
      return $this->content;
    }

    $this->content = new stdClass();
    $this->content->items = [];
    $this->content->icons = [];
    $this->content->footer = '';

    $PAGE->set_context(context_system::instance());
    $PAGE->set_url(new moodle_url('/admin/tool/block_section'));
    $PAGE->requires->js_call_amd('block_section/demo', 'init');

    $this->content->items[] = $OUTPUT->render_from_template('block_section/app', []);

    if (empty($this->instance)) {
      return $this->content;
    }

    require_once($CFG->dirroot.'/course/lib.php');
  
    return $this->content;
  }
}

  // if (!empty($this->config->course) && ($DB->get_record('course', ['id' => $this->config->course]) != null)) {
  //   $course = $DB->get_record('course', ['id' => $this->config->course]);
  // } else {
  //   $course = $this->page->course;
  // }

  // $modinfo = get_fast_modinfo($course);