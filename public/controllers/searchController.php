<?php
class SearchController extends AppController{
	function __construct(){
		if (session_status() == PHP_SESSION_NONE) {
			session_start();
		}

		$this->UsersSchema = new UsersSchema();
		$this->NetworkPostsSchema = new NetworkPostsSchema();
		$this->RelationsSchema = new RelationsSchema();
		$this->PostLikesSchema = new PostLikesSchema();

		$this->auth();

		if ($_SERVER['REQUEST_METHOD'] == "POST" && isset($_POST['postId'])) {
			$this->handleRequest($_POST['postId']);
		}
	}

	public function user($nameSearch){
		$friends = $this->RelationsSchema->getFriends($_SESSION['user']['id']);

		$pendingFriendsIds = $this->RelationsSchema->getPendingFriends($_SESSION['user']['id']);
		$pendingFriends = [];
		$pf2 = [];
		foreach ($pendingFriendsIds as $key => $pendingFriend) {
			$pendingFriends[$key] = $this->UsersSchema->getUserByID($pendingFriend['userAdded']);
			$pf2[] = $pendingFriend['userAdded'];
			$pendingFriends[$key]['relationId'] = $pendingFriend['relationId'];
		}

		$sentRequests = $this->RelationsSchema->getSentRequests($_SESSION['user']['id']);
		$notRecomended = array_merge($friends, $pf2);
		$notRecomended = array_merge($notRecomended, $sentRequests);
		$suggestedUsers = $this->UsersSchema->getSugestedFriends($_SESSION['user']['id'], $notRecomended);

		$search_results = $this->UsersSchema->searchUser($nameSearch);

		foreach ($search_results as $key => $res) {
			if($res['id'] == $_SESSION['user']['id']){
				//Sou eu
				$search_results[$key]['friend_status'] = 'self';
			}else if(in_array($res['id'], $friends)) {
				//É amigo
				$search_results[$key]['friend_status'] = 'friend';
			}else if(in_array($res['id'], $pf2)){
				foreach ($pendingFriends as $key => $request) {
					if ($request['id'] == $res['id']) {
						$search_results[$key]['relation_id'] = $pendingFriend['relationId'];
					}
				}
				//Está pendente para eu aceitar
				$search_results[$key]['friend_status'] = 'pending';
			}else if(in_array($res['id'], $sentRequests)){
				//Está aguardando resposta
				$search_results[$key]['friend_status'] = 'waiting';
			}
		}

		set([
			'search_results' => $search_results,
			'sugested' => $suggestedUsers,
			'friends' => $friends,
			'pendingFriends' => $pendingFriends,
			'dispayName' => $_SESSION['user']['name'],
			'occupation' => $_SESSION['user']['occupation'],
			'createPost' => true,
			'addCurrentFriend' => false,
			'loggedUser' => $_SESSION['user']['id']
		]);
	}

	public function friends($userId){
		$friends = $this->RelationsSchema->getFriends($_SESSION['user']['id']);
		$searchedFriends = $this->RelationsSchema->getFriends($userId);

		$pendingFriendsIds = $this->RelationsSchema->getPendingFriends($_SESSION['user']['id']);
		$pendingFriends = [];
		$pf2 = [];
		foreach ($pendingFriendsIds as $key => $pendingFriend) {
			$pendingFriends[$key] = $this->UsersSchema->getUserByID($pendingFriend['userAdded']);
			$pf2[] = $pendingFriend['userAdded'];
			$pendingFriends[$key]['relationId'] = $pendingFriend['relationId'];
		}

		$sentRequests = $this->RelationsSchema->getSentRequests($_SESSION['user']['id']);
		$notRecomended = array_merge($friends, $pf2);
		$notRecomended = array_merge($notRecomended, $sentRequests);
		$suggestedUsers = $this->UsersSchema->getSugestedFriends($_SESSION['user']['id'], $notRecomended);

		$search_results = null;
		foreach ($searchedFriends as $key => $friend) {
			$search_results[] = $this->UsersSchema->getUserByID($friend);
		}

		foreach ($search_results as $key => $res) {
			if($res['id'] == $_SESSION['user']['id']){
				//Sou eu
				$search_results[$key]['friend_status'] = 'self';
			}else if(in_array($res['id'], $friends)) {
				//É amigo
				$search_results[$key]['friend_status'] = 'friend';
			}else if(in_array($res['id'], $pf2)){
				foreach ($pendingFriends as $key => $request) {
					if ($request['id'] == $res['id']) {
						$search_results[$key]['relation_id'] = $pendingFriend['relationId'];
					}
				}
				//Está pendente para eu aceitar
				$search_results[$key]['friend_status'] = 'pending';
			}else if(in_array($res['id'], $sentRequests)){
				//Está aguardando resposta
				$search_results[$key]['friend_status'] = 'waiting';
			}
		}

		set([
			'search_results' => $search_results,
			'sugested' => $suggestedUsers,
			'friends' => $friends,
			'pendingFriends' => $pendingFriends,
			'dispayName' => $_SESSION['user']['name'],
			'occupation' => $_SESSION['user']['occupation'],
			'createPost' => true,
			'addCurrentFriend' => false,
			'loggedUser' => $_SESSION['user']['id']
		]);
	}


	public function acceptFriend($id){
		if ($id != $_SESSION['user']['id']) {
			$result = $this->RelationsSchema->acceptFriend($id);
		}

		redirect("/");
	}

	public function refuseFriend($id){
		if ($id != $_SESSION['user']['id']) {
			$result = $this->RelationsSchema->refuseFriend($id);
		}

		redirect("/");
	}

	public function savePost($content, $image){
		$errors     = array();
		$maxsize    = 2097152;
		$acceptable = array(
			'image/jpeg',
			'image/jpg',
			'image/png'
		);

		if(($image['size'] >= $maxsize) || ($image["size"] == 0)) {
			$errors[] = 'File too large. File must be less than 2 megabytes.';
		}

		if((!in_array($image['type'], $acceptable)) && (!empty($image["type"]))) {
			$errors[] = 'Invalid file type. Only JPG, PNG types are accepted.';
		}

		if(count($errors) === 0) {
			$dataArray = array($_SESSION['user']['id'], $content['description'], $image['name'] ,date("Y-m-d H:i:s"));
			$insertedId = $this->NetworkPostsSchema->insertNetworkPost($dataArray);
			$ext = pathinfo($image['name'], PATHINFO_EXTENSION);
			if ($image["tmp_name"]) {
				$folder = PROJECT_ROOT."assets".DIRECTORY_SEPARATOR."images".DIRECTORY_SEPARATOR."posts/";
				move_uploaded_file($image["tmp_name"], $folder.$insertedId.".".$ext);
				redirect("/");
			}
		} else {
			foreach($errors as $error) {
				echo '<script>alert("'.$error.'");</script>';
			}
			die();
			redirect("/");
		}
	}

	public function saveLike($post_id){
		$dataArray = [
			$_SESSION['user']['id'],
			$post_id
		];

		$result = $this->PostLikesSchema->insertLike($dataArray);
	}

	public function saveComment($post_id, $content){
		$dataArray = array($_SESSION['user']['id'], $post_id, $content, date("Y-m-d H:i:s"));
		$result = $this->NetworkPostsSchema->insertComment($dataArray);
		if ($result) {
			echo json_encode([
				"name" => $_SESSION['user']['name'],
				"conteudo" => $content,
				"date" => date("d/m/Y")
			]);
		}
		die();
	}

	public function addUser($id){
		$loggedUser = $_SESSION['user']['id'];
		if ($id != $_SESSION['user']['id']) {
			$result = $this->RelationsSchema->addFriend($loggedUser, $id);
		}

		redirect("/");
	}

	private function check_file_uploaded_name($filename){
		(bool) ((preg_match("`^[-0-9A-Z_\.]+$`i",$filename)) ? true : false);
	}

	private function handleRequest($postId){
		if($postId == 'savePost'){

			$this->savePost($_POST, $_FILES['image']);

		} else if($postId == 'submitComment'){

			$this->saveComment($_POST['network_posts_id'], $_POST['content']);

		} else if($postId == 'likePost'){
			$this->saveLike($_POST['network_posts_id']);

		} else if($postId == "logOut"){

			$this->logOut();

		}
	}

	private function getImagesPathAndExt($id, $imgName){
		$imgExt = pathinfo($imgName, PATHINFO_EXTENSION);
		return "posts/$id.$imgExt";
	}
}
