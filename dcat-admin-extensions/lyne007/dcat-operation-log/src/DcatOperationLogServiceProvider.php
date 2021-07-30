<?php

namespace Lyne007\DcatOperationLog;

use Dcat\Admin\Extend\ServiceProvider;
use Dcat\Admin\Admin;

class DcatOperationLogServiceProvider extends ServiceProvider
{
	protected $js = [
        'js/index.js',
    ];
	protected $css = [
		'css/index.css',
	];

    // 定义菜单
    protected $menu = [
        [
            'title' => 'Operation Log',
            'uri'   => 'auth/operation-logs',
            'icon'  => '', // 图标可以留空
        ]
    ];

	public function register()
	{
		//
	}

	public function init()
	{
		parent::init();

		//
		
	}

	public function settingForm()
	{
		return new Setting($this);
	}


}
