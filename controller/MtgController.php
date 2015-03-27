<?php
class MtgController extends Controller {
	public function index($from = false,$to = false) {
        $this->view->title = 'MTG Card Search';
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
        $this->view->title = 'MTG Card Search';
        if (isset($_POST['search'])) {
            $txt = $_POST['search'];
            if (String::Lower($txt) == 'potato') {
                $this->view->AddData(array('potato' => '<h1>NO POTATO FOR YOU</h1>'));
            }
            if (strlen($txt) >= 3) {
                $card = new Card();
                $result = $card->Search($txt);
                if ($result) {
                    $this->view->AddData(array('cards'=> $result));
                }
            } else {
                $this->setFlash('Oops','Query text is too short; it must be at least 3 characters long');
            }
        }
	}
}