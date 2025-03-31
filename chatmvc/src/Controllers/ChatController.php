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

	public function chatIndex()
	{
		$roomNb = 1;
		$messages = $this->oChatModel->getMessages($roomNb);
		$data['room_id'] = $messages[0]['room_id'];
		$data['user'] = $_SESSION['user'];
		$data['currentroomid'] = $messages[0]['room_id'];
		$data['currentroom'] = $messages[0]['room_name'];
		$data['rooms'] = $this->oChatModel->getRooms();
		$data['messages'] = $messages;
		$this->render(ROOT.'/src/Views/chat/ChatView.php', $data);
	}

	public function render(string $fichier, array $data = []): void {
		require_once($fichier);
		$data = $data;
	}
}
