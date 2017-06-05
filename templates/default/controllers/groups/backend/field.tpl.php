<?php

    $this->addBreadcrumb(LANG_GROUPS_FIELDS, $this->href_to(''));

    if ($do=='add'){
        $this->addBreadcrumb(LANG_CP_FIELD_ADD);
    }

    if ($do=='edit'){
        $this->addBreadcrumb($field['title']);
    }

    $this->addToolButton(array(
        'class' => 'save',
        'title' => LANG_SAVE,
        'href'  => "javascript:icms.forms.submit()"
    ));
    $this->addToolButton(array(
        'class' => 'cancel',
        'title' => LANG_CANCEL,
        'href'  => $this->href_to('')
    ));

    $this->renderForm($form, $field, array(
        'action' => '',
        'method' => 'post'
    ), $errors);
?>

<script type="text/javascript">

    function loadFieldTypeOptions(field){

        $('#fset_type > div[id!=f_type]').remove();

        var field_type = $(field).val();

        if(field_type){
            $.post('<?php echo $this->href_to('fields_options'); ?>', {
                <?php if ($do=='edit') { ?>
                    field_id: '<?php echo $field['id']; ?>',
                <?php } ?>
                type: field_type
            }, function( html ){
                if (!html) { return; }
                $('#f_type').after( html );
                icms.events.run('loadgroupfieldtypeoptions', html);
            }, 'html');
        }

    }

    $(function(){
        var select_type = $('#type');
        if($(select_type).val() == 'caption'){
            $('#fset_type').hide();
        }
        $(select_type).on('change', function(){
            loadFieldTypeOptions(this);
        });
        if ($('#fset_type > div[id!=f_type]').length == 0){
            loadFieldTypeOptions(select_type);
        }
    });

</script>