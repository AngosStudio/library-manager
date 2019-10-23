<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Book_model extends LB_Model {

    var $tipo_log  = 'padrao';

    var $col_id    = 'id';
    var $table     = 'lb_books';
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
        'id_genre' => [
            'label' => 'Genre',
            'coluna' => 'id_genre',
            'datatable' => true,
            'filtrar' => true,
            'tipo' => 'fk',
            'fk' => [
                'table' => 'lb__genres',
                'table_alias' => 'gr',
                'id' => 'id',
                'label' => 'name',
                'controller' => 'genre',
            ],
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
        'description' => [
            'label' => 'Description',
            'coluna' => 'description',
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
