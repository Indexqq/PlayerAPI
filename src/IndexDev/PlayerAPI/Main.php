<?php

namespace IndexDev\PlayerAPI;

use pocketmine\plugin\PluginBase;
use pocketmine\event\Listener;
use pocketmine\event\player\PlayerQuitEvent;
use pocketmine\event\player\PlayerJoinEvent;
use pocketmine\player\Player;
use pocketmine\utils\SingletonTrait;
use pocketmine\scheduler\ClosureTask;

class Main extends PluginBase implements Listener {
    use SingletonTrait;

    protected function onEnable(): void {
        self::setInstance($this);

        @mkdir($this->getDataFolder() . "players/");

        $this->getServer()->getPluginManager()->registerEvents($this, $this);

        /** AutoSaveTask every 5 minutes  */
        $this->getScheduler()->scheduleRepeatingTask(new ClosureTask(function() : void {
            PlayerDataAPI::getInstance()->saveAll();
        }), 20 * 60 * 5);
    }

    public function onJoin(PlayerJoinEvent $event): void {
        $player = $event->getPlayer();
        PlayerDataAPI::getInstance()->load($player);
    }

    public function onQuit(PlayerQuitEvent $event): void {
        $player = $event->getPlayer();
        PlayerDataAPI::getInstance()->save($player);
        PlayerDataAPI::getInstance()->unload($player);
    }
}
