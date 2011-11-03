
<?php
    $hidden = array('id' => '12345');
    $action = isset(${classnameViewModel})? 'update': 'insert';
    echo form_open("{classnameController}/$action", '', $hidden);
?>

<table>      
    {views}
</table>

<?php echo form_submit('submit', 'Submit'); ?>
<?php echo form_close(); ?>

<?php echo validation_errors(); ?>
