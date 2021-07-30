<?php

namespace App\Admin\Controllers;

use App\Admin\Forms\Setting;
use Dcat\Admin\Widgets\Card;
use App\Http\Controllers\Controller;
use Dcat\Admin\Layout\Content;

class SettingsController extends Controller
{
    public function index(Content $content) {
        return $content
            ->title('网站配置')
            ->description('详情')
            ->body(new Card(new Setting()));
    }

}