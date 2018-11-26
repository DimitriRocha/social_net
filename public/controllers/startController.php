<?php
class StartController extends AppController{
	public $UsersSchema;

	function __construct(){
		if (session_status() == PHP_SESSION_NONE) {
			session_start();
		}

		$this->UsersSchema = new UsersSchema();
		$this->NetworkPostsSchema = new PostCommentsSchema();
		
		$this->auth();
	}

	public function index(){

		if ($_SERVER['REQUEST_METHOD'] == "POST" && isset($_POST['postId'])) {
			
			if($_POST['postId'] == 0){
				
				$this->savePost($_POST['content'], $_POST['image']);
			
			} else if($_POST['postId'] == 1){
			
				$this->saveComment($_POST['network_posts_id'], $_POST['content']);

			} else if($_POST['postId'] == -1){
				
				$this->logOut();
			}
		}

		$result = $this->NetworkPostsSchema->getPostsMainPage();
		set($result);
	}
	
	public function savePost($content, $image){
		$dataArray = array($_SESSION['user']['id'], $content, $image, date("Y-m-d H:i:s"));
		$result = $this->NetworkPostsSchema->insertNetworkPost($dataArray);
	}

	public function saveComment($post_id, $content){
		$dataArray = array($_SESSION['user']['id'], $post_id, $content, date("Y-m-d H:i:s"));
		$result = $this->NetworkPostsSchema->insertComment($dataArray);
	}
}
