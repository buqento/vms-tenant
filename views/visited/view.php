<?php
use yii\widgets\DetailView;
?>

<?= DetailView::widget([
    'model' => $rows[0],
    'attributes' => [
        'name',
        'vms_type_id',
        'id_number',
        'gender',
        'phone',
        'email',
        // 'photo',
        'address',
        'visit_code',
        'vms_tenant_id',
        'visit_date:datetime',
        // 'visit_time',
        'visit_long',
        'employe_id',
        'additional_info',
        'status',
        // 'created'
    ],
])
?>