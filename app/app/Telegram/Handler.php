<?php

namespace App\Telegram;

use App\Models\ChatUser;
use DefStudio\Telegraph\Facades\Telegraph;
use DefStudio\Telegraph\Handlers\WebhookHandler;
use DefStudio\Telegraph\Keyboard\Button;
use DefStudio\Telegraph\Keyboard\Keyboard;
use DefStudio\Telegraph\Models\TelegaphBot;
use DefStudio\Telegraph\Keyboard\ReplyButton;
use DefStudio\Telegraph\Keyboard\ReplyKeyboard;
use DefStudio\Telegraph\Models\TelegraphChat;
use Illuminate\Container\Attributes\DB;
use Illuminate\Http\Request;
use Stringable;

class Handler extends WebhookHandler
{
    public function start(){
        $message = $this->message;
        $user = $message->from();
        $userName = $user->firstName();
        $this->reply("
*Welcome to DomofonConnect!*
Здравствуйте, $userName!  

Это приложение поможет вам попасть в вашу квартиру без ключей) 

Если хотите начать пользоваться услугой предоставте разрешение пользоваться привязаным номером телефона! 
Это обеспечит безопасность) 
Введите команду: /auth
        ");
    }
    public function auth(){
        $message = $this->message;
        $chatId = $message->chat()->id();
        Telegraph::chat($chatId)->message("Нажми на кнопку Login Phone")->replyKeyboard(ReplyKeyboard::make()->button('Login Phone')->requestContact())->send();
    }
    public function openapp(){
        $message = $this->message;
        $chatId = $message->chat()->id();
        $chat = TelegraphChat::find($chatId);
        Telegraph::chat($chatId)->message("Нажмите на кнопку, чтобы открыть мини-приложение.")->keyboard(
            Keyboard::make()->buttons([
                Button::make("Открыть мини-приложение\n DomofonConnect ")->webApp("https://8923-178-176-231-217.ngrok-free.app?chat_id=$chatId"),
            ])
        )->send();
    }
    protected function handleChatMessage(Stringable $text): void
    {
        $message = $this->message;
        $chatId = $message->chat()->id();
        if($message->contact()){
            $phone = $message->contact()->phoneNumber();
            $chatId = $message->chat()->id();
            $user = $message->from();
            $userName = $user->firstName()." ".$user->lastName();
            ChatUser::where('chat_id', $chatId)->update(['fio'=> $userName, 'phone' => str_replace("+", "",$phone)]);
            Telegraph::chat($chatId)->message("Вы вошли с *DomofonConnect* под таки номером телефона:\n *".$phone."*\n Введите команду: /openapp")->send();
        }
        
        
    }
    protected function handleUnknownCommand(\Illuminate\Support\Stringable $text): void
    {
        $message = $this->message;
        $chatId = $message->chat()->id();
        
        Telegraph::chat($chatId)->message('Неизвестная команда. Пожалуйста, используйте /start для начала.')->send();
    }


}