<?php
class MtgController extends Controller {
	public function index($from = false,$to = false) {
		if (($from != false) and ($to != false)) {
            $card = new Card();
            $result = $card->All($from, $to);
            if ($result) {
                $this->view->AddData(array('cards' => $result));
            }
        }
	}
	public function card($id) {
		
	}
	public function result() {
        echo 'w/e';
	}

    public function ajaxSearch($nextcardid) {
        $card = new Card();
        $card->GetNextCard(123);
        echo json_encode($card);
    }
	public function search() {
        if (isset($_POST['search'])) {
            $txt = $_POST['search'];
            if (String::Lower($txt) == 'potato') {
                $this->view->AddData(array('potato' => '<h1>NO POTATO FOR YOU</h1>'));
            }
            $card = new Card();
            $result = $card->Search($txt);
            if ($result) {
                $this->view->AddData(array('cards'=> $result));
            }
        }
	}
}