<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Genre_model extends LB_Model {

    var $tipo_log  = 'padrao';

    var $col_id    = 'id';
    var $table     = 'lb__genres';
    var $colunas   = [
        'id' => [
            'label' => 'Id',
            'coluna' => 'id',
            'datatable' => true,
            'filtrar' => true,
            'tipo' => 'int',
            'attr' => [
                'width' => '50',
                'class' => 'text-center',
            ],
            'comentario' => '',
        ],
        'date_created' => [
            'label' => 'Created At',
            'coluna' => 'date_created',
            'datatable' => true,
            'filtrar' => true,
            'tipo' => 'date',
            'comentario' => '',
        ],
        'name' => [
            'label' => 'Name',
            'coluna' => 'name',
            'datatable' => true,
            'filtrar' => true,
            'tipo' => 'varchar_like',
            'comentario' => '',
        ],
        'date_updated' => [
            'label' => 'Updated At',
            'coluna' => 'date_updated',
            'datatable' => false,
            'filtrar' => false,
            'tipo' => 'datetime',
            'comentario' => '',
        ],
        'date_deleted' => [
            'label' => 'Deleted At',
            'coluna' => 'date_deleted',
            'datatable' => false,
            'filtrar' => false,
            'tipo' => 'datetime',
            'comentario' => '',
        ],
    ];

}

/* End of file Book_model.php */
/* Location: ./application/modulos/manager/clube/models/Book_model.php */
