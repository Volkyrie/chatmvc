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
		$userId = $_GET['userId'];
		$roomId = $_GET['roomId'];
		$message = $_GET['msg'];
		$date = $_GET['date'];
		$color = $_GET['color'];
		
		$this->oChatModel->insertMessage($userId, $roomId, $message, $date, $color);
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
		error_log(print_r($messages, 1));
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

	public function render(string $fichier, array $data = []): void {
		require_once($fichier);
		$data = $data;
	}
}
