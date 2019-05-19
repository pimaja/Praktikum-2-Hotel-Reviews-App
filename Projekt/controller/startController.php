<?php

class StartController extends BaseController
{
	public function index()
	{
		$ls = new SmjestajService();

		// Popuni template potrebnim podacima
		$this->registry->template->title = 'Nađi svoj smještaj!';

        $this->registry->template->show( 'start_index' );
	}

};

?>
