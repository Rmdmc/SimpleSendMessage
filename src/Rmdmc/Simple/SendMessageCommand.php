<?php

namespace Rmdmc\Simple;

use pocketmine\command\Command;
use pocketmine\command\CommandSender;
use pocketmine\command\utils\InvalidCommandSyntaxException;
use pocketmine\lang\KnownTranslationFactory;
use pocketmine\permission\DefaultPermissionNames;
use pocketmine\player\Player;
use pocketmine\utils\TextFormat;
use function array_shift;
use function count;
use function implode;

class SendMessageCommand extends Command
{
    private SimpleSendMessage $plugin;

    public function __construct(SimpleSendMessage $pl)
    {
        $this->plugin = $pl;
        parent::__construct("sendmessage", "Simple Send Message", "/sendmessage <player> <text>", ["sendmessage"]);
    }

    public function execute(CommandSender $sender, string $commandLabel, array $args)
    {
        if(count($args) < 2){
			throw new InvalidCommandSyntaxException();
		}

		$player = $sender->getServer()->getPlayerByPrefix(array_shift($args));

		if($player === $sender){
			$sender->sendMessage(KnownTranslationFactory::commands_message_sameTarget()->prefix(TextFormat::RED));
			return true;
		}

		if($player instanceof Player){
		    $message = implode(" ", $args);
			$sender->sendMessage("Successfully sent a message §b" . $message . " §fto §e" . $player->getDisplayName());
			$name = $sender instanceof Player ? $sender->getDisplayName() : $sender->getName();
			$player->sendMessage($message);
		}else{
			$sender->sendMessage("Player not found");
		}

		return true;
        }
    }
