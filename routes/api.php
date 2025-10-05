<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::prefix('')->middleware(['auth:api'])->namespace('App\Http\Controllers\Api\Admin')->group(function () {
    /**Inicio das rotas do role */
    Route::prefix('admin')->group(function () {
        /**Rotas base do crud de role */

        //Rota de listar
        Route::get('index', ['as' => 'api.role.index', 'uses' => 'RoleController@index']);
        //Rota de pegar dados para cadastrar
        Route::get('create', ['as' => 'api.role.create', 'uses' => 'RoleController@create']);
        //Rota de cadastrar
        Route::post('store', ['as' => 'api.role.store', 'uses' => 'RoleController@store']);
        //Rota de actualizar
        Route::post('update/{id}', ['as' => 'api.role.update', 'uses' => 'RoleController@update']);
        //Rota para recuperar os dados do role
        Route::get('show/{id}', ['as' => 'api.role.show', 'uses' => 'RoleController@show']);
        //Rota de marcar como eliminado
        Route::get('destroy/{id}', ['as' => 'api.role.destroy', 'uses' => 'RoleController@destroy']);
        //Rota de eliminar
        Route::get('purge/{id}', ['as' => 'api.role.purge', 'uses' => 'RoleController@purge']);
        //Rota de visualizar os registros eliminados
        Route::get('trashed', ['as' => 'api.role.trashed', 'uses' => 'RoleController@trashed']);
        //Rota de restaurar o registro eliminado
        Route::get('restore/{id}', ['as' => 'api.role.restore', 'uses' => 'RoleController@restore']);
        //Rota de apagar todos os registros eliminados
        Route::get('deleteAll', ['as' => 'api.role.deleteAll', 'uses' => 'RoleController@deleteAll']);
        //Rota de restaurar todos os registros eliminados
        Route::get('restoreAll', ['as' => 'api.role.restoreAll', 'uses' => 'RoleController@restoreAll']);

        /**Fim das rotas base do crud de role */

        /**Rotas específicas do role */
        //Rota para listar role_permissions
        Route::get('role_permissions/{id}', ['as' => 'api.role.role_permissions', 'uses' => 'RoleController@fk_role_permissions']);
        //Rota para listar user
        Route::get('user/{id}', ['as' => 'api.role.user', 'uses' => 'RoleController@fk_user']);
        /**Fim das rotas específicas do role */
    });
    /**Fim das rotas do role */ /**Inicio das rotas do group */
    Route::prefix('admin')->group(function () {
        /**Rotas base do crud de group */

        //Rota de listar
        Route::get('index', ['as' => 'api.group.index', 'uses' => 'GroupController@index']);
        //Rota de pegar dados para cadastrar
        Route::get('create', ['as' => 'api.group.create', 'uses' => 'GroupController@create']);
        //Rota de cadastrar
        Route::post('store', ['as' => 'api.group.store', 'uses' => 'GroupController@store']);
        //Rota de actualizar
        Route::post('update/{id}', ['as' => 'api.group.update', 'uses' => 'GroupController@update']);
        //Rota para recuperar os dados do group
        Route::get('show/{id}', ['as' => 'api.group.show', 'uses' => 'GroupController@show']);
        //Rota de marcar como eliminado
        Route::get('destroy/{id}', ['as' => 'api.group.destroy', 'uses' => 'GroupController@destroy']);
        //Rota de eliminar
        Route::get('purge/{id}', ['as' => 'api.group.purge', 'uses' => 'GroupController@purge']);
        //Rota de visualizar os registros eliminados
        Route::get('trashed', ['as' => 'api.group.trashed', 'uses' => 'GroupController@trashed']);
        //Rota de restaurar o registro eliminado
        Route::get('restore/{id}', ['as' => 'api.group.restore', 'uses' => 'GroupController@restore']);
        //Rota de apagar todos os registros eliminados
        Route::get('deleteAll', ['as' => 'api.group.deleteAll', 'uses' => 'GroupController@deleteAll']);
        //Rota de restaurar todos os registros eliminados
        Route::get('restoreAll', ['as' => 'api.group.restoreAll', 'uses' => 'GroupController@restoreAll']);

        /**Fim das rotas base do crud de group */

        /**Rotas específicas do group */
        //Rota para listar module
        Route::get('module/{id}', ['as' => 'api.group.module', 'uses' => 'GroupController@fk_module']);
        /**Fim das rotas específicas do group */
    });
    /**Fim das rotas do group */ /**Inicio das rotas do module */
    Route::prefix('admin')->group(function () {
        /**Rotas base do crud de module */

        //Rota de listar
        Route::get('index', ['as' => 'api.module.index', 'uses' => 'ModuleController@index']);
        //Rota de pegar dados para cadastrar
        Route::get('create', ['as' => 'api.module.create', 'uses' => 'ModuleController@create']);
        //Rota de cadastrar
        Route::post('store', ['as' => 'api.module.store', 'uses' => 'ModuleController@store']);
        //Rota de actualizar
        Route::post('update/{id}', ['as' => 'api.module.update', 'uses' => 'ModuleController@update']);
        //Rota para recuperar os dados do module
        Route::get('show/{id}', ['as' => 'api.module.show', 'uses' => 'ModuleController@show']);
        //Rota de marcar como eliminado
        Route::get('destroy/{id}', ['as' => 'api.module.destroy', 'uses' => 'ModuleController@destroy']);
        //Rota de eliminar
        Route::get('purge/{id}', ['as' => 'api.module.purge', 'uses' => 'ModuleController@purge']);
        //Rota de visualizar os registros eliminados
        Route::get('trashed', ['as' => 'api.module.trashed', 'uses' => 'ModuleController@trashed']);
        //Rota de restaurar o registro eliminado
        Route::get('restore/{id}', ['as' => 'api.module.restore', 'uses' => 'ModuleController@restore']);
        //Rota de apagar todos os registros eliminados
        Route::get('deleteAll', ['as' => 'api.module.deleteAll', 'uses' => 'ModuleController@deleteAll']);
        //Rota de restaurar todos os registros eliminados
        Route::get('restoreAll', ['as' => 'api.module.restoreAll', 'uses' => 'ModuleController@restoreAll']);

        /**Fim das rotas base do crud de module */

        /**Rotas específicas do module */
        //Rota para listar role_permissions
        Route::get('role_permissions/{id}', ['as' => 'api.module.role_permissions', 'uses' => 'ModuleController@fk_role_permissions']);
        //Rota para listar group
        Route::get('group/{id}', ['as' => 'api.module.group', 'uses' => 'ModuleController@fk_group']);
        /**Fim das rotas específicas do module */
    });
    /**Fim das rotas do module */ /**Inicio das rotas do role_permissions */
    Route::prefix('admin')->group(function () {
        /**Rotas base do crud de role_permissions */

        //Rota de listar
        Route::get('index', ['as' => 'api.role_permissions.index', 'uses' => 'RolePermissionsController@index']);
        //Rota de pegar dados para cadastrar
        Route::get('create', ['as' => 'api.role_permissions.create', 'uses' => 'RolePermissionsController@create']);
        //Rota de cadastrar
        Route::post('store', ['as' => 'api.role_permissions.store', 'uses' => 'RolePermissionsController@store']);
        //Rota de actualizar
        Route::post('update/{id}', ['as' => 'api.role_permissions.update', 'uses' => 'RolePermissionsController@update']);
        //Rota para recuperar os dados do role_permissions
        Route::get('show/{id}', ['as' => 'api.role_permissions.show', 'uses' => 'RolePermissionsController@show']);
        //Rota de marcar como eliminado
        Route::get('destroy/{id}', ['as' => 'api.role_permissions.destroy', 'uses' => 'RolePermissionsController@destroy']);
        //Rota de eliminar
        Route::get('purge/{id}', ['as' => 'api.role_permissions.purge', 'uses' => 'RolePermissionsController@purge']);
        //Rota de visualizar os registros eliminados
        Route::get('trashed', ['as' => 'api.role_permissions.trashed', 'uses' => 'RolePermissionsController@trashed']);
        //Rota de restaurar o registro eliminado
        Route::get('restore/{id}', ['as' => 'api.role_permissions.restore', 'uses' => 'RolePermissionsController@restore']);
        //Rota de apagar todos os registros eliminados
        Route::get('deleteAll', ['as' => 'api.role_permissions.deleteAll', 'uses' => 'RolePermissionsController@deleteAll']);
        //Rota de restaurar todos os registros eliminados
        Route::get('restoreAll', ['as' => 'api.role_permissions.restoreAll', 'uses' => 'RolePermissionsController@restoreAll']);

        /**Fim das rotas base do crud de role_permissions */

        /**Rotas específicas do role_permissions */
        //Rota para listar role
        Route::get('role/{id}', ['as' => 'api.role_permissions.role', 'uses' => 'RolePermissionsController@fk_role']);
        //Rota para listar module
        Route::get('module/{id}', ['as' => 'api.role_permissions.module', 'uses' => 'RolePermissionsController@fk_module']);
        /**Fim das rotas específicas do role_permissions */
    });
    /**Fim das rotas do role_permissions */ /**Inicio das rotas do user */
    Route::prefix('admin')->group(function () {
        /**Rotas base do crud de user */

        //Rota de listar
        Route::get('index', ['as' => 'api.user.index', 'uses' => 'UserController@index']);
        //Rota de pegar dados para cadastrar
        Route::get('create', ['as' => 'api.user.create', 'uses' => 'UserController@create']);
        //Rota de cadastrar
        Route::post('store', ['as' => 'api.user.store', 'uses' => 'UserController@store']);
        //Rota de actualizar
        Route::post('update/{id}', ['as' => 'api.user.update', 'uses' => 'UserController@update']);
        //Rota para recuperar os dados do user
        Route::get('show/{id}', ['as' => 'api.user.show', 'uses' => 'UserController@show']);
        //Rota de marcar como eliminado
        Route::get('destroy/{id}', ['as' => 'api.user.destroy', 'uses' => 'UserController@destroy']);
        //Rota de eliminar
        Route::get('purge/{id}', ['as' => 'api.user.purge', 'uses' => 'UserController@purge']);
        //Rota de visualizar os registros eliminados
        Route::get('trashed', ['as' => 'api.user.trashed', 'uses' => 'UserController@trashed']);
        //Rota de restaurar o registro eliminado
        Route::get('restore/{id}', ['as' => 'api.user.restore', 'uses' => 'UserController@restore']);
        //Rota de apagar todos os registros eliminados
        Route::get('deleteAll', ['as' => 'api.user.deleteAll', 'uses' => 'UserController@deleteAll']);
        //Rota de restaurar todos os registros eliminados
        Route::get('restoreAll', ['as' => 'api.user.restoreAll', 'uses' => 'UserController@restoreAll']);

        /**Fim das rotas base do crud de user */

        /**Rotas específicas do user */
        //Rota para listar log
        Route::get('log/{id}', ['as' => 'api.user.log', 'uses' => 'UserController@fk_log']);
        //Rota para listar role
        Route::get('role/{id}', ['as' => 'api.user.role', 'uses' => 'UserController@fk_role']);
        /**Fim das rotas específicas do user */
    });
    /**Fim das rotas do user */ /**Inicio das rotas do log */
    Route::prefix('admin')->group(function () {
        /**Rotas base do crud de log */

        //Rota de listar
        Route::get('index', ['as' => 'api.log.index', 'uses' => 'LogController@index']);
        //Rota de pegar dados para cadastrar
        Route::get('create', ['as' => 'api.log.create', 'uses' => 'LogController@create']);
        //Rota de cadastrar
        Route::post('store', ['as' => 'api.log.store', 'uses' => 'LogController@store']);
        //Rota de actualizar
        Route::post('update/{id}', ['as' => 'api.log.update', 'uses' => 'LogController@update']);
        //Rota para recuperar os dados do log
        Route::get('show/{id}', ['as' => 'api.log.show', 'uses' => 'LogController@show']);
        //Rota de marcar como eliminado
        Route::get('destroy/{id}', ['as' => 'api.log.destroy', 'uses' => 'LogController@destroy']);
        //Rota de eliminar
        Route::get('purge/{id}', ['as' => 'api.log.purge', 'uses' => 'LogController@purge']);
        //Rota de visualizar os registros eliminados
        Route::get('trashed', ['as' => 'api.log.trashed', 'uses' => 'LogController@trashed']);
        //Rota de restaurar o registro eliminado
        Route::get('restore/{id}', ['as' => 'api.log.restore', 'uses' => 'LogController@restore']);
        //Rota de apagar todos os registros eliminados
        Route::get('deleteAll', ['as' => 'api.log.deleteAll', 'uses' => 'LogController@deleteAll']);
        //Rota de restaurar todos os registros eliminados
        Route::get('restoreAll', ['as' => 'api.log.restoreAll', 'uses' => 'LogController@restoreAll']);

        /**Fim das rotas base do crud de log */

        /**Rotas específicas do log */
        //Rota para listar user
        Route::get('user/{id}', ['as' => 'api.log.user', 'uses' => 'LogController@fk_user']);
        //Rota para listar booking
        Route::get('booking/{id}', ['as' => 'api.log.booking', 'uses' => 'LogController@fk_booking']);
        //Rota para listar step
        Route::get('step/{id}', ['as' => 'api.log.step', 'uses' => 'LogController@fk_step']);
        /**Fim das rotas específicas do log */
    });
    /**Fim das rotas do log */ /**Inicio das rotas do email_provider */
    Route::prefix('admin')->group(function () {
        /**Rotas base do crud de email_provider */

        //Rota de listar
        Route::get('index', ['as' => 'api.email_provider.index', 'uses' => 'EmailProviderController@index']);
        //Rota de pegar dados para cadastrar
        Route::get('create', ['as' => 'api.email_provider.create', 'uses' => 'EmailProviderController@create']);
        //Rota de cadastrar
        Route::post('store', ['as' => 'api.email_provider.store', 'uses' => 'EmailProviderController@store']);
        //Rota de actualizar
        Route::post('update/{id}', ['as' => 'api.email_provider.update', 'uses' => 'EmailProviderController@update']);
        //Rota para recuperar os dados do email_provider
        Route::get('show/{id}', ['as' => 'api.email_provider.show', 'uses' => 'EmailProviderController@show']);
        //Rota de marcar como eliminado
        Route::get('destroy/{id}', ['as' => 'api.email_provider.destroy', 'uses' => 'EmailProviderController@destroy']);
        //Rota de eliminar
        Route::get('purge/{id}', ['as' => 'api.email_provider.purge', 'uses' => 'EmailProviderController@purge']);
        //Rota de visualizar os registros eliminados
        Route::get('trashed', ['as' => 'api.email_provider.trashed', 'uses' => 'EmailProviderController@trashed']);
        //Rota de restaurar o registro eliminado
        Route::get('restore/{id}', ['as' => 'api.email_provider.restore', 'uses' => 'EmailProviderController@restore']);
        //Rota de apagar todos os registros eliminados
        Route::get('deleteAll', ['as' => 'api.email_provider.deleteAll', 'uses' => 'EmailProviderController@deleteAll']);
        //Rota de restaurar todos os registros eliminados
        Route::get('restoreAll', ['as' => 'api.email_provider.restoreAll', 'uses' => 'EmailProviderController@restoreAll']);

        /**Fim das rotas base do crud de email_provider */

        /**Rotas específicas do email_provider */
        //Rota para listar account
        Route::get('account/{id}', ['as' => 'api.email_provider.account', 'uses' => 'EmailProviderController@fk_account']);
        /**Fim das rotas específicas do email_provider */
    });
    /**Fim das rotas do email_provider */ /**Inicio das rotas do captcha_solver */
    Route::prefix('admin')->group(function () {
        /**Rotas base do crud de captcha_solver */

        //Rota de listar
        Route::get('index', ['as' => 'api.captcha_solver.index', 'uses' => 'CaptchaSolverController@index']);
        //Rota de pegar dados para cadastrar
        Route::get('create', ['as' => 'api.captcha_solver.create', 'uses' => 'CaptchaSolverController@create']);
        //Rota de cadastrar
        Route::post('store', ['as' => 'api.captcha_solver.store', 'uses' => 'CaptchaSolverController@store']);
        //Rota de actualizar
        Route::post('update/{id}', ['as' => 'api.captcha_solver.update', 'uses' => 'CaptchaSolverController@update']);
        //Rota para recuperar os dados do captcha_solver
        Route::get('show/{id}', ['as' => 'api.captcha_solver.show', 'uses' => 'CaptchaSolverController@show']);
        //Rota de marcar como eliminado
        Route::get('destroy/{id}', ['as' => 'api.captcha_solver.destroy', 'uses' => 'CaptchaSolverController@destroy']);
        //Rota de eliminar
        Route::get('purge/{id}', ['as' => 'api.captcha_solver.purge', 'uses' => 'CaptchaSolverController@purge']);
        //Rota de visualizar os registros eliminados
        Route::get('trashed', ['as' => 'api.captcha_solver.trashed', 'uses' => 'CaptchaSolverController@trashed']);
        //Rota de restaurar o registro eliminado
        Route::get('restore/{id}', ['as' => 'api.captcha_solver.restore', 'uses' => 'CaptchaSolverController@restore']);
        //Rota de apagar todos os registros eliminados
        Route::get('deleteAll', ['as' => 'api.captcha_solver.deleteAll', 'uses' => 'CaptchaSolverController@deleteAll']);
        //Rota de restaurar todos os registros eliminados
        Route::get('restoreAll', ['as' => 'api.captcha_solver.restoreAll', 'uses' => 'CaptchaSolverController@restoreAll']);

        /**Fim das rotas base do crud de captcha_solver */

        /**Rotas específicas do captcha_solver */
        //Rota para listar token_captcha_solver
        Route::get('token_captcha_solver/{id}', ['as' => 'api.captcha_solver.token_captcha_solver', 'uses' => 'CaptchaSolverController@fk_token_captcha_solver']);
        /**Fim das rotas específicas do captcha_solver */
    });
    /**Fim das rotas do captcha_solver */ /**Inicio das rotas do step */
    Route::prefix('admin')->group(function () {
        /**Rotas base do crud de step */

        //Rota de listar
        Route::get('index', ['as' => 'api.step.index', 'uses' => 'StepController@index']);
        //Rota de pegar dados para cadastrar
        Route::get('create', ['as' => 'api.step.create', 'uses' => 'StepController@create']);
        //Rota de cadastrar
        Route::post('store', ['as' => 'api.step.store', 'uses' => 'StepController@store']);
        //Rota de actualizar
        Route::post('update/{id}', ['as' => 'api.step.update', 'uses' => 'StepController@update']);
        //Rota para recuperar os dados do step
        Route::get('show/{id}', ['as' => 'api.step.show', 'uses' => 'StepController@show']);
        //Rota de marcar como eliminado
        Route::get('destroy/{id}', ['as' => 'api.step.destroy', 'uses' => 'StepController@destroy']);
        //Rota de eliminar
        Route::get('purge/{id}', ['as' => 'api.step.purge', 'uses' => 'StepController@purge']);
        //Rota de visualizar os registros eliminados
        Route::get('trashed', ['as' => 'api.step.trashed', 'uses' => 'StepController@trashed']);
        //Rota de restaurar o registro eliminado
        Route::get('restore/{id}', ['as' => 'api.step.restore', 'uses' => 'StepController@restore']);
        //Rota de apagar todos os registros eliminados
        Route::get('deleteAll', ['as' => 'api.step.deleteAll', 'uses' => 'StepController@deleteAll']);
        //Rota de restaurar todos os registros eliminados
        Route::get('restoreAll', ['as' => 'api.step.restoreAll', 'uses' => 'StepController@restoreAll']);

        /**Fim das rotas base do crud de step */

        /**Rotas específicas do step */
        //Rota para listar log
        Route::get('log/{id}', ['as' => 'api.step.log', 'uses' => 'StepController@fk_log']);
        /**Fim das rotas específicas do step */
    });
    /**Fim das rotas do step */ /**Inicio das rotas do token_captcha_solver */
    Route::prefix('admin')->group(function () {
        /**Rotas base do crud de token_captcha_solver */

        //Rota de listar
        Route::get('index', ['as' => 'api.token_captcha_solver.index', 'uses' => 'TokenCaptchaSolverController@index']);
        //Rota de pegar dados para cadastrar
        Route::get('create', ['as' => 'api.token_captcha_solver.create', 'uses' => 'TokenCaptchaSolverController@create']);
        //Rota de cadastrar
        Route::post('store', ['as' => 'api.token_captcha_solver.store', 'uses' => 'TokenCaptchaSolverController@store']);
        //Rota de actualizar
        Route::post('update/{id}', ['as' => 'api.token_captcha_solver.update', 'uses' => 'TokenCaptchaSolverController@update']);
        //Rota para recuperar os dados do token_captcha_solver
        Route::get('show/{id}', ['as' => 'api.token_captcha_solver.show', 'uses' => 'TokenCaptchaSolverController@show']);
        //Rota de marcar como eliminado
        Route::get('destroy/{id}', ['as' => 'api.token_captcha_solver.destroy', 'uses' => 'TokenCaptchaSolverController@destroy']);
        //Rota de eliminar
        Route::get('purge/{id}', ['as' => 'api.token_captcha_solver.purge', 'uses' => 'TokenCaptchaSolverController@purge']);
        //Rota de visualizar os registros eliminados
        Route::get('trashed', ['as' => 'api.token_captcha_solver.trashed', 'uses' => 'TokenCaptchaSolverController@trashed']);
        //Rota de restaurar o registro eliminado
        Route::get('restore/{id}', ['as' => 'api.token_captcha_solver.restore', 'uses' => 'TokenCaptchaSolverController@restore']);
        //Rota de apagar todos os registros eliminados
        Route::get('deleteAll', ['as' => 'api.token_captcha_solver.deleteAll', 'uses' => 'TokenCaptchaSolverController@deleteAll']);
        //Rota de restaurar todos os registros eliminados
        Route::get('restoreAll', ['as' => 'api.token_captcha_solver.restoreAll', 'uses' => 'TokenCaptchaSolverController@restoreAll']);

        /**Fim das rotas base do crud de token_captcha_solver */

        /**Rotas específicas do token_captcha_solver */
        //Rota para listar captcha_solver
        Route::get('captcha_solver/{id}', ['as' => 'api.token_captcha_solver.captcha_solver', 'uses' => 'TokenCaptchaSolverController@fk_captcha_solver']);
        /**Fim das rotas específicas do token_captcha_solver */
    });
    /**Fim das rotas do token_captcha_solver */ /**Inicio das rotas do account */
    Route::prefix('admin')->group(function () {
        /**Rotas base do crud de account */

        //Rota de listar
        Route::get('index', ['as' => 'api.account.index', 'uses' => 'AccountController@index']);
        //Rota de pegar dados para cadastrar
        Route::get('create', ['as' => 'api.account.create', 'uses' => 'AccountController@create']);
        //Rota de cadastrar
        Route::post('store', ['as' => 'api.account.store', 'uses' => 'AccountController@store']);
        //Rota de actualizar
        Route::post('update/{id}', ['as' => 'api.account.update', 'uses' => 'AccountController@update']);
        //Rota para recuperar os dados do account
        Route::get('show/{id}', ['as' => 'api.account.show', 'uses' => 'AccountController@show']);
        //Rota de marcar como eliminado
        Route::get('destroy/{id}', ['as' => 'api.account.destroy', 'uses' => 'AccountController@destroy']);
        //Rota de eliminar
        Route::get('purge/{id}', ['as' => 'api.account.purge', 'uses' => 'AccountController@purge']);
        //Rota de visualizar os registros eliminados
        Route::get('trashed', ['as' => 'api.account.trashed', 'uses' => 'AccountController@trashed']);
        //Rota de restaurar o registro eliminado
        Route::get('restore/{id}', ['as' => 'api.account.restore', 'uses' => 'AccountController@restore']);
        //Rota de apagar todos os registros eliminados
        Route::get('deleteAll', ['as' => 'api.account.deleteAll', 'uses' => 'AccountController@deleteAll']);
        //Rota de restaurar todos os registros eliminados
        Route::get('restoreAll', ['as' => 'api.account.restoreAll', 'uses' => 'AccountController@restoreAll']);

        /**Fim das rotas base do crud de account */

        /**Rotas específicas do account */
        //Rota para listar booking
        Route::get('booking/{id}', ['as' => 'api.account.booking', 'uses' => 'AccountController@fk_booking']);
        //Rota para listar email_provider
        Route::get('email_provider/{id}', ['as' => 'api.account.email_provider', 'uses' => 'AccountController@fk_email_provider']);
        /**Fim das rotas específicas do account */
    });
    /**Fim das rotas do account */ /**Inicio das rotas do application_center */
    Route::prefix('admin')->group(function () {
        /**Rotas base do crud de application_center */

        //Rota de listar
        Route::get('index', ['as' => 'api.application_center.index', 'uses' => 'ApplicationCenterController@index']);
        //Rota de pegar dados para cadastrar
        Route::get('create', ['as' => 'api.application_center.create', 'uses' => 'ApplicationCenterController@create']);
        //Rota de cadastrar
        Route::post('store', ['as' => 'api.application_center.store', 'uses' => 'ApplicationCenterController@store']);
        //Rota de actualizar
        Route::post('update/{id}', ['as' => 'api.application_center.update', 'uses' => 'ApplicationCenterController@update']);
        //Rota para recuperar os dados do application_center
        Route::get('show/{id}', ['as' => 'api.application_center.show', 'uses' => 'ApplicationCenterController@show']);
        //Rota de marcar como eliminado
        Route::get('destroy/{id}', ['as' => 'api.application_center.destroy', 'uses' => 'ApplicationCenterController@destroy']);
        //Rota de eliminar
        Route::get('purge/{id}', ['as' => 'api.application_center.purge', 'uses' => 'ApplicationCenterController@purge']);
        //Rota de visualizar os registros eliminados
        Route::get('trashed', ['as' => 'api.application_center.trashed', 'uses' => 'ApplicationCenterController@trashed']);
        //Rota de restaurar o registro eliminado
        Route::get('restore/{id}', ['as' => 'api.application_center.restore', 'uses' => 'ApplicationCenterController@restore']);
        //Rota de apagar todos os registros eliminados
        Route::get('deleteAll', ['as' => 'api.application_center.deleteAll', 'uses' => 'ApplicationCenterController@deleteAll']);
        //Rota de restaurar todos os registros eliminados
        Route::get('restoreAll', ['as' => 'api.application_center.restoreAll', 'uses' => 'ApplicationCenterController@restoreAll']);

        /**Fim das rotas base do crud de application_center */

        /**Rotas específicas do application_center */
        //Rota para listar booking
        Route::get('booking/{id}', ['as' => 'api.application_center.booking', 'uses' => 'ApplicationCenterController@fk_booking']);
        /**Fim das rotas específicas do application_center */
    });
    /**Fim das rotas do application_center */ /**Inicio das rotas do categories_application */
    Route::prefix('admin')->group(function () {
        /**Rotas base do crud de categories_application */

        //Rota de listar
        Route::get('index', ['as' => 'api.categories_application.index', 'uses' => 'CategoriesApplicationController@index']);
        //Rota de pegar dados para cadastrar
        Route::get('create', ['as' => 'api.categories_application.create', 'uses' => 'CategoriesApplicationController@create']);
        //Rota de cadastrar
        Route::post('store', ['as' => 'api.categories_application.store', 'uses' => 'CategoriesApplicationController@store']);
        //Rota de actualizar
        Route::post('update/{id}', ['as' => 'api.categories_application.update', 'uses' => 'CategoriesApplicationController@update']);
        //Rota para recuperar os dados do categories_application
        Route::get('show/{id}', ['as' => 'api.categories_application.show', 'uses' => 'CategoriesApplicationController@show']);
        //Rota de marcar como eliminado
        Route::get('destroy/{id}', ['as' => 'api.categories_application.destroy', 'uses' => 'CategoriesApplicationController@destroy']);
        //Rota de eliminar
        Route::get('purge/{id}', ['as' => 'api.categories_application.purge', 'uses' => 'CategoriesApplicationController@purge']);
        //Rota de visualizar os registros eliminados
        Route::get('trashed', ['as' => 'api.categories_application.trashed', 'uses' => 'CategoriesApplicationController@trashed']);
        //Rota de restaurar o registro eliminado
        Route::get('restore/{id}', ['as' => 'api.categories_application.restore', 'uses' => 'CategoriesApplicationController@restore']);
        //Rota de apagar todos os registros eliminados
        Route::get('deleteAll', ['as' => 'api.categories_application.deleteAll', 'uses' => 'CategoriesApplicationController@deleteAll']);
        //Rota de restaurar todos os registros eliminados
        Route::get('restoreAll', ['as' => 'api.categories_application.restoreAll', 'uses' => 'CategoriesApplicationController@restoreAll']);

        /**Fim das rotas base do crud de categories_application */

        /**Rotas específicas do categories_application */
        //Rota para listar categories_application
        Route::get('categories_application/{id}', ['as' => 'api.categories_application.categories_application', 'uses' => 'CategoriesApplicationController@fk_categories_application']);
        //Rota para listar booking
        Route::get('booking/{id}', ['as' => 'api.categories_application.booking', 'uses' => 'CategoriesApplicationController@fk_booking']);
        //Rota para listar booking
        Route::get('booking/{id}', ['as' => 'api.categories_application.booking', 'uses' => 'CategoriesApplicationController@fk_booking']);
        //Rota para listar categories_application
        Route::get('categories_application/{id}', ['as' => 'api.categories_application.categories_application', 'uses' => 'CategoriesApplicationController@fk_categories_application']);
        /**Fim das rotas específicas do categories_application */
    });
    /**Fim das rotas do categories_application */ /**Inicio das rotas do payment_method */
    Route::prefix('admin')->group(function () {
        /**Rotas base do crud de payment_method */

        //Rota de listar
        Route::get('index', ['as' => 'api.payment_method.index', 'uses' => 'PaymentMethodController@index']);
        //Rota de pegar dados para cadastrar
        Route::get('create', ['as' => 'api.payment_method.create', 'uses' => 'PaymentMethodController@create']);
        //Rota de cadastrar
        Route::post('store', ['as' => 'api.payment_method.store', 'uses' => 'PaymentMethodController@store']);
        //Rota de actualizar
        Route::post('update/{id}', ['as' => 'api.payment_method.update', 'uses' => 'PaymentMethodController@update']);
        //Rota para recuperar os dados do payment_method
        Route::get('show/{id}', ['as' => 'api.payment_method.show', 'uses' => 'PaymentMethodController@show']);
        //Rota de marcar como eliminado
        Route::get('destroy/{id}', ['as' => 'api.payment_method.destroy', 'uses' => 'PaymentMethodController@destroy']);
        //Rota de eliminar
        Route::get('purge/{id}', ['as' => 'api.payment_method.purge', 'uses' => 'PaymentMethodController@purge']);
        //Rota de visualizar os registros eliminados
        Route::get('trashed', ['as' => 'api.payment_method.trashed', 'uses' => 'PaymentMethodController@trashed']);
        //Rota de restaurar o registro eliminado
        Route::get('restore/{id}', ['as' => 'api.payment_method.restore', 'uses' => 'PaymentMethodController@restore']);
        //Rota de apagar todos os registros eliminados
        Route::get('deleteAll', ['as' => 'api.payment_method.deleteAll', 'uses' => 'PaymentMethodController@deleteAll']);
        //Rota de restaurar todos os registros eliminados
        Route::get('restoreAll', ['as' => 'api.payment_method.restoreAll', 'uses' => 'PaymentMethodController@restoreAll']);

        /**Fim das rotas base do crud de payment_method */

        /**Rotas específicas do payment_method */
        //Rota para listar booking
        Route::get('booking/{id}', ['as' => 'api.payment_method.booking', 'uses' => 'PaymentMethodController@fk_booking']);
        /**Fim das rotas específicas do payment_method */
    });
    /**Fim das rotas do payment_method */ /**Inicio das rotas do booking_slot */
    Route::prefix('admin')->group(function () {
        /**Rotas base do crud de booking_slot */

        //Rota de listar
        Route::get('index', ['as' => 'api.booking_slot.index', 'uses' => 'BookingSlotController@index']);
        //Rota de pegar dados para cadastrar
        Route::get('create', ['as' => 'api.booking_slot.create', 'uses' => 'BookingSlotController@create']);
        //Rota de cadastrar
        Route::post('store', ['as' => 'api.booking_slot.store', 'uses' => 'BookingSlotController@store']);
        //Rota de actualizar
        Route::post('update/{id}', ['as' => 'api.booking_slot.update', 'uses' => 'BookingSlotController@update']);
        //Rota para recuperar os dados do booking_slot
        Route::get('show/{id}', ['as' => 'api.booking_slot.show', 'uses' => 'BookingSlotController@show']);
        //Rota de marcar como eliminado
        Route::get('destroy/{id}', ['as' => 'api.booking_slot.destroy', 'uses' => 'BookingSlotController@destroy']);
        //Rota de eliminar
        Route::get('purge/{id}', ['as' => 'api.booking_slot.purge', 'uses' => 'BookingSlotController@purge']);
        //Rota de visualizar os registros eliminados
        Route::get('trashed', ['as' => 'api.booking_slot.trashed', 'uses' => 'BookingSlotController@trashed']);
        //Rota de restaurar o registro eliminado
        Route::get('restore/{id}', ['as' => 'api.booking_slot.restore', 'uses' => 'BookingSlotController@restore']);
        //Rota de apagar todos os registros eliminados
        Route::get('deleteAll', ['as' => 'api.booking_slot.deleteAll', 'uses' => 'BookingSlotController@deleteAll']);
        //Rota de restaurar todos os registros eliminados
        Route::get('restoreAll', ['as' => 'api.booking_slot.restoreAll', 'uses' => 'BookingSlotController@restoreAll']);

        /**Fim das rotas base do crud de booking_slot */

        /**Rotas específicas do booking_slot */
        //Rota para listar booking
        Route::get('booking/{id}', ['as' => 'api.booking_slot.booking', 'uses' => 'BookingSlotController@fk_booking']);
        /**Fim das rotas específicas do booking_slot */
    });
    /**Fim das rotas do booking_slot */ /**Inicio das rotas do booking */
    Route::prefix('admin')->group(function () {
        /**Rotas base do crud de booking */

        //Rota de listar
        Route::get('index', ['as' => 'api.booking.index', 'uses' => 'BookingController@index']);
        //Rota de pegar dados para cadastrar
        Route::get('create', ['as' => 'api.booking.create', 'uses' => 'BookingController@create']);
        //Rota de cadastrar
        Route::post('store', ['as' => 'api.booking.store', 'uses' => 'BookingController@store']);
        //Rota de actualizar
        Route::post('update/{id}', ['as' => 'api.booking.update', 'uses' => 'BookingController@update']);
        //Rota para recuperar os dados do booking
        Route::get('show/{id}', ['as' => 'api.booking.show', 'uses' => 'BookingController@show']);
        //Rota de marcar como eliminado
        Route::get('destroy/{id}', ['as' => 'api.booking.destroy', 'uses' => 'BookingController@destroy']);
        //Rota de eliminar
        Route::get('purge/{id}', ['as' => 'api.booking.purge', 'uses' => 'BookingController@purge']);
        //Rota de visualizar os registros eliminados
        Route::get('trashed', ['as' => 'api.booking.trashed', 'uses' => 'BookingController@trashed']);
        //Rota de restaurar o registro eliminado
        Route::get('restore/{id}', ['as' => 'api.booking.restore', 'uses' => 'BookingController@restore']);
        //Rota de apagar todos os registros eliminados
        Route::get('deleteAll', ['as' => 'api.booking.deleteAll', 'uses' => 'BookingController@deleteAll']);
        //Rota de restaurar todos os registros eliminados
        Route::get('restoreAll', ['as' => 'api.booking.restoreAll', 'uses' => 'BookingController@restoreAll']);

        /**Fim das rotas base do crud de booking */

        /**Rotas específicas do booking */
        //Rota para listar otp
        Route::get('otp/{id}', ['as' => 'api.booking.otp', 'uses' => 'BookingController@fk_otp']);
        //Rota para listar applicant
        Route::get('applicant/{id}', ['as' => 'api.booking.applicant', 'uses' => 'BookingController@fk_applicant']);
        //Rota para listar applicant_video
        Route::get('applicant_video/{id}', ['as' => 'api.booking.applicant_video', 'uses' => 'BookingController@fk_applicant_video']);
        //Rota para listar log
        Route::get('log/{id}', ['as' => 'api.booking.log', 'uses' => 'BookingController@fk_log']);
        //Rota para listar applicant
        Route::get('applicant/{id}', ['as' => 'api.booking.applicant', 'uses' => 'BookingController@fk_applicant']);
        //Rota para listar account
        Route::get('account/{id}', ['as' => 'api.booking.account', 'uses' => 'BookingController@fk_account']);
        //Rota para listar application_center
        Route::get('application_center/{id}', ['as' => 'api.booking.application_center', 'uses' => 'BookingController@fk_application_center']);
        //Rota para listar categories_application
        Route::get('categories_application/{id}', ['as' => 'api.booking.categories_application', 'uses' => 'BookingController@fk_categories_application']);
        //Rota para listar categories_application
        Route::get('categories_application/{id}', ['as' => 'api.booking.categories_application', 'uses' => 'BookingController@fk_categories_application']);
        //Rota para listar payment_method
        Route::get('payment_method/{id}', ['as' => 'api.booking.payment_method', 'uses' => 'BookingController@fk_payment_method']);
        //Rota para listar booking_slot
        Route::get('booking_slot/{id}', ['as' => 'api.booking.booking_slot', 'uses' => 'BookingController@fk_booking_slot']);
        /**Fim das rotas específicas do booking */
    });
    /**Fim das rotas do booking */ /**Inicio das rotas do otp */
    Route::prefix('admin')->group(function () {
        /**Rotas base do crud de otp */

        //Rota de listar
        Route::get('index', ['as' => 'api.otp.index', 'uses' => 'OTPController@index']);
        //Rota de pegar dados para cadastrar
        Route::get('create', ['as' => 'api.otp.create', 'uses' => 'OTPController@create']);
        //Rota de cadastrar
        Route::post('store', ['as' => 'api.otp.store', 'uses' => 'OTPController@store']);
        //Rota de actualizar
        Route::post('update/{id}', ['as' => 'api.otp.update', 'uses' => 'OTPController@update']);
        //Rota para recuperar os dados do otp
        Route::get('show/{id}', ['as' => 'api.otp.show', 'uses' => 'OTPController@show']);
        //Rota de marcar como eliminado
        Route::get('destroy/{id}', ['as' => 'api.otp.destroy', 'uses' => 'OTPController@destroy']);
        //Rota de eliminar
        Route::get('purge/{id}', ['as' => 'api.otp.purge', 'uses' => 'OTPController@purge']);
        //Rota de visualizar os registros eliminados
        Route::get('trashed', ['as' => 'api.otp.trashed', 'uses' => 'OTPController@trashed']);
        //Rota de restaurar o registro eliminado
        Route::get('restore/{id}', ['as' => 'api.otp.restore', 'uses' => 'OTPController@restore']);
        //Rota de apagar todos os registros eliminados
        Route::get('deleteAll', ['as' => 'api.otp.deleteAll', 'uses' => 'OTPController@deleteAll']);
        //Rota de restaurar todos os registros eliminados
        Route::get('restoreAll', ['as' => 'api.otp.restoreAll', 'uses' => 'OTPController@restoreAll']);

        /**Fim das rotas base do crud de otp */

        /**Rotas específicas do otp */
        //Rota para listar booking
        Route::get('booking/{id}', ['as' => 'api.otp.booking', 'uses' => 'OTPController@fk_booking']);
        /**Fim das rotas específicas do otp */
    });
    /**Fim das rotas do otp */ /**Inicio das rotas do applicant */
    Route::prefix('admin')->group(function () {
        /**Rotas base do crud de applicant */

        //Rota de listar
        Route::get('index', ['as' => 'api.applicant.index', 'uses' => 'ApplicantController@index']);
        //Rota de pegar dados para cadastrar
        Route::get('create', ['as' => 'api.applicant.create', 'uses' => 'ApplicantController@create']);
        //Rota de cadastrar
        Route::post('store', ['as' => 'api.applicant.store', 'uses' => 'ApplicantController@store']);
        //Rota de actualizar
        Route::post('update/{id}', ['as' => 'api.applicant.update', 'uses' => 'ApplicantController@update']);
        //Rota para recuperar os dados do applicant
        Route::get('show/{id}', ['as' => 'api.applicant.show', 'uses' => 'ApplicantController@show']);
        //Rota de marcar como eliminado
        Route::get('destroy/{id}', ['as' => 'api.applicant.destroy', 'uses' => 'ApplicantController@destroy']);
        //Rota de eliminar
        Route::get('purge/{id}', ['as' => 'api.applicant.purge', 'uses' => 'ApplicantController@purge']);
        //Rota de visualizar os registros eliminados
        Route::get('trashed', ['as' => 'api.applicant.trashed', 'uses' => 'ApplicantController@trashed']);
        //Rota de restaurar o registro eliminado
        Route::get('restore/{id}', ['as' => 'api.applicant.restore', 'uses' => 'ApplicantController@restore']);
        //Rota de apagar todos os registros eliminados
        Route::get('deleteAll', ['as' => 'api.applicant.deleteAll', 'uses' => 'ApplicantController@deleteAll']);
        //Rota de restaurar todos os registros eliminados
        Route::get('restoreAll', ['as' => 'api.applicant.restoreAll', 'uses' => 'ApplicantController@restoreAll']);

        /**Fim das rotas base do crud de applicant */

        /**Rotas específicas do applicant */
        //Rota para listar applicant_video
        Route::get('applicant_video/{id}', ['as' => 'api.applicant.applicant_video', 'uses' => 'ApplicantController@fk_applicant_video']);
        //Rota para listar booking
        Route::get('booking/{id}', ['as' => 'api.applicant.booking', 'uses' => 'ApplicantController@fk_booking']);
        /**Fim das rotas específicas do applicant */
    });
    /**Fim das rotas do applicant */ /**Inicio das rotas do applicant_video */
    Route::prefix('admin')->group(function () {
        /**Rotas base do crud de applicant_video */

        //Rota de listar
        Route::get('index', ['as' => 'api.applicant_video.index', 'uses' => 'ApplicantVideoController@index']);
        //Rota de pegar dados para cadastrar
        Route::get('create', ['as' => 'api.applicant_video.create', 'uses' => 'ApplicantVideoController@create']);
        //Rota de cadastrar
        Route::post('store', ['as' => 'api.applicant_video.store', 'uses' => 'ApplicantVideoController@store']);
        //Rota de actualizar
        Route::post('update/{id}', ['as' => 'api.applicant_video.update', 'uses' => 'ApplicantVideoController@update']);
        //Rota para recuperar os dados do applicant_video
        Route::get('show/{id}', ['as' => 'api.applicant_video.show', 'uses' => 'ApplicantVideoController@show']);
        //Rota de marcar como eliminado
        Route::get('destroy/{id}', ['as' => 'api.applicant_video.destroy', 'uses' => 'ApplicantVideoController@destroy']);
        //Rota de eliminar
        Route::get('purge/{id}', ['as' => 'api.applicant_video.purge', 'uses' => 'ApplicantVideoController@purge']);
        //Rota de visualizar os registros eliminados
        Route::get('trashed', ['as' => 'api.applicant_video.trashed', 'uses' => 'ApplicantVideoController@trashed']);
        //Rota de restaurar o registro eliminado
        Route::get('restore/{id}', ['as' => 'api.applicant_video.restore', 'uses' => 'ApplicantVideoController@restore']);
        //Rota de apagar todos os registros eliminados
        Route::get('deleteAll', ['as' => 'api.applicant_video.deleteAll', 'uses' => 'ApplicantVideoController@deleteAll']);
        //Rota de restaurar todos os registros eliminados
        Route::get('restoreAll', ['as' => 'api.applicant_video.restoreAll', 'uses' => 'ApplicantVideoController@restoreAll']);

        /**Fim das rotas base do crud de applicant_video */

        /**Rotas específicas do applicant_video */
        //Rota para listar applicant
        Route::get('applicant/{id}', ['as' => 'api.applicant_video.applicant', 'uses' => 'ApplicantVideoController@fk_applicant']);
        //Rota para listar booking
        Route::get('booking/{id}', ['as' => 'api.applicant_video.booking', 'uses' => 'ApplicantVideoController@fk_booking']);
        /**Fim das rotas específicas do applicant_video */
    });
    /**Fim das rotas do applicant_video */
});
