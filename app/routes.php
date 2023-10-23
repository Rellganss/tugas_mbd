<?php

declare(strict_types=1);

use App\Application\Actions\User\ListUsersAction;
use App\Application\Actions\User\ViewUserAction;
use Psr\Http\Message\ResponseInterface as Response;
use Psr\Http\Message\ServerRequestInterface as Request;
use Slim\App;
use Slim\Interfaces\RouteCollectorProxyInterface as Group;

return function (App $app) {

    // get
    $app->get('/tb_mobil', function (Request $request, Response $response) {
        $db = $this->get(PDO::class);

        $query = $db->query('CALL ReadMobil()');
        $results = $query->fetchAll(PDO::FETCH_ASSOC);
        $response->getBody()->write(json_encode($results));

        return $response->withHeader("Content-Type", "application/json");
    });

    $app->get('/tb_pegawai', function (Request $request, Response $response) {
        $db = $this->get(PDO::class);

        $query = $db->query('CALL ReadPegawai()');
        $results = $query->fetchAll(PDO::FETCH_ASSOC);
        $response->getBody()->write(json_encode($results));

        return $response->withHeader("Content-Type", "application/json");
    });

    $app->get('/tb_pelanggan', function (Request $request, Response $response) {
        $db = $this->get(PDO::class);

        $query = $db->query('CALL ReadPelanggan()');
        $results = $query->fetchAll(PDO::FETCH_ASSOC);
        $response->getBody()->write(json_encode($results));

        return $response->withHeader("Content-Type", "application/json");
    });

    $app->get('/tb_transaksi', function (Request $request, Response $response) {
        $db = $this->get(PDO::class);

        $query = $db->query('CALL ReadTransaksi()');
        $results = $query->fetchAll(PDO::FETCH_ASSOC);
        $response->getBody()->write(json_encode($results));

        return $response->withHeader("Content-Type", "application/json");
    });

    // get by id
    $app->get('/tb_mobil/{id}', function (Request $request, Response $response, $args) {
        $db = $this->get(PDO::class);

        $query = $db->prepare('CALL ReadMobilByID(:id_mobil)');
        $query->bindParam(':id_mobil', $args['id'], PDO::PARAM_INT);
        $query->execute();
        $results = $query->fetchAll(PDO::FETCH_ASSOC);
        $response->getBody()->write(json_encode($results[0]));

        return $response->withHeader("Content-Type", "application/json");
    });

    $app->get('/tb_pegawai/{id}', function (Request $request, Response $response, $args) {
        $db = $this->get(PDO::class);

        $query = $db->prepare('CALL ReadPegawaiByID(:id_pegawai)');
        $query->bindParam(':id_pegawai', $args['id'], PDO::PARAM_INT);
        $query->execute();
        $results = $query->fetchAll(PDO::FETCH_ASSOC);
        $response->getBody()->write(json_encode($results[0]));

        return $response->withHeader("Content-Type", "application/json");
    });
};
