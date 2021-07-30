<?php

namespace App\Admin\Forms;

use Dcat\Admin\Widgets\Form;

class Setting extends Form
{
    /**
     * Handle the form request.
     *
     * @param array $input
     *
     * @return mixed
     */
    public function handle(array $input)
    {
        // dump($input);
        admin_setting($input);
        return $this->response()->success('设置成功')->location('settings');
        // return $this->response()->error('Your error message.');

//        return $this
//				->response()
//				->success('Processed successfully.')
//				->refresh();
    }

    /**
     * Build a form here.
     */
    public function form()
    {
        $this->confirm('您确定要提交表单吗', 'content');
        $this->text('webname', '网站名称')->default(admin_setting('webname', '管理系统'));
        $this->url('weburl', '网站地址')->default(admin_setting('weburl', 'http://dcatadmin.test'));
        $this->image('logo', '网站LOGO')->accept('jpg,png,gif,jpeg')->maxSize(512)->required()->autoUpload()->help('大小不要超过512K');
        $this->radio('horizontal_menu', '菜单位置')->options([0 => '侧栏', 1 => '顶栏'])->default(admin_setting('horizontal_menu',0));
        $this->radio('style_type', '网站风格')->options([1 => '旧版', 2 => '大字版']);
        $this->radio('sidebar_style', '侧栏颜色')->options(['light' => '白色','dark'=>'黑色', 'primary' => '彩色'])->default(admin_setting('sidebar_style','dark'));
        $this->radio('logintheme','登录页样式')->options(['bigpicture'=>'大图','simple'=>'简单']);
        $this->image('logobg','登录页背景图')->accept('jpg,png,gif,jpeg')->maxSize(1024)->autoUpload()->help('大小不要超过512k，仅在登录页为大图模式下生效');
    }


    /**
     * The data of the form.
     *
     * @return array
     */
    public function default()
    {
        if (admin_setting('body_class', 0)) {
            $body_class = 0;
        } else {
            $body_class = 1;
        }

        return [
            'logo' => admin_setting('logo', public_path().'/static/img/logo.png'),
            'sidebar_style' => admin_setting('sidebar_style', 'light'),
            'logintheme'=> admin_setting('logintheme','bigpicture'),
            'logobg'=> admin_setting('logobg'),
            'horizontal_menu' => admin_setting('horizontal_menu',0),
            'style_type' => admin_setting('style_type',1),
            ];
    }
}
