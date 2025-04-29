# PlayerAPI
> A lightweight and flexible API for managing player data in **PocketMine-MP API 5**.

---

## 📥 Installation
1. Download the `PlayerAPI.zip` file.
2. Extract it into your server's `plugins/` folder.
3. Make sure the plugin is enabled when starting the server.

---

## 📚 What does BetterPlayerData offer?
- **Automatic** saving and loading of player data.
- **Profile** support (different sets of data for the same player, e.g., survival, skywars, creative...).
- Data stored in **JSON** format (easily editable if needed).
- Simple methods to **set**, **get**, and **remove** player data.

---

## 🛠️ Basic Usage

### 📥 Save a value
```php
use IndexDev\PlayerAPI\PlayerDataAPI;

PlayerDataAPI::getInstance()->set($player, "coins", 100);
```

### 📤 Get a value
```php
$coins = PlayerDataAPI::getInstance()->get($player, "coins");
```

### 🗑️ Remove a value
```php
PlayerDataAPI::getInstance()->remove($player, "coins");
```

### 📄 Get all data
```php
$data = PlayerDataAPI::getInstance()->getAll($player);
```

---

## 🗂️ Using Profiles
BetterPlayerData supports **profiles** to separate data.

Example: saving money in the `skywars` profile:
```php
PlayerDataAPI::getInstance()->set($player, "coins", 50, "skywars");
```

Retrieving money from the `skywars` profile:
```php
$coins = PlayerDataAPI::getInstance()->get($player, "coins", "skywars");
```

---

## 📂 Storage Structure
Each player's data is stored in:
```
plugin_data/PlayerAPI/players/<UUID>.json
```

Example structure:
```json
{
    "default": {
        "coins": 100,
        "level": 5
    },
    "skywars": {
        "coins": 50,
        "kills": 10
    }
}
```

---

## ⚙️ Handled Events
- **onJoin**: Loads player data.
- **onQuit**: Saves and unloads player data.
- **Auto-save**: Saves automatically every 5 minutes.

---

## 🧩 Requirements
- **PocketMine-MP API 5.0.0**
- No external plugins required.

---

## 👤 Author
- **IndexDev** — developing solutions for PocketMine servers.
