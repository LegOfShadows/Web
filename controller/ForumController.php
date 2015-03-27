<?php
class ForumController extends Controller {
	public function __construct() {
		$this->models = array (
				'Thread',
				'Post' 
		);
		$this->auth = array (
				'post' => 'deny' 
		);
		parent::__construct ();
	}
	public function index($id = false) {
		if ($id == false) {
			$cat = array (
					'categories' => $this->Thread->GetCategories () 
			);
			$this->view->AddData ( $cat );
		} else {
			$threads = array (
					'threads' => $this->Thread->GetThreadsByCategory ( $id ) 
			);
			$this->view->AddData ( $threads );
		}
	}
	public function thread($id) {
		if (! isset ( $id ) || $id == '') {
			$this->SetFlash ( 'Wrong Thread', 'This thread doesn\'t exist yet' );
			$this->Redirect ( 'forum/index' );
		}
		$this->Thread->Load ( $id );
		$posts = $this->Post->GetPostsByThread ( $id );
		$this->view->AddData ( array (
				'thread' => $this->Thread,
				'posts' => $posts 
		) );
		$this->view->title = $this->Thread->title;
	}
	public function post($id) {
		if (! isset ( $id ) || $id == '') {
			$this->SetFlash ( 'Wrong Thread', 'This thread doesn\'t exist yet' );
			$this->Redirect ( 'forum/index' );
		}
		if ($this->IsPost ()) {
			$this->Post->owner = $_SESSION ['User']->id;
			$this->Post->thread = $id;
			$this->Post->text = $_POST ['text'];
			$this->Post->Create ();
			$this->Redirect ( 'forum/thread/' . $id );
		} else {
			$this->view->title = 'Reply to Post';
			$this->view->AddData ( array (
					'id' => $id 
			) );
		}
	}
	public function create() {
		if (! Auth::Check ( 2 )) {
			$this->SetFlash ( 'Forbidden', 'Your access level is too low to create new threads' );
			$this->Redirect ( 'forum/index');
		}
		$data = $this->Thread->GetCategories ();
		$this->view->AddData ( array (
				'categories' => $data
		) );
		if ($this->IsPost ()) {
			Log::Add('post',$_POST);
			$this->Thread->title = $_POST ['title'];
			$this->Thread->category = $_POST ['category'];
            $this->Thread->owner = $_SESSION['User']->id;
			$this->Thread->Create();
		} else {

		}
	}
}