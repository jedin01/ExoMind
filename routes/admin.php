<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::prefix('admin')->namespace('App\Http\Controllers\Painel\Admin')->group(function () {
    /**Inicio das rotas do fonte */
    Route::prefix('fonte')->group(function () {
        /**Rotas base do crud de fonte */

        //Rota de listar
        Route::get('index', ['as' => 'admin.fonte.index', 'uses' => 'FonteController@index']);
        //Rota de pegar dados para cadastrar
        Route::get('create', ['as' => 'admin.fonte.create', 'uses' => 'FonteController@create']);
        //Rota de cadastrar
        Route::post('store', ['as' => 'admin.fonte.store', 'uses' => 'FonteController@store']);
        //Rota de actualizar
        Route::post('update/{id}', ['as' => 'admin.fonte.update', 'uses' => 'FonteController@update']);
        //Rota para recuperar os dados do fonte
        Route::get('show/{id}', ['as' => 'admin.fonte.show', 'uses' => 'FonteController@show']);
        //Rota de marcar como eliminado
        Route::get('destroy/{id}', ['as' => 'admin.fonte.destroy', 'uses' => 'FonteController@destroy']);
        //Rota de eliminar
        Route::get('purge/{id}', ['as' => 'admin.fonte.purge', 'uses' => 'FonteController@purge']);
        //Rota de visualizar os registros eliminados
        Route::get('trashed', ['as' => 'admin.fonte.trashed', 'uses' => 'FonteController@trashed']);
        //Rota de restaurar o registro eliminado
        Route::get('restore/{id}', ['as' => 'admin.fonte.restore', 'uses' => 'FonteController@restore']);
        //Rota de apagar todos os registros eliminados
        Route::get('deleteAll', ['as' => 'admin.fonte.deleteAll', 'uses' => 'FonteController@deleteAll']);
        //Rota de restaurar todos os registros eliminados
        Route::get('restoreAll', ['as' => 'admin.fonte.restoreAll', 'uses' => 'FonteController@restoreAll']);

        /**Fim das rotas base do crud de fonte */

        /*Inicio das rotas espécificas do crud de fonte*/
        /*Rota para listar os registros de datasets que estão relacionados a fonte   */
        Route::get('datasets/{id}', ['as' => 'admin.fonte.dataset', 'uses' => 'FonteController@datasets']);
        /**Fim das rotas espécificas do crud de fonte*/
    });
    /**Fim das rotas do fonte */ /**Inicio das rotas do categoria_modelo */
    Route::prefix('categoria_modelo')->group(function () {
        /**Rotas base do crud de categoria_modelo */

        //Rota de listar
        Route::get('index', ['as' => 'admin.categoria_modelo.index', 'uses' => 'CategoriaModeloController@index']);
        //Rota de pegar dados para cadastrar
        Route::get('create', ['as' => 'admin.categoria_modelo.create', 'uses' => 'CategoriaModeloController@create']);
        //Rota de cadastrar
        Route::post('store', ['as' => 'admin.categoria_modelo.store', 'uses' => 'CategoriaModeloController@store']);
        //Rota de actualizar
        Route::post('update/{id}', ['as' => 'admin.categoria_modelo.update', 'uses' => 'CategoriaModeloController@update']);
        //Rota para recuperar os dados do categoria_modelo
        Route::get('show/{id}', ['as' => 'admin.categoria_modelo.show', 'uses' => 'CategoriaModeloController@show']);
        //Rota de marcar como eliminado
        Route::get('destroy/{id}', ['as' => 'admin.categoria_modelo.destroy', 'uses' => 'CategoriaModeloController@destroy']);
        //Rota de eliminar
        Route::get('purge/{id}', ['as' => 'admin.categoria_modelo.purge', 'uses' => 'CategoriaModeloController@purge']);
        //Rota de visualizar os registros eliminados
        Route::get('trashed', ['as' => 'admin.categoria_modelo.trashed', 'uses' => 'CategoriaModeloController@trashed']);
        //Rota de restaurar o registro eliminado
        Route::get('restore/{id}', ['as' => 'admin.categoria_modelo.restore', 'uses' => 'CategoriaModeloController@restore']);
        //Rota de apagar todos os registros eliminados
        Route::get('deleteAll', ['as' => 'admin.categoria_modelo.deleteAll', 'uses' => 'CategoriaModeloController@deleteAll']);
        //Rota de restaurar todos os registros eliminados
        Route::get('restoreAll', ['as' => 'admin.categoria_modelo.restoreAll', 'uses' => 'CategoriaModeloController@restoreAll']);

        /**Fim das rotas base do crud de categoria_modelo */

        /*Inicio das rotas espécificas do crud de categoria_modelo*/
        /*Rota para listar os registros de hiperparametro_categoria_modelos que estão relacionados a categoria_modelo   */
        Route::get('hiperparametro_categoria_modelos/{id}', ['as' => 'admin.categoria_modelo.hiperparametro_categoria_modelo', 'uses' => 'CategoriaModeloController@hiperparametro_categoria_modelos']);
        /*Rota para listar os registros de modelos que estão relacionados a categoria_modelo   */
        Route::get('modelos/{id}', ['as' => 'admin.categoria_modelo.modelo', 'uses' => 'CategoriaModeloController@modelos']);
        /**Fim das rotas espécificas do crud de categoria_modelo*/
    });
    /**Fim das rotas do categoria_modelo */ /**Inicio das rotas do pre_processamentos */
    Route::prefix('pre_processamento')->group(function () {
        /**Rotas base do crud de pre_processamentos */

        //Rota de listar
        Route::get('index', ['as' => 'admin.pre_processamento.index', 'uses' => 'PreProcessamentosController@index']);
        //Rota de pegar dados para cadastrar
        Route::get('create', ['as' => 'admin.pre_processamento.create', 'uses' => 'PreProcessamentosController@create']);
        //Rota de cadastrar
        Route::post('store', ['as' => 'admin.pre_processamento.store', 'uses' => 'PreProcessamentosController@store']);
        //Rota de actualizar
        Route::post('update/{id}', ['as' => 'admin.pre_processamento.update', 'uses' => 'PreProcessamentosController@update']);
        //Rota para recuperar os dados do pre_processamentos
        Route::get('show/{id}', ['as' => 'admin.pre_processamento.show', 'uses' => 'PreProcessamentosController@show']);
        //Rota de marcar como eliminado
        Route::get('destroy/{id}', ['as' => 'admin.pre_processamento.destroy', 'uses' => 'PreProcessamentosController@destroy']);
        //Rota de eliminar
        Route::get('purge/{id}', ['as' => 'admin.pre_processamento.purge', 'uses' => 'PreProcessamentosController@purge']);
        //Rota de visualizar os registros eliminados
        Route::get('trashed', ['as' => 'admin.pre_processamento.trashed', 'uses' => 'PreProcessamentosController@trashed']);
        //Rota de restaurar o registro eliminado
        Route::get('restore/{id}', ['as' => 'admin.pre_processamento.restore', 'uses' => 'PreProcessamentosController@restore']);
        //Rota de apagar todos os registros eliminados
        Route::get('deleteAll', ['as' => 'admin.pre_processamento.deleteAll', 'uses' => 'PreProcessamentosController@deleteAll']);
        //Rota de restaurar todos os registros eliminados
        Route::get('restoreAll', ['as' => 'admin.pre_processamento.restoreAll', 'uses' => 'PreProcessamentosController@restoreAll']);

        /**Fim das rotas base do crud de pre_processamentos */

        /*Inicio das rotas espécificas do crud de pre_processamentos*/
        /*Rota para listar os registros de treinamento_pre_processamentos que estão relacionados a pre_processamentos   */
        Route::get('treinamento_pre_processamentos/{id}', ['as' => 'admin.pre_processamento.treinamento_pre_processamento', 'uses' => 'PreProcessamentosController@treinamento_pre_processamentos']);
        /**Fim das rotas espécificas do crud de pre_processamentos*/
    });
    /**Fim das rotas do pre_processamentos */ /**Inicio das rotas do metricas */
    Route::prefix('metrica')->group(function () {
        /**Rotas base do crud de metricas */

        //Rota de listar
        Route::get('index', ['as' => 'admin.metrica.index', 'uses' => 'MetricasController@index']);
        //Rota de pegar dados para cadastrar
        Route::get('create', ['as' => 'admin.metrica.create', 'uses' => 'MetricasController@create']);
        //Rota de cadastrar
        Route::post('store', ['as' => 'admin.metrica.store', 'uses' => 'MetricasController@store']);
        //Rota de actualizar
        Route::post('update/{id}', ['as' => 'admin.metrica.update', 'uses' => 'MetricasController@update']);
        //Rota para recuperar os dados do metricas
        Route::get('show/{id}', ['as' => 'admin.metrica.show', 'uses' => 'MetricasController@show']);
        //Rota de marcar como eliminado
        Route::get('destroy/{id}', ['as' => 'admin.metrica.destroy', 'uses' => 'MetricasController@destroy']);
        //Rota de eliminar
        Route::get('purge/{id}', ['as' => 'admin.metrica.purge', 'uses' => 'MetricasController@purge']);
        //Rota de visualizar os registros eliminados
        Route::get('trashed', ['as' => 'admin.metrica.trashed', 'uses' => 'MetricasController@trashed']);
        //Rota de restaurar o registro eliminado
        Route::get('restore/{id}', ['as' => 'admin.metrica.restore', 'uses' => 'MetricasController@restore']);
        //Rota de apagar todos os registros eliminados
        Route::get('deleteAll', ['as' => 'admin.metrica.deleteAll', 'uses' => 'MetricasController@deleteAll']);
        //Rota de restaurar todos os registros eliminados
        Route::get('restoreAll', ['as' => 'admin.metrica.restoreAll', 'uses' => 'MetricasController@restoreAll']);

        /**Fim das rotas base do crud de metricas */

        /*Inicio das rotas espécificas do crud de metricas*/
        /*Rota para listar os registros de treinamento_metricas que estão relacionados a metricas   */
        Route::get('treinamento_metricas/{id}', ['as' => 'admin.metrica.treinamento_metrica', 'uses' => 'MetricasController@treinamento_metricas']);
        /**Fim das rotas espécificas do crud de metricas*/
    });
    /**Fim das rotas do metricas */ /**Inicio das rotas do hiperparametro_categoria_modelo */
    Route::prefix('hiperparametro_categoria_modelo')->group(function () {
        /**Rotas base do crud de hiperparametro_categoria_modelo */

        //Rota de listar
        Route::get('index', ['as' => 'admin.hiperparametro_categoria_modelo.index', 'uses' => 'HiperparametroCategoriaModeloController@index']);
        //Rota de pegar dados para cadastrar
        Route::get('create', ['as' => 'admin.hiperparametro_categoria_modelo.create', 'uses' => 'HiperparametroCategoriaModeloController@create']);
        //Rota de cadastrar
        Route::post('store', ['as' => 'admin.hiperparametro_categoria_modelo.store', 'uses' => 'HiperparametroCategoriaModeloController@store']);
        //Rota de actualizar
        Route::post('update/{id}', ['as' => 'admin.hiperparametro_categoria_modelo.update', 'uses' => 'HiperparametroCategoriaModeloController@update']);
        //Rota para recuperar os dados do hiperparametro_categoria_modelo
        Route::get('show/{id}', ['as' => 'admin.hiperparametro_categoria_modelo.show', 'uses' => 'HiperparametroCategoriaModeloController@show']);
        //Rota de marcar como eliminado
        Route::get('destroy/{id}', ['as' => 'admin.hiperparametro_categoria_modelo.destroy', 'uses' => 'HiperparametroCategoriaModeloController@destroy']);
        //Rota de eliminar
        Route::get('purge/{id}', ['as' => 'admin.hiperparametro_categoria_modelo.purge', 'uses' => 'HiperparametroCategoriaModeloController@purge']);
        //Rota de visualizar os registros eliminados
        Route::get('trashed', ['as' => 'admin.hiperparametro_categoria_modelo.trashed', 'uses' => 'HiperparametroCategoriaModeloController@trashed']);
        //Rota de restaurar o registro eliminado
        Route::get('restore/{id}', ['as' => 'admin.hiperparametro_categoria_modelo.restore', 'uses' => 'HiperparametroCategoriaModeloController@restore']);
        //Rota de apagar todos os registros eliminados
        Route::get('deleteAll', ['as' => 'admin.hiperparametro_categoria_modelo.deleteAll', 'uses' => 'HiperparametroCategoriaModeloController@deleteAll']);
        //Rota de restaurar todos os registros eliminados
        Route::get('restoreAll', ['as' => 'admin.hiperparametro_categoria_modelo.restoreAll', 'uses' => 'HiperparametroCategoriaModeloController@restoreAll']);

        /**Fim das rotas base do crud de hiperparametro_categoria_modelo */

        /*Inicio das rotas espécificas do crud de hiperparametro_categoria_modelo*/
        /*Rota para listar os registros de hiperparametro_modelos que estão relacionados a hiperparametro_categoria_modelo   */
        Route::get('hiperparametro_modelos/{id}', ['as' => 'admin.hiperparametro_categoria_modelo.hiperparametro_modelo', 'uses' => 'HiperparametroCategoriaModeloController@hiperparametro_modelos']);
        /**Fim das rotas espécificas do crud de hiperparametro_categoria_modelo*/
    });
    /**Fim das rotas do hiperparametro_categoria_modelo */ /**Inicio das rotas do dataset */
    Route::prefix('dataset')->group(function () {
        /**Rotas base do crud de dataset */

        //Rota de listar
        Route::get('index', ['as' => 'admin.dataset.index', 'uses' => 'DatasetController@index']);
        //Rota de pegar dados para cadastrar
        Route::get('create', ['as' => 'admin.dataset.create', 'uses' => 'DatasetController@create']);
        //Rota de cadastrar
        Route::post('store', ['as' => 'admin.dataset.store', 'uses' => 'DatasetController@store']);
        //Rota de actualizar
        Route::post('update/{id}', ['as' => 'admin.dataset.update', 'uses' => 'DatasetController@update']);
        //Rota para recuperar os dados do dataset
        Route::get('show/{id}', ['as' => 'admin.dataset.show', 'uses' => 'DatasetController@show']);
        //Rota de marcar como eliminado
        Route::get('destroy/{id}', ['as' => 'admin.dataset.destroy', 'uses' => 'DatasetController@destroy']);
        //Rota de eliminar
        Route::get('purge/{id}', ['as' => 'admin.dataset.purge', 'uses' => 'DatasetController@purge']);
        //Rota de visualizar os registros eliminados
        Route::get('trashed', ['as' => 'admin.dataset.trashed', 'uses' => 'DatasetController@trashed']);
        //Rota de restaurar o registro eliminado
        Route::get('restore/{id}', ['as' => 'admin.dataset.restore', 'uses' => 'DatasetController@restore']);
        //Rota de apagar todos os registros eliminados
        Route::get('deleteAll', ['as' => 'admin.dataset.deleteAll', 'uses' => 'DatasetController@deleteAll']);
        //Rota de restaurar todos os registros eliminados
        Route::get('restoreAll', ['as' => 'admin.dataset.restoreAll', 'uses' => 'DatasetController@restoreAll']);

        /**Fim das rotas base do crud de dataset */

        /*Inicio das rotas espécificas do crud de dataset*/
        /*Rota para listar os registros de modelos que estão relacionados a dataset   */
        Route::get('modelos/{id}', ['as' => 'admin.dataset.modelo', 'uses' => 'DatasetController@modelos']);
        /**Fim das rotas espécificas do crud de dataset*/
    });
    /**Fim das rotas do dataset */ /**Inicio das rotas do treinamento */
    Route::prefix('treinamento')->group(function () {
        /**Rotas base do crud de treinamento */

        //Rota de listar
        Route::get('index', ['as' => 'admin.treinamento.index', 'uses' => 'TreinamentoController@index']);
        //Rota de pegar dados para cadastrar
        Route::get('create', ['as' => 'admin.treinamento.create', 'uses' => 'TreinamentoController@create']);
        //Rota de cadastrar
        Route::post('store', ['as' => 'admin.treinamento.store', 'uses' => 'TreinamentoController@store']);
        //Rota de actualizar
        Route::post('update/{id}', ['as' => 'admin.treinamento.update', 'uses' => 'TreinamentoController@update']);
        //Rota para recuperar os dados do treinamento
        Route::get('show/{id}', ['as' => 'admin.treinamento.show', 'uses' => 'TreinamentoController@show']);
        //Rota de marcar como eliminado
        Route::get('destroy/{id}', ['as' => 'admin.treinamento.destroy', 'uses' => 'TreinamentoController@destroy']);
        //Rota de eliminar
        Route::get('purge/{id}', ['as' => 'admin.treinamento.purge', 'uses' => 'TreinamentoController@purge']);
        //Rota de visualizar os registros eliminados
        Route::get('trashed', ['as' => 'admin.treinamento.trashed', 'uses' => 'TreinamentoController@trashed']);
        //Rota de restaurar o registro eliminado
        Route::get('restore/{id}', ['as' => 'admin.treinamento.restore', 'uses' => 'TreinamentoController@restore']);
        //Rota de apagar todos os registros eliminados
        Route::get('deleteAll', ['as' => 'admin.treinamento.deleteAll', 'uses' => 'TreinamentoController@deleteAll']);
        //Rota de restaurar todos os registros eliminados
        Route::get('restoreAll', ['as' => 'admin.treinamento.restoreAll', 'uses' => 'TreinamentoController@restoreAll']);

        /**Fim das rotas base do crud de treinamento */

        /*Inicio das rotas espécificas do crud de treinamento*/
        /*Rota para listar os registros de treinamento_pre_processamentos que estão relacionados a treinamento   */
        Route::get('treinamento_pre_processamentos/{id}', ['as' => 'admin.treinamento.treinamento_pre_processamento', 'uses' => 'TreinamentoController@treinamento_pre_processamentos']);
        /*Rota para listar os registros de treinamento_metricas que estão relacionados a treinamento   */
        Route::get('treinamento_metricas/{id}', ['as' => 'admin.treinamento.treinamento_metrica', 'uses' => 'TreinamentoController@treinamento_metricas']);
        /*Rota para listar os registros de modelos que estão relacionados a treinamento   */
        Route::get('modelos/{id}', ['as' => 'admin.treinamento.modelo', 'uses' => 'TreinamentoController@modelos']);
        /**Fim das rotas espécificas do crud de treinamento*/
    });
    /**Fim das rotas do treinamento */ /**Inicio das rotas do treinamento_pre_processamento */
    Route::prefix('treinamento_pre_processamento')->group(function () {
        /**Rotas base do crud de treinamento_pre_processamento */

        //Rota de listar
        Route::get('index', ['as' => 'admin.treinamento_pre_processamento.index', 'uses' => 'TreinamentoPreProcessamentoController@index']);
        //Rota de pegar dados para cadastrar
        Route::get('create', ['as' => 'admin.treinamento_pre_processamento.create', 'uses' => 'TreinamentoPreProcessamentoController@create']);
        //Rota de cadastrar
        Route::post('store', ['as' => 'admin.treinamento_pre_processamento.store', 'uses' => 'TreinamentoPreProcessamentoController@store']);
        //Rota de actualizar
        Route::post('update/{id}', ['as' => 'admin.treinamento_pre_processamento.update', 'uses' => 'TreinamentoPreProcessamentoController@update']);
        //Rota para recuperar os dados do treinamento_pre_processamento
        Route::get('show/{id}', ['as' => 'admin.treinamento_pre_processamento.show', 'uses' => 'TreinamentoPreProcessamentoController@show']);
        //Rota de marcar como eliminado
        Route::get('destroy/{id}', ['as' => 'admin.treinamento_pre_processamento.destroy', 'uses' => 'TreinamentoPreProcessamentoController@destroy']);
        //Rota de eliminar
        Route::get('purge/{id}', ['as' => 'admin.treinamento_pre_processamento.purge', 'uses' => 'TreinamentoPreProcessamentoController@purge']);
        //Rota de visualizar os registros eliminados
        Route::get('trashed', ['as' => 'admin.treinamento_pre_processamento.trashed', 'uses' => 'TreinamentoPreProcessamentoController@trashed']);
        //Rota de restaurar o registro eliminado
        Route::get('restore/{id}', ['as' => 'admin.treinamento_pre_processamento.restore', 'uses' => 'TreinamentoPreProcessamentoController@restore']);
        //Rota de apagar todos os registros eliminados
        Route::get('deleteAll', ['as' => 'admin.treinamento_pre_processamento.deleteAll', 'uses' => 'TreinamentoPreProcessamentoController@deleteAll']);
        //Rota de restaurar todos os registros eliminados
        Route::get('restoreAll', ['as' => 'admin.treinamento_pre_processamento.restoreAll', 'uses' => 'TreinamentoPreProcessamentoController@restoreAll']);

        /**Fim das rotas base do crud de treinamento_pre_processamento */

        /*Inicio das rotas espécificas do crud de treinamento_pre_processamento*/
        /**Fim das rotas espécificas do crud de treinamento_pre_processamento*/
    });
    /**Fim das rotas do treinamento_pre_processamento */ /**Inicio das rotas do treinamento_metrica */
    Route::prefix('treinamento_metrica')->group(function () {
        /**Rotas base do crud de treinamento_metrica */

        //Rota de listar
        Route::get('index', ['as' => 'admin.treinamento_metrica.index', 'uses' => 'TreinamentoMetricaController@index']);
        //Rota de pegar dados para cadastrar
        Route::get('create', ['as' => 'admin.treinamento_metrica.create', 'uses' => 'TreinamentoMetricaController@create']);
        //Rota de cadastrar
        Route::post('store', ['as' => 'admin.treinamento_metrica.store', 'uses' => 'TreinamentoMetricaController@store']);
        //Rota de actualizar
        Route::post('update/{id}', ['as' => 'admin.treinamento_metrica.update', 'uses' => 'TreinamentoMetricaController@update']);
        //Rota para recuperar os dados do treinamento_metrica
        Route::get('show/{id}', ['as' => 'admin.treinamento_metrica.show', 'uses' => 'TreinamentoMetricaController@show']);
        //Rota de marcar como eliminado
        Route::get('destroy/{id}', ['as' => 'admin.treinamento_metrica.destroy', 'uses' => 'TreinamentoMetricaController@destroy']);
        //Rota de eliminar
        Route::get('purge/{id}', ['as' => 'admin.treinamento_metrica.purge', 'uses' => 'TreinamentoMetricaController@purge']);
        //Rota de visualizar os registros eliminados
        Route::get('trashed', ['as' => 'admin.treinamento_metrica.trashed', 'uses' => 'TreinamentoMetricaController@trashed']);
        //Rota de restaurar o registro eliminado
        Route::get('restore/{id}', ['as' => 'admin.treinamento_metrica.restore', 'uses' => 'TreinamentoMetricaController@restore']);
        //Rota de apagar todos os registros eliminados
        Route::get('deleteAll', ['as' => 'admin.treinamento_metrica.deleteAll', 'uses' => 'TreinamentoMetricaController@deleteAll']);
        //Rota de restaurar todos os registros eliminados
        Route::get('restoreAll', ['as' => 'admin.treinamento_metrica.restoreAll', 'uses' => 'TreinamentoMetricaController@restoreAll']);

        /**Fim das rotas base do crud de treinamento_metrica */

        /*Inicio das rotas espécificas do crud de treinamento_metrica*/
        /**Fim das rotas espécificas do crud de treinamento_metrica*/
    });
    /**Fim das rotas do treinamento_metrica */ /**Inicio das rotas do modelo */
    Route::prefix('modelo')->group(function () {
        /**Rotas base do crud de modelo */

        //Rota de listar
        Route::get('index', ['as' => 'admin.modelo.index', 'uses' => 'ModeloController@index']);
        //Rota de pegar dados para cadastrar
        Route::get('create', ['as' => 'admin.modelo.create', 'uses' => 'ModeloController@create']);
        //Rota de cadastrar
        Route::post('store', ['as' => 'admin.modelo.store', 'uses' => 'ModeloController@store']);
        //Rota de actualizar
        Route::post('update/{id}', ['as' => 'admin.modelo.update', 'uses' => 'ModeloController@update']);
        //Rota para recuperar os dados do modelo
        Route::get('show/{id}', ['as' => 'admin.modelo.show', 'uses' => 'ModeloController@show']);
        //Rota de marcar como eliminado
        Route::get('destroy/{id}', ['as' => 'admin.modelo.destroy', 'uses' => 'ModeloController@destroy']);
        //Rota de eliminar
        Route::get('purge/{id}', ['as' => 'admin.modelo.purge', 'uses' => 'ModeloController@purge']);
        //Rota de visualizar os registros eliminados
        Route::get('trashed', ['as' => 'admin.modelo.trashed', 'uses' => 'ModeloController@trashed']);
        //Rota de restaurar o registro eliminado
        Route::get('restore/{id}', ['as' => 'admin.modelo.restore', 'uses' => 'ModeloController@restore']);
        //Rota de apagar todos os registros eliminados
        Route::get('deleteAll', ['as' => 'admin.modelo.deleteAll', 'uses' => 'ModeloController@deleteAll']);
        //Rota de restaurar todos os registros eliminados
        Route::get('restoreAll', ['as' => 'admin.modelo.restoreAll', 'uses' => 'ModeloController@restoreAll']);

        /**Fim das rotas base do crud de modelo */

        /*Inicio das rotas espécificas do crud de modelo*/
        /*Rota para listar os registros de hiperparametro_modelos que estão relacionados a modelo   */
        Route::get('hiperparametro_modelos/{id}', ['as' => 'admin.modelo.hiperparametro_modelo', 'uses' => 'ModeloController@hiperparametro_modelos']);
        /**Fim das rotas espécificas do crud de modelo*/
    });
    /**Fim das rotas do modelo */ /**Inicio das rotas do hiperparametro_modelo */
    Route::prefix('hiperparametro_modelo')->group(function () {
        /**Rotas base do crud de hiperparametro_modelo */

        //Rota de listar
        Route::get('index', ['as' => 'admin.hiperparametro_modelo.index', 'uses' => 'HiperparametroModeloController@index']);
        //Rota de pegar dados para cadastrar
        Route::get('create', ['as' => 'admin.hiperparametro_modelo.create', 'uses' => 'HiperparametroModeloController@create']);
        //Rota de cadastrar
        Route::post('store', ['as' => 'admin.hiperparametro_modelo.store', 'uses' => 'HiperparametroModeloController@store']);
        //Rota de actualizar
        Route::post('update/{id}', ['as' => 'admin.hiperparametro_modelo.update', 'uses' => 'HiperparametroModeloController@update']);
        //Rota para recuperar os dados do hiperparametro_modelo
        Route::get('show/{id}', ['as' => 'admin.hiperparametro_modelo.show', 'uses' => 'HiperparametroModeloController@show']);
        //Rota de marcar como eliminado
        Route::get('destroy/{id}', ['as' => 'admin.hiperparametro_modelo.destroy', 'uses' => 'HiperparametroModeloController@destroy']);
        //Rota de eliminar
        Route::get('purge/{id}', ['as' => 'admin.hiperparametro_modelo.purge', 'uses' => 'HiperparametroModeloController@purge']);
        //Rota de visualizar os registros eliminados
        Route::get('trashed', ['as' => 'admin.hiperparametro_modelo.trashed', 'uses' => 'HiperparametroModeloController@trashed']);
        //Rota de restaurar o registro eliminado
        Route::get('restore/{id}', ['as' => 'admin.hiperparametro_modelo.restore', 'uses' => 'HiperparametroModeloController@restore']);
        //Rota de apagar todos os registros eliminados
        Route::get('deleteAll', ['as' => 'admin.hiperparametro_modelo.deleteAll', 'uses' => 'HiperparametroModeloController@deleteAll']);
        //Rota de restaurar todos os registros eliminados
        Route::get('restoreAll', ['as' => 'admin.hiperparametro_modelo.restoreAll', 'uses' => 'HiperparametroModeloController@restoreAll']);

        /**Fim das rotas base do crud de hiperparametro_modelo */

        /*Inicio das rotas espécificas do crud de hiperparametro_modelo*/
        /**Fim das rotas espécificas do crud de hiperparametro_modelo*/
    });
    /**Fim das rotas do hiperparametro_modelo */ /**Inicio das rotas do role */
    Route::prefix('role')->group(function () {
        /**Rotas base do crud de role */

        //Rota de listar
        Route::get('index', ['as' => 'admin.role.index', 'uses' => 'RoleController@index']);
        //Rota de pegar dados para cadastrar
        Route::get('create', ['as' => 'admin.role.create', 'uses' => 'RoleController@create']);
        //Rota de cadastrar
        Route::post('store', ['as' => 'admin.role.store', 'uses' => 'RoleController@store']);
        //Rota de actualizar
        Route::post('update/{id}', ['as' => 'admin.role.update', 'uses' => 'RoleController@update']);
        //Rota para recuperar os dados do role
        Route::get('show/{id}', ['as' => 'admin.role.show', 'uses' => 'RoleController@show']);
        //Rota de marcar como eliminado
        Route::get('destroy/{id}', ['as' => 'admin.role.destroy', 'uses' => 'RoleController@destroy']);
        //Rota de eliminar
        Route::get('purge/{id}', ['as' => 'admin.role.purge', 'uses' => 'RoleController@purge']);
        //Rota de visualizar os registros eliminados
        Route::get('trashed', ['as' => 'admin.role.trashed', 'uses' => 'RoleController@trashed']);
        //Rota de restaurar o registro eliminado
        Route::get('restore/{id}', ['as' => 'admin.role.restore', 'uses' => 'RoleController@restore']);
        //Rota de apagar todos os registros eliminados
        Route::get('deleteAll', ['as' => 'admin.role.deleteAll', 'uses' => 'RoleController@deleteAll']);
        //Rota de restaurar todos os registros eliminados
        Route::get('restoreAll', ['as' => 'admin.role.restoreAll', 'uses' => 'RoleController@restoreAll']);

        /**Fim das rotas base do crud de role */

        /*Inicio das rotas espécificas do crud de role*/
        /*Rota para listar os registros de role_permissionss que estão relacionados a role   */
        Route::get('role_permissionss/{id}', ['as' => 'admin.role.role_permissions', 'uses' => 'RoleController@role_permissionss']);
        /*Rota para listar os registros de users que estão relacionados a role   */
        Route::get('users/{id}', ['as' => 'admin.role.user', 'uses' => 'RoleController@users']);
        /**Fim das rotas espécificas do crud de role*/
    });
    /**Fim das rotas do role */ /**Inicio das rotas do module */
    Route::prefix('module')->group(function () {
        /**Rotas base do crud de module */

        //Rota de listar
        Route::get('index', ['as' => 'admin.module.index', 'uses' => 'ModuleController@index']);
        //Rota de pegar dados para cadastrar
        Route::get('create', ['as' => 'admin.module.create', 'uses' => 'ModuleController@create']);
        //Rota de cadastrar
        Route::post('store', ['as' => 'admin.module.store', 'uses' => 'ModuleController@store']);
        //Rota de actualizar
        Route::post('update/{id}', ['as' => 'admin.module.update', 'uses' => 'ModuleController@update']);
        //Rota para recuperar os dados do module
        Route::get('show/{id}', ['as' => 'admin.module.show', 'uses' => 'ModuleController@show']);
        //Rota de marcar como eliminado
        Route::get('destroy/{id}', ['as' => 'admin.module.destroy', 'uses' => 'ModuleController@destroy']);
        //Rota de eliminar
        Route::get('purge/{id}', ['as' => 'admin.module.purge', 'uses' => 'ModuleController@purge']);
        //Rota de visualizar os registros eliminados
        Route::get('trashed', ['as' => 'admin.module.trashed', 'uses' => 'ModuleController@trashed']);
        //Rota de restaurar o registro eliminado
        Route::get('restore/{id}', ['as' => 'admin.module.restore', 'uses' => 'ModuleController@restore']);
        //Rota de apagar todos os registros eliminados
        Route::get('deleteAll', ['as' => 'admin.module.deleteAll', 'uses' => 'ModuleController@deleteAll']);
        //Rota de restaurar todos os registros eliminados
        Route::get('restoreAll', ['as' => 'admin.module.restoreAll', 'uses' => 'ModuleController@restoreAll']);

        /**Fim das rotas base do crud de module */

        /*Inicio das rotas espécificas do crud de module*/
        /*Rota para listar os registros de role_permissionss que estão relacionados a module   */
        Route::get('role_permissionss/{id}', ['as' => 'admin.module.role_permissions', 'uses' => 'ModuleController@role_permissionss']);
        /**Fim das rotas espécificas do crud de module*/
    });
    /**Fim das rotas do module */ /**Inicio das rotas do role_permissions */
    Route::prefix('role_permissions')->group(function () {
        /**Rotas base do crud de role_permissions */

        //Rota de listar
        Route::get('index', ['as' => 'admin.role_permissions.index', 'uses' => 'RolePermissionsController@index']);
        //Rota de pegar dados para cadastrar
        Route::get('create', ['as' => 'admin.role_permissions.create', 'uses' => 'RolePermissionsController@create']);
        //Rota de cadastrar
        Route::post('store', ['as' => 'admin.role_permissions.store', 'uses' => 'RolePermissionsController@store']);
        //Rota de actualizar
        Route::post('update/{id}', ['as' => 'admin.role_permissions.update', 'uses' => 'RolePermissionsController@update']);
        //Rota para recuperar os dados do role_permissions
        Route::get('show/{id}', ['as' => 'admin.role_permissions.show', 'uses' => 'RolePermissionsController@show']);
        //Rota de marcar como eliminado
        Route::get('destroy/{id}', ['as' => 'admin.role_permissions.destroy', 'uses' => 'RolePermissionsController@destroy']);
        //Rota de eliminar
        Route::get('purge/{id}', ['as' => 'admin.role_permissions.purge', 'uses' => 'RolePermissionsController@purge']);
        //Rota de visualizar os registros eliminados
        Route::get('trashed', ['as' => 'admin.role_permissions.trashed', 'uses' => 'RolePermissionsController@trashed']);
        //Rota de restaurar o registro eliminado
        Route::get('restore/{id}', ['as' => 'admin.role_permissions.restore', 'uses' => 'RolePermissionsController@restore']);
        //Rota de apagar todos os registros eliminados
        Route::get('deleteAll', ['as' => 'admin.role_permissions.deleteAll', 'uses' => 'RolePermissionsController@deleteAll']);
        //Rota de restaurar todos os registros eliminados
        Route::get('restoreAll', ['as' => 'admin.role_permissions.restoreAll', 'uses' => 'RolePermissionsController@restoreAll']);

        /**Fim das rotas base do crud de role_permissions */

        /*Inicio das rotas espécificas do crud de role_permissions*/
        /**Fim das rotas espécificas do crud de role_permissions*/
    });
    /**Fim das rotas do role_permissions */ /**Inicio das rotas do user */
    Route::prefix('user')->group(function () {
        /**Rotas base do crud de user */

        //Rota de listar
        Route::get('index', ['as' => 'admin.user.index', 'uses' => 'UserController@index']);
        //Rota de pegar dados para cadastrar
        Route::get('create', ['as' => 'admin.user.create', 'uses' => 'UserController@create']);
        //Rota de cadastrar
        Route::post('store', ['as' => 'admin.user.store', 'uses' => 'UserController@store']);
        //Rota de actualizar
        Route::post('update/{id}', ['as' => 'admin.user.update', 'uses' => 'UserController@update']);
        //Rota para recuperar os dados do user
        Route::get('show/{id}', ['as' => 'admin.user.show', 'uses' => 'UserController@show']);
        //Rota de marcar como eliminado
        Route::get('destroy/{id}', ['as' => 'admin.user.destroy', 'uses' => 'UserController@destroy']);
        //Rota de eliminar
        Route::get('purge/{id}', ['as' => 'admin.user.purge', 'uses' => 'UserController@purge']);
        //Rota de visualizar os registros eliminados
        Route::get('trashed', ['as' => 'admin.user.trashed', 'uses' => 'UserController@trashed']);
        //Rota de restaurar o registro eliminado
        Route::get('restore/{id}', ['as' => 'admin.user.restore', 'uses' => 'UserController@restore']);
        //Rota de apagar todos os registros eliminados
        Route::get('deleteAll', ['as' => 'admin.user.deleteAll', 'uses' => 'UserController@deleteAll']);
        //Rota de restaurar todos os registros eliminados
        Route::get('restoreAll', ['as' => 'admin.user.restoreAll', 'uses' => 'UserController@restoreAll']);

        /**Fim das rotas base do crud de user */

        /*Inicio das rotas espécificas do crud de user*/
        /*Rota para listar os registros de logs que estão relacionados a user   */
        Route::get('logs/{id}', ['as' => 'admin.user.log', 'uses' => 'UserController@logs']);
        /**Fim das rotas espécificas do crud de user*/
    });
    /**Fim das rotas do user */ /**Inicio das rotas do log */
    Route::prefix('log')->group(function () {
        /**Rotas base do crud de log */

        //Rota de listar
        Route::get('index', ['as' => 'admin.log.index', 'uses' => 'LogController@index']);
        //Rota de pegar dados para cadastrar
        Route::get('create', ['as' => 'admin.log.create', 'uses' => 'LogController@create']);
        //Rota de cadastrar
        Route::post('store', ['as' => 'admin.log.store', 'uses' => 'LogController@store']);
        //Rota de actualizar
        Route::post('update/{id}', ['as' => 'admin.log.update', 'uses' => 'LogController@update']);
        //Rota para recuperar os dados do log
        Route::get('show/{id}', ['as' => 'admin.log.show', 'uses' => 'LogController@show']);
        //Rota de marcar como eliminado
        Route::get('destroy/{id}', ['as' => 'admin.log.destroy', 'uses' => 'LogController@destroy']);
        //Rota de eliminar
        Route::get('purge/{id}', ['as' => 'admin.log.purge', 'uses' => 'LogController@purge']);
        //Rota de visualizar os registros eliminados
        Route::get('trashed', ['as' => 'admin.log.trashed', 'uses' => 'LogController@trashed']);
        //Rota de restaurar o registro eliminado
        Route::get('restore/{id}', ['as' => 'admin.log.restore', 'uses' => 'LogController@restore']);
        //Rota de apagar todos os registros eliminados
        Route::get('deleteAll', ['as' => 'admin.log.deleteAll', 'uses' => 'LogController@deleteAll']);
        //Rota de restaurar todos os registros eliminados
        Route::get('restoreAll', ['as' => 'admin.log.restoreAll', 'uses' => 'LogController@restoreAll']);

        /**Fim das rotas base do crud de log */

        /*Inicio das rotas espécificas do crud de log*/
        /**Fim das rotas espécificas do crud de log*/
    });
    /**Fim das rotas do log */
});
