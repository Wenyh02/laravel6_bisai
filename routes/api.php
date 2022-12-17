<?php

use Illuminate\Http\Request;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});
Route::prefix('admin')->group(function (){
    Route::post('registered','AdminController@registered');
    Route::post('login','AdminController@login');
});

/**
 * 管理员端：记分员管理
 * @author WJH
 */
Route::prefix('/admin/scorer')->group(function (){
    Route::get('/select','WjhScorerManageController@wjh_get_scorers');  // 查询所有记分员的信息
    Route::post('/modify','WjhScorerManageController@wjh_modify_scorer');  // 修改某个记分员的信息
    Route::post('/reset','WjhScorerManageController@wjh_reset_scorer');  // 重置某个记分员的密码
    Route::post('/delete','WjhScorerManageController@wjh_delete_scorer');  // 删除某个记分员
    Route::post('/create','WjhScorerManageController@wjh_create_scorer');  // 创建一个新的记分员
    Route::post('/select_by_name','WjhScorerManageController@wjh_select_by_name');  // 通过姓名对记分员进行模糊查找
    Route::get('/export','WjhScorerManageController@wjh_export');  // 记分员信息导出为excel
});

/**
 * 成绩分析端/获奖评比查看
 * @author WJH
 */
Route::prefix('/analysis')->group(function () {
    Route::post('/item', 'WjhAnalysisController@wjh_get_item');  // 查询某项目个人单项奖获奖信息
    Route::get('/item/export', 'WjhAnalysisController@wjh_export_item');  // 导出某项目个人单项奖获奖信息
    Route::post('/omnipotence', 'WjhAnalysisController@wjh_get_omnipotence');  // 查询个人全能奖获奖信息
    Route::get('/omnipotence/export', 'WjhAnalysisController@wjh_export_omnipotence');  // 查询个人全能奖获奖信息
});
