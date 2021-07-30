<?php

use Dcat\Admin\Admin;
use Dcat\Admin\Grid;
use Dcat\Admin\Form;
use Dcat\Admin\Grid\Filter;
use Dcat\Admin\Show;

/**
 * Dcat-admin - admin builder based on Laravel.
 * @author jqh <https://github.com/jqhph>
 *
 * Bootstraper for Admin.
 *
 * Here you can remove builtin form field:
 *
 * extend custom field:
 * Dcat\Admin\Form::extend('php', PHPEditor::class);
 * Dcat\Admin\Grid\Column::extend('php', PHPEditor::class);
 * Dcat\Admin\Grid\Filter::extend('php', PHPEditor::class);
 *
 * Or require js and css assets:
 * Admin::css('/packages/prettydocs/css/styles.css');
 * Admin::js('/packages/prettydocs/js/main.js');
 *
 */
//重写admin.php中的配置项
$site_url = admin_setting('weburl');
$logo = '<img src="'.$site_url.'/storage/'.admin_setting('logo').'" width="35"> &nbsp;'.admin_setting('webname');
$logo_mini = '<img src="'.$site_url.'/storage/'.admin_setting('logo').'">';
Config([
    'admin.logo' => $logo,
    'admin.logo-mini' => $logo_mini
]);

