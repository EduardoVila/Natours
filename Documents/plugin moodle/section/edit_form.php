<?php

defined('MOODLE_INTERNAL') || die();

class block_section_edit_form extends block_edit_form {
    protected function specific_definition($mform) {
        $context = $this->page->context;

        // Section header title according to language file.
        $mform->addElement('header', 'configheader', get_string('blocksettings', 'block_section'));

        // // Give the block a title.
        // $mform->addElement('text', 'config_title', get_string('blocktitle', 'block_section'));
        // $mform->setDefault('config_title', get_string('blocktitle', 'block_section'));
        // $mform->setType('config_title', PARAM_MULTILANG);
        // $mform->addHelpButton('config_title', 'blocktitle', 'block_section');

        if (has_capability('block/section:addinstance', $context)) {
            $mform->addElement('text', 'config_course', get_string('blockcourse', 'block_section'));
            $mform->setDefault('config_course', $this->page->course->id);
            $mform->setType('config_course', PARAM_INTEGER);
            $mform->addHelpButton('config_course', 'blockcourse', 'block_section');

            // Select the section to display.
            $mform->addElement('text', 'config_section', get_string('blocksection', 'block_section'));
            $mform->setDefault('config_section', 0);
            $mform->setType('config_section', PARAM_INTEGER);
            $mform->addHelpButton('config_section', 'blocksection', 'block_section');
        }
    }
}
