<?php defined('BASEPATH') OR exit('No direct script access allowed');

class LB_Model extends CI_Model {

    var $CI;

    var $col_id    = '';
    var $table     = '';
    var $generator = '';
    var $colunas   = [];
    var $tipo_log  = false;

    var $ignore_fields = ['date_created','date_updated','date_deleted'];

    function __construct(){
        parent::__construct();
        $this->CI =& get_instance();
    }

    public function save( $id, $dados ){
        $dados_log = $dados;
        if(isset($this->colunas['slug'])){
            if(empty($dados['slug'])) {
                $titulos = ['nome','titulo'];
                foreach ($titulos as $titulo) {
                    if(isset($dados[$titulo])){
                        $dados['slug'] = slugify( $dados[$titulo] );
                        break;
                    }
                }
            }else{
                $dados['slug'] = slugify( $dados['slug'] );
            }
        }

        $dados_antigos = [];
        $select = [];
        foreach ($this->colunas as $k => $v) { //if(in_array($k, $this->ignore_fields)) continue;
            $select[] = $this->colunas[$k]['coluna'].' "'.$k.'"';
        }

        if( isset($this->colunas['date_deleted']) ){
            $this->db->where('date_deleted IS NULL');
        }

        if(!is_numeric($id)){
            $this->db->where($id);
        }else{
            $this->db->where($this->col_id, $id);
        }

        $atual = $this->db->select(implode(',', $select))
                          ->get($this->table)
                          ->row()
        ;
        if(!$atual) return false;
        $id = $atual->id;

        foreach ($this->colunas as $k => $v) {
            if(isset($dados[$k])){
                if($atual->$k != $dados[$k]){
                    $dados_antigos[$k] = $atual->$k;
                }else{
                    unset($dados[$k]);
                }
            }
        }

        $dados_validos = $this->_valida_campos($dados);
        if(!empty($dados_validos)){
            if(isset($this->colunas['date_updated'])) $dados_validos['date_updated'] = date('Y-m-d H:i:s');
            $this->db->where($this->col_id, $id);
            $this->db->update($this->table, $dados_validos);
            //die($this->db->last_query());
        }

        return $id;
    }

    public function insert( $dados, $escape = NULL ){
        if(isset($this->colunas['date_created']) && empty($dados['date_created'])) $dados['date_created'] = date('Y-m-d H:i:s');

        if(isset($this->colunas['ip']) && empty($dados['ip'])) $dados['ip'] = $this->input->ip_address();
        if(isset($this->colunas['browser']) && empty($dados['browser'])) $dados['browser'] = $this->input->user_agent();

        $this->db->insert($this->table, $this->_valida_campos($dados), $escape);

        return $this->db->insert_id($this->generator);
    }

    public function delete( $id ){
        $soft_delete = isset($this->colunas['date_deleted']);
        $dados = [
            'date_deleted' => date('Y-m-d H:i:s'),
        ];
        if( $soft_delete ){
            return $this->save($id, $dados);
        }else{
            $this->db->where($this->col_id, $id);
            return $this->db->delete($this->table);
        }
    }

    public function get( $id, $select = false ){
        if( isset($this->colunas['date_deleted']) ){
            $this->db->where('date_deleted IS NULL');
        }

        if( isset($this->colunas['slug']) ){
            $this->db->group_start()
                        ->where($this->col_id, $id)
                        ->or_where('slug', $id)
                     ->group_end();
        }elseif( !is_numeric($id) ){
            $this->db->where($id);
        }else{
            $this->db->where($this->col_id, $id);
        }

        return $this->db->select($select ? $select : $this->_sql_colunas())
                        ->get($this->table)
                        ->row();
    }


    public function getAll( $select = false ){
        if( isset($this->colunas['date_deleted']) /*&& !$this->_login->isRoot()*/ ){
            $this->db->where($this->table.'.date_deleted IS NULL');
        }

        $select = $select ? $select : $this->_sql_colunas();

        //Busca as FKs e preenche os dados do select
        foreach($this->colunas as &$coluna) {

            if(!isset($coluna['tipo']) || $coluna['tipo'] != 'fk' ) continue;

            if( (isset($coluna['fk']['filtro']) && !$coluna['fk']['filtro']) ||
                empty($coluna['fk']) ||
                empty($coluna['fk']['id']) ||
                empty($coluna['fk']['label']) ||
                empty($coluna['fk']['table'])
                ) continue;

            $this->db->join($coluna['fk']['table'].' '.$coluna['fk']['table_alias'], $coluna['fk']['table_alias'].'.'.$coluna['fk']['id'].' = '.$this->table.'.'.$coluna['coluna'], 'left');
            $select .= ', '.$coluna['fk']['table_alias'].'.'.$coluna['fk']['label'].' '.$coluna['coluna'].'_label';

        }

        return $this->db->select($select)
                        ->get($this->table)
                        ->result();
    }


    public function getColunas(){

        //Busca as FKs e preenche os dados do select
        foreach($this->colunas as &$coluna) {

            if(!isset($coluna['tipo']) || $coluna['tipo'] != 'fk' ) continue;

            if( (isset($coluna['fk']['filtro']) && !$coluna['fk']['filtro']) ||
                empty($coluna['fk']) ||
                empty($coluna['fk']['id']) ||
                empty($coluna['fk']['label']) ||
                empty($coluna['fk']['table'])
                ) continue;

            $opcoes = $this->db->select(
                                   $coluna['fk']['id'].' id, '.
                                   $coluna['fk']['label'].' label'
                               )
                               ->where($coluna['fk']['label'].' IS NOT NULL')
                               ->where($coluna['fk']['label'].' != ""')
                               ->order_by($coluna['fk']['label'].' ASC')
                               ->get($coluna['fk']['table'])
                               ->result()
                    ;

            if(!empty($opcoes)) {
                //Aviso: O(n²)
                foreach($opcoes as $opcao) {
                    $coluna['opcoes'][$opcao->id]=$opcao->label;
                }
            }
        }

        return $this->colunas;
    }

    private function _valida_campos( $dados ){

        $validos = [];
        foreach ($dados as $coluna => $dado) {
            if($coluna == 'id') continue;
            if(in_array(strtolower($coluna), array_keys($this->colunas))){
                if(isset($this->colunas[$coluna]['tipo'])){
                    switch ($this->colunas[$coluna]['tipo']) {
                        case 'fk':
                            if($dado != ''){
                                $validos[ strtoupper($this->colunas[$coluna]['coluna']) ] = $dado;
                            }else{
                                $validos[ strtoupper($this->colunas[$coluna]['coluna']) ] = NULL;
                            }
                        break;
                        case 'select':
                            if(in_array($dado, array_keys($this->colunas[$coluna]['opcoes']))){
                                $validos[ strtoupper($this->colunas[$coluna]['coluna']) ] = $dado;
                            }
                        break;
                        case 'date':
                            if(!empty($dado) || $dado === null){
                                $validos[ strtoupper($this->colunas[$coluna]['coluna']) ] = $dado;
                            }
                        break;

                        default:
                            $validos[ strtoupper($this->colunas[$coluna]['coluna']) ] = $dado;
                        break;
                    }
                }else{
                    $validos[ strtoupper($this->colunas[$coluna]['coluna']) ] = $dado;
                }
            }
        }
        return $validos;
    }

    private function _sql_colunas(){
        $cols = [];
        foreach ($this->colunas as $alias => $col) {
            $cols[] = $this->table.'.'.$col['coluna'].' "'.$alias.'"';
        }
        return implode(', ', $cols);
    }

}

/* End of file LB_Model.php */
/* Location: ./application/core/LB_Model.php */
