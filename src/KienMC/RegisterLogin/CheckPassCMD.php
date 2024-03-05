<?php

declare(strict_types=1);

namespace KienMC\RegisterLogin;

use pocketmine\player\Player;
use pocketmine\Server;
use pocketmine\plugin\PluginOwned;
use pocketmine\command\{Command, CommandSender};
use pocketmine\console\ConsoleCommandSender;
use KienMC\RegisterLogin\Main;

class CheckPassCMD extends Command implements PluginOwned {
	
	private Main $plugin;
	
	 public function __construct(Main $plugin){
		$this->plugin = $plugin;
		parent::__construct("checkpass", "Check Pass", null, ["cp"]);
		$this->setPermission("checkpass.cmd");
	}
	
	public function execute(CommandSender $player, string $label, array $args){
		if(!$player instanceof Player){
			$player->sendMessage("Use Command In Game");
			return true;
		}
		 if(!$player->hasPermission("checkpass.cmd")){
			$player->sendMessage("§l§c• You Dont Have Permission");
			return true;
		}
		if(!isset($args[0])){
			$player->sendMessage("§l§c•§a Use:§e /checkpass <player>");
			return true;
		}
		if(!$this->plugin->password->exists($args[0])){
			$player->sendMessage("§l§c• Player Doesnt Exists");
			return true;
		}
		$pass=$this->plugin->password->get($args[0]);
		$player->sendMessage("§l§c•§a Password Of §e".$args[0]."§a Is: §e".$pass);
	}
	
	public function getOwningPlugin(): Main{
		return $this->plugin;
	}
}
