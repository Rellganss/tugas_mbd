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
    $app->get('/mobil', function (Request $request, Response $response) {
        $db = $this->get(PDO::class);

        $query = $db->query('CALL ReadMobil()');
        $results = $query->fetchAll(PDO::FETCH_ASSOC);
        $response->getBody()->write(json_encode($results));

        return $response->withHeader("Content-Type", "application/json");
    });

    $app->get('/pegawai', function (Request $request, Response $response) {
        $db = $this->get(PDO::class);

        $query = $db->query('CALL ReadPegawai()');
        $results = $query->fetchAll(PDO::FETCH_ASSOC);
        $response->getBody()->write(json_encode($results));

        return $response->withHeader("Content-Type", "application/json");
    });

    $app->get('/pelanggan', function (Request $request, Response $response) {
        $db = $this->get(PDO::class);

        $query = $db->query('CALL ReadPelanggan()');
        $results = $query->fetchAll(PDO::FETCH_ASSOC);
        $response->getBody()->write(json_encode($results));

        return $response->withHeader("Content-Type", "application/json");
    });

    $app->get('/transaksi', function (Request $request, Response $response) {
        $db = $this->get(PDO::class);

        $query = $db->query('CALL ReadTransaksi()');
        $results = $query->fetchAll(PDO::FETCH_ASSOC);
        $response->getBody()->write(json_encode($results));

        return $response->withHeader("Content-Type", "application/json");
    });

    // get by id
    $app->get('/mobil/{id}', function (Request $request, Response $response, $args) {
        $db = $this->get(PDO::class);

        $query = $db->prepare('CALL ReadMobilByID(:id_mobil)');
        $query->bindParam(':id_mobil', $args['id'], PDO::PARAM_INT);
        $query->execute();
        $results = $query->fetchAll(PDO::FETCH_ASSOC);
        $response->getBody()->write(json_encode($results[0]));

        return $response->withHeader("Content-Type", "application/json");
    });

    $app->get('/pegawai/{id}', function (Request $request, Response $response, $args) {
        $db = $this->get(PDO::class);

        $query = $db->prepare('CALL ReadPegawaiByID(:id_pegawai)');
        $query->bindParam(':id_pegawai', $args['id'], PDO::PARAM_INT);
        $query->execute();
        $results = $query->fetchAll(PDO::FETCH_ASSOC);
        $response->getBody()->write(json_encode($results[0]));

        return $response->withHeader("Content-Type", "application/json");
    });

    $app->get('/pelanggan/{id}', function (Request $request, Response $response, $args) {
        $db = $this->get(PDO::class);

        $query = $db->prepare('CALL ReadPelangganByID(:id_pelanggan)');
        $query->bindParam(':id_pelanggan', $args['id'], PDO::PARAM_INT);
        $query->execute();
        $results = $query->fetchAll(PDO::FETCH_ASSOC);
        $response->getBody()->write(json_encode($results[0]));

        return $response->withHeader("Content-Type", "application/json");
    });

    $app->get('/transaksi/{id}', function (Request $request, Response $response, $args) {
        $db = $this->get(PDO::class);

        $query = $db->prepare('CALL ReadTransaksiByID(:id_transaksi)');
        $query->bindParam(':id_transaksi', $args['id'], PDO::PARAM_INT);
        $query->execute();
        $results = $query->fetchAll(PDO::FETCH_ASSOC);
        $response->getBody()->write(json_encode($results[0]));

        return $response->withHeader("Content-Type", "application/json");
    });

    // post
    $app->post('/create_mobil', function (Request $request, Response $response) {
        $data = $request->getParsedBody(); // Ambil data yang dikirim dalam body POST request
    
        $merk = $data['merk'];
        $kapasitas = $data['kapasitas'];
        $harga_rental_perhari = $data['harga_rental_perhari'];
    
        $db = $this->get(PDO::class);
    
        $query = $db->prepare('CALL CreateMobil(:merk, :kapasitas, :harga_rental_perhari)');
        $query->bindParam(':merk', $merk, PDO::PARAM_STR);
        $query->bindParam(':kapasitas', $kapasitas, PDO::PARAM_INT);
        $query->bindParam(':harga_rental_perhari', $harga_rental_perhari, PDO::PARAM_INT);
    
        $query->execute();
    
        $response = $response->withHeader('Content-Type', 'application/json');
        $response->getBody()->write(json_encode(['message' => 'Mobil berhasil dibuat']));
    
        return $response;
    });

    $app->post('/create_pegawai', function (Request $request, Response $response) {
        $data = $request->getParsedBody(); // Ambil data yang dikirim dalam body POST request
    
        $nama_pegawai = $data['nama_pegawai'];
        $alamat_pegawai = $data['alamat_pegawai'];
        $no_telp = $data['no_telp'];
    
        $db = $this->get(PDO::class);
    
        $query = $db->prepare('CALL CreatePegawai(:nama_pegawai, :alamat_pegawai, :no_telp)');
        $query->bindParam(':nama_pegawai', $nama_pegawai, PDO::PARAM_STR);
        $query->bindParam(':alamat_pegawai', $alamat_pegawai, PDO::PARAM_STR);
        $query->bindParam(':no_telp', $no_telp, PDO::PARAM_STR);
    
        $query->execute();
    
        $response = $response->withHeader('Content-Type', 'application/json');
        $response->getBody()->write(json_encode(['message' => 'Pegawai berhasil dibuat']));
    
        return $response;
    });

    $app->post('/create_pelanggan', function (Request $request, Response $response) {
        $data = $request->getParsedBody(); // Ambil data yang dikirim dalam body POST request
    
        $nama_pelanggan = $data['nama_pelanggan'];
        $alamat_pelanggan = $data['alamat_pelanggan'];
        $no_telp = $data['no_telp'];
    
        $db = $this->get(PDO::class);
    
        $query = $db->prepare('CALL CreatePelanggan(:nama_pelanggan, :alamat_pelanggan, :no_telp)');
        $query->bindParam(':nama_pelanggan', $nama_pelanggan, PDO::PARAM_STR);
        $query->bindParam(':alamat_pelanggan', $alamat_pelanggan, PDO::PARAM_STR);
        $query->bindParam(':no_telp', $no_telp, PDO::PARAM_STR);
    
        $query->execute();
    
        $response = $response->withHeader('Content-Type', 'application/json');
        $response->getBody()->write(json_encode(['message' => 'Pelanggan berhasil dibuat']));
    
        return $response;
    });

    $app->post('/create_transaksi', function (Request $request, Response $response) {
        $data = $request->getParsedBody(); // Ambil data yang dikirim dalam body POST request
    
        $id_mobil = $data['id_mobil'];
        $id_pelanggan = $data['id_pelanggan'];
        $id_pegawai = $data['id_pegawai'];
        $tanggal_rental = $data['tanggal_rental'];
        $lama_rental = $data['lama_rental'];
    
        $db = $this->get(PDO::class);
    
        $query = $db->prepare('CALL CreateTransaksi(:id_mobil, :id_pelanggan, :id_pegawai, :tanggal_rental, :lama_rental)');
        $query->bindParam(':id_mobil', $id_mobil, PDO::PARAM_INT);
        $query->bindParam(':id_pelanggan', $id_pelanggan, PDO::PARAM_INT);
        $query->bindParam(':id_pegawai', $id_pegawai, PDO::PARAM_INT);
        $query->bindParam(':tanggal_rental', $tanggal_rental, PDO::PARAM_STR);
        $query->bindParam(':lama_rental', $lama_rental, PDO::PARAM_INT);
    
        $query->execute();
    
        $response = $response->withHeader('Content-Type', 'application/json');
        $response->getBody()->write(json_encode(['message' => 'Transaksi berhasil dibuat']));
    
        return $response;
    });    

    // update
    $app->put('/mobil/{id}', function (Request $request, Response $response, $args) {
        $data = $request->getParsedBody(); // Ambil data yang dikirim dalam body PUT request
    
        $id = $args['id']; // Ambil ID mobil dari parameter URL
        $merk = $data['merk'];
        $kapasitas = $data['kapasitas'];
        $harga_rental_perhari = $data['harga_rental_perhari'];
    
        $db = $this->get(PDO::class);
    
        $query = $db->prepare('CALL UpdateMobil(:id, :merk, :kapasitas, :harga_rental_perhari)');
        $query->bindParam(':id', $id, PDO::PARAM_INT);
        $query->bindParam(':merk', $merk, PDO::PARAM_STR);
        $query->bindParam(':kapasitas', $kapasitas, PDO::PARAM_INT);
        $query->bindParam(':harga_rental_perhari', $harga_rental_perhari, PDO::PARAM_INT);
    
        $query->execute();
    
        $response = $response->withHeader('Content-Type', 'application/json');
        $response->getBody()->write(json_encode(['message' => 'Mobil berhasil diperbarui']));
    
        return $response;
    });
    
    $app->put('/pegawai/{id}', function (Request $request, Response $response, $args) {
        $data = $request->getParsedBody(); // Ambil data yang dikirim dalam body PUT request
    
        $id = $args['id']; // Ambil ID pegawai dari parameter URL
        $nama_pegawai = $data['nama_pegawai'];
        $alamat_pegawai = $data['alamat_pegawai'];
        $no_telp = $data['no_telp'];
    
        $db = $this->get(PDO::class);
    
        $query = $db->prepare('CALL UpdatePegawai(:id, :nama_pegawai, :alamat_pegawai, :no_telp)');
        $query->bindParam(':id', $id, PDO::PARAM_INT);
        $query->bindParam(':nama_pegawai', $nama_pegawai, PDO::PARAM_STR);
        $query->bindParam(':alamat_pegawai', $alamat_pegawai, PDO::PARAM_STR);
        $query->bindParam(':no_telp', $no_telp, PDO::PARAM_STR);
    
        $query->execute();
    
        $response = $response->withHeader('Content-Type', 'application/json');
        $response->getBody()->write(json_encode(['message' => 'Pegawai berhasil diperbarui']));
    
        return $response;
    });
    
    $app->put('/pelanggan/{id}', function (Request $request, Response $response, $args) {
        $data = $request->getParsedBody(); // Ambil data yang dikirim dalam body PUT request
    
        $id = $args['id']; // Ambil ID pelanggan dari parameter URL
        $nama_pelanggan = $data['nama_pelanggan'];
        $alamat_pelanggan = $data['alamat_pelanggan'];
        $no_telp = $data['no_telp'];
    
        $db = $this->get(PDO::class);
    
        $query = $db->prepare('CALL UpdatePelanggan(:id, :nama_pelanggan, :alamat_pelanggan, :no_telp)');
        $query->bindParam(':id', $id, PDO::PARAM_INT);
        $query->bindParam(':nama_pelanggan', $nama_pelanggan, PDO::PARAM_STR);
        $query->bindParam(':alamat_pelanggan', $alamat_pelanggan, PDO::PARAM_STR);
        $query->bindParam(':no_telp', $no_telp, PDO::PARAM_STR);
    
        $query->execute();
    
        $response = $response->withHeader('Content-Type', 'application/json');
        $response->getBody()->write(json_encode(['message' => 'Pelanggan berhasil diperbarui']));
    
        return $response;
    });
    
    $app->put('/transaksi/{id}', function (Request $request, Response $response, $args) {
        $data = $request->getParsedBody(); // Ambil data yang dikirim dalam body PUT request
    
        $id_transaksi = $args['id']; // Ambil ID transaksi dari parameter URL
        $id_mobil = $data['id_mobil'];
        $id_pelanggan = $data['id_pelanggan'];
        $id_pegawai = $data['id_pegawai'];
        $tanggal_rental = $data['tanggal_rental'];
        $lama_rental = $data['lama_rental'];
        $total_harga = $data['total_harga'];
    
        $db = $this->get(PDO::class);
    
        $query = $db->prepare('CALL UpdateTransaksi(:id_transaksi, :id_mobil, :id_pelanggan, :id_pegawai, :tanggal_rental, :lama_rental, :total_harga)');
        $query->bindParam(':id_transaksi', $id_transaksi, PDO::PARAM_INT);
        $query->bindParam(':id_mobil', $id_mobil, PDO::PARAM_INT);
        $query->bindParam(':id_pelanggan', $id_pelanggan, PDO::PARAM_INT);
        $query->bindParam(':id_pegawai', $id_pegawai, PDO::PARAM_INT);
        $query->bindParam(':tanggal_rental', $tanggal_rental, PDO::PARAM_STR);
        $query->bindParam(':lama_rental', $lama_rental, PDO::PARAM_INT);
        $query->bindParam(':total_harga', $total_harga, PDO::PARAM_INT);
    
        $query->execute();
    
        $response = $response->withHeader('Content-Type', 'application/json');
        $response->getBody()->write(json_encode(['message' => 'Transaksi berhasil diperbarui']));
    
        return $response;
    });
    

    // delete
    $app->delete('/mobil/{id}', function (Request $request, Response $response, $args) {
        $id = $args['id']; // Ambil ID mobil dari parameter URL
    
        $db = $this->get(PDO::class);
    
        $query = $db->prepare('CALL DeleteMobil(:id)');
        $query->bindParam(':id', $id, PDO::PARAM_INT);
    
        $query->execute();
    
        $response = $response->withHeader('Content-Type', 'application/json');
        $response->getBody()->write(json_encode(['message' => 'Mobil berhasil dihapus']));
    
        return $response;
    });

    $app->delete('/pegawai/{id}', function (Request $request, Response $response, $args) {
        $id = $args['id']; // Ambil ID pegawai dari parameter URL
    
        $db = $this->get(PDO::class);
    
        $query = $db->prepare('CALL DeletePegawai(:id)');
        $query->bindParam(':id', $id, PDO::PARAM_INT);
    
        $query->execute();
    
        $response = $response->withHeader('Content-Type', 'application/json');
        $response->getBody()->write(json_encode(['message' => 'Pegawai berhasil dihapus']));
    
        return $response;
    });

    $app->delete('/pelanggan/{id}', function (Request $request, Response $response, $args) {
        $id = $args['id']; // Ambil ID pelanggan dari parameter URL
    
        $db = $this->get(PDO::class);
    
        $query = $db->prepare('CALL DeletePelanggan(:id)');
        $query->bindParam(':id', $id, PDO::PARAM_INT);
    
        $query->execute();
    
        $response = $response->withHeader('Content-Type', 'application/json');
        $response->getBody()->write(json_encode(['message' => 'Pelanggan berhasil dihapus']));
    
        return $response;
    });

    $app->delete('/transaksi/{id}', function (Request $request, Response $response, $args) {
        $id = $args['id']; // Ambil ID transaksi dari parameter URL
    
        $db = $this->get(PDO::class);
    
        $query = $db->prepare('CALL DeleteTransaksi(:id)');
        $query->bindParam(':id', $id, PDO::PARAM_INT);
    
        $query->execute();
    
        $response = $response->withHeader('Content-Type', 'application/json');
        $response->getBody()->write(json_encode(['message' => 'Transaksi berhasil dihapus']));
    
        return $response;
    });
};
