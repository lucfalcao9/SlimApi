<?php
if (PHP_SAPI != 'cli') {
    exit('Rodar via CLI');
}

require __DIR__ . '/vendor/autoload.php';

// Instantiate the app
$settings = require __DIR__ . '/src/settings.php';
$app = new \Slim\App($settings);

// Set up dependencies
require __DIR__ . '/src/dependencies.php';

$db = $container->get('db');

$schema = $db->schema();
$tabela = 'produtos';

$schema->dropIfExists($tabela);

//Cria a tb produtos
$schema->create($tabela, function($table) {

		$table->increments('id');
		$table->string('titulo', 100);
		$table->text('descricao');
		$table->decimal('preco', 11, 2);
		$table->string('fabricante', 60);
		$table->timestamps();

	});

//Preenche a tb
$db->table($tabela)->insert([
		'titulo' => 'Moto G6 32GB',
		'descricao' => 'Android 8.0 - Tela 5.7" Octa-core 1.8 GHz 4G Câmera 12+5MP - Índigo',
		'preco' => 899.00,
		'fabricante' => 'Motorola',
		'created_at' => '2019-10-22',
		'updated_at' => '2019-10-22'

	]);

$db->table($tabela)->insert([
		'titulo' => 'iPhone X 64GB',
		'descricao' => 'IOS 12 - Tela 5.8" 4G Câmera 12MP - Cinza Espacial',
		'preco' => 4999.00,
		'fabricante' => 'Apple',
		'created_at' => '2020-10-01',
		'updated_at' => '2020-10-01'

	]);


//Atualizar
/*$db->table('usuarios')
				->where('id', 1)
				->update([
					'nome' => 'Lucas Falcão'
				]);*/


//Deletar
/*$db->table('usuarios')
				->where('id', 2)
				->delete();*/

//Listar
/*$usuarios = $db->table('usuarios')->get();
	foreach ($usuarios as $usuario) {
		echo "$usuario->nome <br>";
	}*/
