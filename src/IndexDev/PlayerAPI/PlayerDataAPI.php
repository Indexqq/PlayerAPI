<?php

namespace IndexDev\PlayerAPI;

use pocketmine\player\Player;
use pocketmine\utils\Config as CO;
use pocketmine\utils\SingletonTrait as ST;

class PlayerDataAPI {
    use ST;

    /** @var array<string, array<string, mixed>> */
    private array $data = [];

    /** @var array<string, Config> */
    private array $configs = [];

    public function load(Player $player): void {
        $uuid = $player->getUniqueId()->toString();
        $path = Main::getInstance()->getDataFolder() . "players/" . $uuid . ".json";

        $config = new Config($path, Config::JSON);
        $this->configs[$uuid] = $config;
        $this->data[$uuid] = $config->getAll();
    }

    public function save(Player $player): void {
        $uuid = $player->getUniqueId()->toString();
        if (isset($this->configs[$uuid])) {
            $this->configs[$uuid]->setAll($this->data[$uuid] ?? []);
            $this->configs[$uuid]->save();
        }
    }

    public function unload(Player $player): void {
        $uuid = $player->getUniqueId()->toString();
        unset($this->data[$uuid], $this->configs[$uuid]);
    }

    public function saveAll(): void {
        foreach (Main::getInstance()->getServer()->getOnlinePlayer() as $player) {
            $this->save($player);
        }
    }

    public function set(Player $player, string $key, mixed $value, string $profile = "default"): void {
        $uuid = $player->getUniqueId()->toString();
        $this->data[$uuid][$profile][$key] = $value;
    }

    public function get(Player $player, string $key, string $profile = "default"): mixed {
        $uuid = $player->getUniqueId()->toString();
        return $this->data[$uuid][$profile][$key] ?? null;
    }

    public function remove(Player $player, string $key, string $profile = "default"): void {
        $uuid = $player->getUniqueId()->toString();
        unset($this->data[$uuid][$profile][$key]);
    }

    public function getAll(Player $player, string $profile = "default"): array {
        $uuid = $player->getUniqueId()->toString();
        return $this->data[$uuid][$profile] ?? [];
    }
}
