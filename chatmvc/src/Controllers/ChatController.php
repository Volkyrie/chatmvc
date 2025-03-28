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
		$data['room_id'] = 1;
		$data['user'] = "test";
		$data['currentroomid'] = 1;
		$data['currentroom'] = "Testing room";
		$data['rooms'] = $this->oChatModel->getRooms();
		$data['messages'] = $this->oChatModel->getMessages(1);
		$this->render(ROOT.'/src/Views/chat/ChatView.php', $data);
	}

	public function render(string $fichier, array $data = []): void {
		require_once($fichier);
		$data = $data;
	}
}
