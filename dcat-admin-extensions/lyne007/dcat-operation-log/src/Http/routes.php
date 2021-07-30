<?php

use Lyne007\DcatOperationLog\Http\Controllers;
use Illuminate\Support\Facades\Route;

Route::get('auth/operation-logs', Controllers\DcatOperationLogController::class.'@index')->name('dcat-admin.operation-log.index');
Route::delete('auth/operation-logs/{id}', Controllers\DcatOperationLogController::class.'@destroy')->name('dcat-admin.operation-log.destroy');
