<?php

declare(strict_types=1);

namespace KienMC\RegisterLogin; 

use pocketmine\player\Player;
use pocketmine\Server;
use pocketmine\scheduler\Task;
use KienMC\RegisterLogin\Main;

class TimeTask extends Task {

	private Main $plugin;

	public function __construct(Main $plugin, $name){
		$this->plugin = $plugin;
		$this->name = $name;
	}
	
	public $name;

	public function onRun() : void {
		$playername=(string)($this->name);
		if($this->plugin->getServer()->getPlayerByPrefix($playername)!==null and $this->plugin->login->get($playername)!==true){
			$player=$this->plugin->getServer()->getPlayerByPrefix($playername);
			$player->kick("Login Time Out");
		}
	}
}
