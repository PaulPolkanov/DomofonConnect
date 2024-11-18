<?php

use DefStudio\Telegraph\Facades\Telegraph;
use Illuminate\Foundation\Inspiring;
use Illuminate\Support\Facades\Artisan;

use function Illuminate\Log\log;

Artisan::command('inspire', function () {
    $this->comment(Inspiring::quote());
})->purpose('Display an inspiring quote')->hourly();


Artisan::command('tester', function () {
    $bot = Telegraph::bot('7498277235:AAHZtQhfKYUXsefCGp4hFCs5XoUXQR4ZhIM');
    $response = $bot->registerWebhook('https://8923-178-176-231-217.ngrok-free.app/telegraph/7498277235:AAHZtQhfKYUXsefCGp4hFCs5XoUXQR4ZhIM/webhook')->send();

    if ($response->successful()) {
        // Вебхук успешно зарегистрирован
        dd($response->successful());
    } else {
    // Обработка ошибки
    $errorMessage = $response->body();
    dd('Ошибка регистрации вебхука: ' . $errorMessage);
}
    $bot = \DefStudio\Telegraph\Models\TelegraphBot::find(1);
    $bot->registerCommands(
        [
            "start" => "Приветсвие и начало авторизации",
            "auth" => "Войти под номером телефона",
            "openapp" => "Отправить ссылку на mini app",
        ]
    )->send();
});
