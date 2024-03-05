<?php

declare(strict_types=1);

namespace KienMC\RegisterLogin; 

use pocketmine\player\Player;
use pocketmine\Server;
use pocketmine\plugin\PluginOwned;
use pocketmine\command\{Command, CommandSender};
use pocketmine\console\ConsoleCommandSender;
use KienMC\RegisterLogin\Main;

class LoginCMD extends Command implements PluginOwned {
	
	private Main $plugin;
	
	 public function __construct(Main $plugin){
		$this->plugin = $plugin;
		parent::__construct("login", "Login", null, ["lg"]);
		$this->setPermission("login.cmd");
	}
	
	public function execute(CommandSender $player, string $label, array $args){
		if($player instanceof Player){
			if(!isset($args[0])){
				$player->sendMessage("§l§c•§a Use:§e /login <password>");
				return true;
			}
			$name=$player->getName();
			if(!$this->plugin->password->exists($name)){
				$player->sendMessage("§l§c• You Are Not Registered, Please Register Account: §e/register <pasword>");
				return true;
			}
			if($args[0]==$this->plugin->password->get($name)){
				$this->plugin->login->set($name, true);
				$this->plugin->login->save();
				$player->sendMessage("§l§c•§a Logined Successfully");
			}else{
				$player->sendMessage("§l§c• Wrong Password");
			}
		}else{
			$player->sendMessage("Use Command In Game");
		}
	}
	
	public function getOwningPlugin(): Main{
		return $this->plugin;
	}
}
