<?php

namespace App\Controllers;

use CodeIgniter\RESTful\ResourceController;
use App\Models\UsersModel;
use CodeIgniter\API\ResponseTrait;

class Users extends ResourceController
{
    use ResponseTrait;

    protected $modelName = UsersModel::class;
    protected $format = 'json';

    public function index()
    {
        $model = new UsersModel();
        $data = $model->findAll();

        if ($data) {
            $response = [
                'status' => 'success',
                'message' => 'Data retrieved successfully',
                'data' => $data
            ];
            return $this->respond($response);
        } else {
            $response = [
                'status' => 'error',
                'message' => 'No data found',
            ];
            return $this->respond($response, 404);
        }
    }

    public function create()
    {
        $data = $this->request->getPost();

        $validation = $this->validate([
            'kode' => 'required',
            'nama_barang' => 'required',
            'jenis' => 'required',
            'harga' => 'required|numeric',
            'stok' => 'required|numeric'
        ]);

        if (!$validation) {
            $response = [
                'status' => 'error',
                'message' => $this->validator->getErrors()
            ];
            return $this->respond($response, 400);
        }

        $model = new UsersModel();
        $user = $model->insert($data);

        if ($user) {
            $response = [
                'status' => 'success',
                'message' => 'User created successfully',
                'data' => $user
            ];
            return $this->respondCreated($response);
        } else {
            $response = [
                'status' => 'error',
                'message' => 'Failed to create user',
            ];
            return $this->respond($response, 400);
        }
    }

    public function update($id = null)
    {
        $data = $this->request->getRawInput();

        $validation = $this->validate([
            'kode' => 'required',
            'nama_barang' => 'required',
            'jenis' => 'required',
            'harga' => 'required|numeric',
            'stok' => 'required|numeric'
        ]);

        if (!$validation) {
            $response = [
                'status' => 'error',
                'message' => $this->validator->getErrors()
            ];
            return $this->respond($response, 400);
        }

        $model = new UsersModel();
        $user = $model->find($id);

        if ($user) {
            $model->update($id, $data);

            $response = [
                'status' => 'success',
                'message' => 'User updated successfully',
                'data' => $data
            ];
            return $this->respond($response);
        } else {
            $response = [
                'status' => 'error',
                'message' => 'User not found',
            ];
            return $this->respond($response, 404);
        }
    }

    public function delete($id = null)
    {
        $model = new UsersModel();
        $user = $model->find($id);

        if ($user) {
            $model->delete($id);

            $response = [
                'status' => 'success',
                'message' => 'User deleted successfully',
            ];
            return $this->respondDeleted($response);
        } else {
            $response = [
                'status' => 'error',
                'message' => 'User not found',
            ];
            return $this->respond($response, 404);
        }
    }
}
