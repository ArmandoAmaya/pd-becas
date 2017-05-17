<?php
class BecasController extends Controllers{
	private $b;
	public function __construct(Becas $b) {
		parent::__construct();
		$this->b = $b;
	}

	public function index() {
		echo $this->view->render('becas/index',array(
			'becas' => $this->b->get_becas()
		));
	}

	public function ver() {
		
		if (2 == sizeof($this->request->_getargs()) and false != ($item = $this->b->get_becas(true)) ) {
			echo $this->view->render('becas/ver',array(
				'beca' => $item[0]
			));
		}else{
			Str::redir();
		}
		
		
	} 
}