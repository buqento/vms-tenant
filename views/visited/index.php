<?php
use yii\helpers\Html;
use yii\grid\GridView;

?>

<?= GridView::widget([
    'dataProvider' => $dataProvider,
    // 'filterModel' => $searchModel,
    'columns' => [
        ['class' => 'yii\grid\SerialColumn'],
        'name',
        'visit_code',
        'visit_date:datetime',
        'additional_info:ntext',
        [
            'attribute' => 'status',
            'value' => 
                function($rows)
                    {
                        switch ($rows['status']) {
                            case 1:
                                $vStatus = 'Disetujui';
                                break;
                            case 2:
                                $vStatus = 'Ditolak';
                                break;
                            
                            default:
                                $vStatus = 'Pending';
                                break;
                        }
                        return $vStatus;
                    }
        ], 
        [
            'header' => 'Aksi',
            'class' => 'yii\grid\ActionColumn',
            'template' => '{view} {approve}',
            'buttons' => [
                'view' => function ($url, $model) {
                    return Html::a('<span class="glyphicon glyphicon-info-sign"></span>', $url, [
                                'title' => Yii::t('app','Detail'),
                    ]);
                },

                'approve' => function ($url, $model) {
                    return Html::a('<span class="glyphicon glyphicon-check"></span>', $url, [
                                'title' => Yii::t('app', 'Approve'),
                    ]);
                }
                
            ],

            'urlCreator' => function ($action, $model, $key, $index) {
                if ($action === 'view') {
                    $url = [
                        'visited/view/', 
                        'id' => $model['id'],
                    ];
                    return $url;
                }

                if ($action === 'approve') {
                    $url = [
                        'visited/approve',
                        'id'=> $model['id'],
                    ];
                    return $url;
                }
            }
        ]

    ],
]); ?>