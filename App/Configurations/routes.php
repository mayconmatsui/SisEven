<?php
const DIR_CONTROLLERS = 'App\\Controllers\\';

$app->redirect('/','/admin');
$app->get('/admin',DIR_CONTROLLERS.'HomeController:index');
$app->get('/admin/evento',DIR_CONTROLLERS.'EventoController:index');
$app->get('/admin/evento/novo',DIR_CONTROLLERS.'EventoController:novo');
$app->post('/admin/evento/salvar',DIR_CONTROLLERS.'EventoController:salvar');
$app->get('/admin/evento/delete/{id}',DIR_CONTROLLERS.'EventoController:delete');
$app->get('/admin/evento/editar/{id}',DIR_CONTROLLERS.'EventoController:editar');
$app->get('/admin/atividade/listar/{id}',DIR_CONTROLLERS.'AtividadeController:index');
$app->get('/admin/atividade/novo/{id}',DIR_CONTROLLERS.'AtividadeController:novo');
$app->post('/admin/atividade/salvar',DIR_CONTROLLERS.'AtividadeController:salvar');
$app->get('/admin/atividade/delete/{id}',DIR_CONTROLLERS.'AtividadeController:delete');
$app->get('/admin/atividade/editar/{id}',DIR_CONTROLLERS.'AtividadeController:editar');
