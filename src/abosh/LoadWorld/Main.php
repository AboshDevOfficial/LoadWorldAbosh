<?php



namespace abosh\LoadWorld;

use pocketmine\event\Listener;

use pocketmine\Player;

use pocketmine\plugin\PluginBase;

use pocketmine\Server;

use pocketmine\level\Level;

use function array_diff;

use function scandir;

class Main extends PluginBase implements Listener {

    ###########################################################################

    public function onEnable(){

        $this->getLogger()->info("AutoLoad Enabled");
        $this->getServer()->getPluginManager()->registerEvents($this, $this);
        
            	//load
        
        foreach (array_diff(scandir($this->getServer()->getDataPath() . "worlds"), ["..", "."]) as $levelName) {
        	$exclude = "";
            $excludeArray = explode(",", $exclude);
            if (!in_array($levelName, $excludeArray)) {
                $this->getServer()->loadLevel($levelName);
                echo "level " . $levelName . " has loaded";
            }
        }
        $this->getServer()->shutdown();
    }
}