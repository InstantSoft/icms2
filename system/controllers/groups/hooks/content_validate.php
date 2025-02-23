<?php
/**
 * @property \modelGroups $model
 */
class onGroupsContentValidate extends cmsAction {

    public function run($data) {

        list($item, $errors) = $data;

        $item['parent_type']      = null;
        $item['parent_title']     = null;
        $item['parent_url']       = null;
        $item['is_parent_hidden'] = null;

        if (!empty($item['parent_id'])) {

            $group = $this->model->localizedOff()->getGroup($item['parent_id']);

            if ($group) {

                $group['access'] = $this->getGroupAccess($group);

                $can_add = $this->isContentAddAllowed($item['ctype_name'], $group);

                if ($can_add) {

                    $item['parent_type']      = 'group';
                    $item['parent_title']     = $group['title'];
                    $item['parent_url']       = href_to_rel('groups', $group['slug'], ['content', $item['ctype_name']]);
                    $item['is_parent_hidden'] = $group['is_closed'] ? true : null;

                    $langs = cmsCore::getLanguages();

                    foreach ($langs as $lang) {
                        $item['parent_title_'.$lang] = $group['title_'.$lang] ?? null;
                    }

                } else {

                    $errors['parent_id'] = LANG_GROUPS_ERROR_PARENT_ID;
                }
            } else {

                $item['parent_id'] = null;
            }

        } else {
            $item['parent_id'] = null;
        }

        return [$item, $errors];
    }

}
