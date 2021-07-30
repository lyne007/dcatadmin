<?php

namespace App\Admin\Controllers;

use App\Models\AttributeKey;
use App\Models\Category;
use App\Models\Merchant;
use Dcat\Admin\Http\Controllers\AdminController;
use Illuminate\Http\Request;

class ApiController extends AdminController
{

    /**
     * 获取select下拉菜单商户列表
     * @return \Illuminate\Http\JsonResponse
     */
    public function merchantSelect() {
        $data = Merchant::select('id','m_name as text')->get();
        return response()->json($data);
    }

    /**
     * 获取select下拉菜单分类列表
     * @return \Illuminate\Http\JsonResponse
     */
    public function categorySelect(Request $request) {
        $parent_id = $request->get('q',0);
//        dd($parent_id);
        $data = Category::select('id','c_name as text')->where('c_parent_id',$parent_id)->get();
        return response()->json($data);
    }

    public function attributeSelect(Request $request) {
        $cate_id = $request->get('q');
        $data = AttributeKey::select('id','attribute_name as text')->where('category_id',$cate_id)->get();
        return response()->json($data);
    }


}