<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Resources extends Admin_Controller {

    public function __construct()
    {
        parent::__construct();

        /* Title Page :: Common */
        $this->page_title->push(lang('menu_resources'));
        $this->data['pagetitle'] = $this->page_title->show();

        /* Breadcrumbs :: Common */
        $this->breadcrumbs->unshift(1, lang('menu_resources'), 'admin/resources');
    }


	public function index()
	{
		if ( ! $this->ion_auth->logged_in() OR ! $this->ion_auth->is_admin())
		{
			redirect('auth', 'refresh');
		}
        else
        {
            /* Breadcrumbs */
            $this->data['breadcrumb'] = $this->breadcrumbs->show();

            $this->load->library('grocery_CRUD');
            /* TABLA */
            $crud = new grocery_CRUD();
            $crud->set_table('localidades');
            $crud->set_subject('Localidades');
            //$this->data['localidades'] = $crud->render();

            $this->load->helper('dump');
            dump($crud->render());

            /* Load Template */
            $this->template->admin_render('admin/resources/index', $this->data);
        }
	}
}
