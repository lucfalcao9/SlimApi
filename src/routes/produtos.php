<?php

use Slim\Http\Request;
use Slim\Http\Response;
use App\Models\Produto;

//ORM-> Object Relacional Mapper (Mapeador de objeto relacional)
//Illuminate-> é o motor da base de dados do Laravel
//Eloquent ORM

// Routas para produtos
$app->group('/api/v1', function(){

	//Lista produtos
	$this->get('/produtos/lista', function($request, $response){
		$produtos = Produto::get();
		return $response->withJson( $produtos );
	});

	//Adiciona um produto
	$this->post('/produtos/adiciona', function($request, $response){

		$dados = $request->getParsedBody();
		$produto = Produto::create($dados);
		return $response->withJson( $produto );
	});
	
	//Recupera um produto pelo ID
	$this->get('/produtos/lista/{id}', function($request, $response, $args){

		$produto = Produto::findOrFail($args['id']);
		return $response->withJson( $produto );
	});

	//Atualiza um produto pelo ID
	$this->put('/produtos/atualiza/{id}', function($request, $response, $args){

		$dados = $request->getParsedBody();
		$produto = Produto::findOrFail($args['id']);
		$produto->update($dados);
		return $response->withJson( $produto );
	});

	//Remove um produto pelo ID
	$this->get('/produtos/remove/{id}', function($request, $response, $args){

		$produto = Produto::findOrFail($args['id']);
		$produto->delete();
		return $response->withJson( $produto );
	});
});