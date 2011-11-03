<?php if(! empty(${classnameViewModel})): ?>
<table>
    <?php foreach(${classnameViewModel} as $row): ?>
    <tr>       
        {views}
    </tr>
    <?php endforeach; ?>
</table>
<?php endif; ?>
