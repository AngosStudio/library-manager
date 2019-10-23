<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Api extends LB_Controller {
    public function index(){
        show_404();
    }

    public function book( $id = false ){
        $this->load->model( 'book_model', '_book' );
        if($id && !$this->input->post()){
            $this->json(true, $this->_book->get( $id ));
        }else{
            $this->form_validation->set_rules( 'id_genre',    'Genre',       'required'      );
            $this->form_validation->set_rules( 'name',        'Name',        'trim|required' );
            $this->form_validation->set_rules( 'description', 'Description', 'trim|required' );
            if ( $this->form_validation->run() ){

                $data = [
                    'name'        => $this->input->post( 'name' ),
                    'description' => $this->input->post( 'description' ),
                    'id_genre'    => $this->input->post( 'id_genre' ),
                ];

                if($id){
                    if( !$this->_book->get( $id ) ){
                        $this->json_error( 'Book not found.' );
                    }

                    $data['id'] = $id;
                    $this->_book->save( $id, $data );
                }else{
                    $data['id'] = $this->_book->insert( $data );
                }

                $this->json(true, $data);
            }else{
                $this->json_error(str_replace("\n",'<br>',trim(validation_errors())));
            }
        }
    }

    public function delete( $id, $type = 'book' ){
        switch ($type) {
            case 'book':
                $this->load->model('book_model', '_book');
                $this->_book->delete( $id );
                $this->json(true);
            break;
            case 'genre':
                $this->load->model('genre_model', '_genre');
                $this->_genre->delete( $id );
                $this->json(true);
            break;

            default:
                $this->json_error('Type '.$type.' is invalid.');
            break;
        }
    }

    public function list( $type = 'book' ){
        switch ($type) {
            case 'books':
                $this->load->model('book_model', '_book');
                $this->json(true, $this->_book->getAll());
            break;
            case 'genres':
                $this->load->model('genre_model', '_genre');
                $this->json(true, $this->_genre->getAll());
            break;

            default:
                $this->json_error('Type '.$type.' is invalid.');
            break;
        }
    }
}
