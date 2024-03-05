<?php

declare(strict_types=1);

namespace RegisterLogin\KienMC;

use pocketmine\player\Player;
use pocketmine\Server;
use pocketmine\plugin\PluginOwned;
use pocketmine\command\{Command, CommandSender};
use pocketmine\console\ConsoleCommandSender;
use RegisterLogin\KienMC\Main;

class RegisterCMD extends Command implements PluginOwned {
	
	private Main $plugin;
	
	 public function __construct(Main $plugin){
		$this->plugin = $plugin;
		parent::__construct("register", "Register", null, ["rgt"]);
		$this->setPermission("register.cmd");
	}
	
	public function execute(CommandSender $player, string $label, array $args){
		if($player instanceof Player){
			if(!isset($args[0])){
				$player->sendMessage("§l§c•§a Use:§e /register <password>");
				return true;
			}
			$name=$player->getName();
			if($this->plugin->password->exists($name)){
				$player->sendMessage("§l§c• Your Account Has Been Existed In System");
				return true;
			}
			$this->plugin->password->set($name, $args[0]);
			$this->plugin->password->save();
			$this->plugin->login->set($name, true);
			$this->plugin->login->save();
			$player->sendMessage("§l§c•§a Registered Successfully");
			$player->sendMessage("§l§c•§a Logined Successfully");
		}else{
			$player->sendMessage("Use Command In Game");
		}
	}
	
	public function getOwningPlugin(): Main{
		return $this->plugin;
	}
}
