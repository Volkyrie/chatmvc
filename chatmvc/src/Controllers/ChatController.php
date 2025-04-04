<?php

namespace MyApp\Controllers;

// use ici le namespace des classes que tu utilises
use MyApp\Models\chatModel;
use MyApp\Config\Conf;

class ChatController
{
	protected $oChatModel;
	
	public function __construct()
	{
		$this->oChatModel = new chatModel();
	}

	public function insert() {
		$data = json_decode(file_get_contents('php://input'), true);
		$user = $data['name'];
		$userId = $this->oChatModel->getUserId($user);
		$roomId = $data['room'];
		$message = $data['message'];
		$color = $data['color'];

		$this->oChatModel->insertMessage($userId->userId, $roomId, $message, $color);
		echo json_encode(array("rep" => "ok"));
	}

	public function chatIndex()
	{
		$params = explode('/', htmlspecialchars($_GET['action']));
		if(isset($params[2])){
			$roomNb = htmlspecialchars($params[2]);
		} else {
			$roomNb = 1;
		}
		$messages = $this->oChatModel->getMessages($roomNb);
		$data['currentroomid'] = $roomNb;
		$data['room_id'] = $roomNb;
		$data['user'] = $_SESSION['user'];
		$data['rooms'] = $this->oChatModel->getRooms();
		$data['currentroom'] = $messages[0]['room_name'];
		if(isset($messages[0]['text'])) {
			$data['isset'] = 1;
			$data['messages'] = $messages;
		} else {
			$data['isset'] = 0;
		}
		$this->render(ROOT.'/src/Views/chat/ChatView.php', $data);
	}

	public function search() {
		if(isset($_POST['keyword'])) {
			$keyword = $_POST['keyword'];
			$data = $this->oChatModel->searchMessages($keyword);
			$bkgdcolor = "#ADD8E6";
			foreach($data as $key => $item) {
				echo "<div style='background-color: ". $bkgdcolor ."'><span>".$item['user_name']." @ ".$item['room_name']." le ".date('d/m/Y H:i:s',$item['date'])." a écrit: <br>".$item['text']."</span></div><br>";
				if($bkgdcolor != "#ADD8E6") {
					$bkgdcolor = "#ADD8E6";
				} else {
					$bkgdcolor = "white";
				}
			}
		} else {
			$data['user'] = $_SESSION['user'];
			$this->render(ROOT.'/src/Views/chat/SearchView.php', $data);
		}
	}

	public function render(string $fichier, array $data = []): void {
		require_once($fichier);
		$data = $data;
	}
}