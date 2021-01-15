<?php 
namespace slider;

use pocketmine\plugin\PluginBase;
use pocketmine\event\Listener;
use pocketmine\command\CommandSender;
use pocketmine\command\Command;
use pocketmine\Player;

class Main extends PluginBase implements Listener{
	public function onCommand(CommandSender $sender,Command $command,string $label,array $args): bool{
		switch ($command->getName())
		{
			case "slider":
				if($sender instanceof Player){
					$this->form($sender);
				}
		}
		return true;
	}
	public function form($player){
		$api = $this->getServer()->getPluginManager()->getPlugin("FormAPI");
		$form = $api->createCustomForm(function(Player $player, array $data = null){
			$serv = $player->getServer();
			if($data == null)
			{
				return true;
			}
				$serv->getPlayer($player->getName())->setGamemode($data[0]);
				$player->sendMessage("§l§b[§d시스템§b]§f모드 변경 완료");
		});
		$form->setTitle("§l§b[§f시스템§b]");
		$form->addSlider("§l§b[§f게임모드변경§b]§f", 0,1);
		$form->sendToPlayer($player);
		return $form;
		
	}
}
?>