<?php

class onRssCtypeBasicForm extends cmsAction {

    public function run($form) {

        $fieldset = $form->addFieldsetAfter('folders', LANG_RSS_CONTROLLER, 'rss', ['is_collapsed' => true]);

        $form->addField($fieldset, new fieldCheckbox('options:is_rss', [
            'title' => LANG_RSS_CTYPE_ENABLE_FEED
        ]));

        return $form;
    }

}
