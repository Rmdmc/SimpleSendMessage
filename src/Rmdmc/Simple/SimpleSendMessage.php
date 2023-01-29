<?php

namespace Rmdmc\Simple;
use pocketmine\plugin\PluginBase;
class SimpleSendMessage extends PluginBase
{

    public function onEnable(): void
    {
        $this->getServer()->getCommandMap()->register("sendmessage",new SendMessageCommand($this));
    }
}
