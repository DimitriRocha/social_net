<?php
class StartController extends AppController{
	public $UsersSchema;

	function __construct(){
		if (session_status() == PHP_SESSION_NONE) {
			session_start();
		}

		$this->UsersSchema = new UsersSchema();
		$this->NetworkPostsSchema = new NetworkPostsSchema();
		$this->RelationsSchema = new RelationsSchema();
		$this->PostLikesSchema = new PostLikesSchema();

		$this->auth();
	}

	public function index(){
		if ($_SERVER['REQUEST_METHOD'] == "POST" && isset($_POST['postId'])) {
			$this->handleRequest($_POST['postId']);
		}

		$friends = $this->RelationsSchema->getFriends($_SESSION['user']['id']);

		$pendingFriendsIds = $this->RelationsSchema->getPendingFriends($_SESSION['user']['id']);
		$pendingFriends = [];
		$pf2 = [];
		foreach ($pendingFriendsIds as $key => $pendingFriend) {
			$pendingFriends[$key] = $this->UsersSchema->getUserByID($pendingFriend['userAdded']);
			$pf2[] = $pendingFriend['userAdded'];
			$pendingFriends[$key]['relationId'] = $pendingFriend['relationId'];
		}


		$results = $this->NetworkPostsSchema->getPostsMainPage($friends);
		foreach ($results as $key => $result) {
			$results[$key]['post_img_path'] = $this->getImagesPathAndExt($result['post_id'], $result['img_name']);
			$results[$key]['likes'] = $this->NetworkPostsSchema->getPostLikes($result['post_id']);
			$results[$key]['num_likes'] = count($results[$key]['likes']);
			$results[$key]['user_liked'] = false;
			foreach ($results[$key]['likes'] as $like) {
				if ($like['user_id'] == $_SESSION['user']['id']) {
					$results[$key]['user_liked'] = true;
				}
			}
		}


		$sentRequests = $this->RelationsSchema->getSentRequests($_SESSION['user']['id']);
		$notRecomended = array_merge($friends, $pf2);
		$notRecomended = array_merge($notRecomended, $sentRequests);
		$suggestedUsers = $this->UsersSchema->getSugestedFriends($_SESSION['user']['id'], $notRecomended);

		set([
			'result' => $results,
			'sugested' => $suggestedUsers,
			'friends' => $friends,
			'pendingFriends' => $pendingFriends,
			'dispayName' => $_SESSION['user']['name'],
			'occupation' => $_SESSION['user']['occupation'],
			'createPost' => true,
			'addCurrentFriend' => false
		]);
	}

	public function profile($profileId){
		//$friends = $this->RelationsSchema->getFriends($_SESSION['user']['id']);
		$profile = $this->UsersSchema->getUserByID($profileId);

		// $results = $this->NetworkPostsSchema->getPostsMainPage($friends);
		$results = $this->NetworkPostsSchema->getPostsProfilePage($profileId);
		foreach ($results as $key => $result) {
			$results[$key]['post_img_path'] = $this->getImagesPathAndExt($result['post_id'], $result['img_name']);
			$results[$key]['likes'] = $this->NetworkPostsSchema->getPostLikes($result['post_id']);
			$results[$key]['num_likes'] = count($results[$key]['likes']);
			$results[$key]['user_liked'] = false;
			foreach ($results[$key]['likes'] as $like) {
				if ($like['user_id'] == $_SESSION['user']['id']) {
					$results[$key]['user_liked'] = true;
				}
			}
		}

		set([
			'result' => $results,
			'sugested' => null,
			'friends' => null,
			'dispayName' => $profile['name'],
			'occupation' => $profile['occupation'],
			'createPost' => false,
			'addCurrentFriend' => $profileId,
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
