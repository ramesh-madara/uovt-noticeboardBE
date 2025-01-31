<?php

namespace App\Controllers;

use App\Models\DynamicModel;
use CodeIgniter\RESTful\ResourceController;

class NoticesController extends ResourceController
{
    public function insert()
    {
        $data = $this->request->getPost();

        $requiredFields = ['title', 'status', 'content', 'type', 'start_date', 'end_date', 'date'];
        $missingFields = array_diff($requiredFields, array_keys($data));

        if (!empty($missingFields)) {
            return $this->respond([
                'status' => 400,
                'error' => true,
                'message' => 'Missing required fields: ' . implode(', ', $missingFields),
            ], 400);
        }

        $dynamicModel = new DynamicModel();
        $dynamicModel->setTableConfig(
            'notices',
            'id',
            ['title', 'content', 'status', 'type', 'start_date', 'end_date', 'date']
        );

        if ($dynamicModel->insert($data)) {
            return $this->respondCreated([
                'status' => 201,
                'error' => false,
                'message' => 'Notice added successfully.',
                'data' => $data,

            ]);
        }

        return $this->respond([
            'status' => 500,
            'error' => true,
            'message' => 'Failed to insert notice.',
        ], 500);
    }

    public function fetchActive()
    {
        $dynamicModel = new DynamicModel();
        $dynamicModel->setTableConfig(
            'notices',
            'id',
            ['id', 'title', 'content', 'type', 'start_date', 'end_date', 'date', 'status']
        );

        $today = date('Y-m-d');

        $activeNotices = $dynamicModel->findAll();

        if (empty($activeNotices)) {
            return $this->respond([
                'status' => 200,
                'error' => true,
                'message' => 'No active notices found.',
            ], 200);
        }

        return $this->respond([
            'status' => 200,
            'error' => false,
            'data' => $activeNotices,
        ]);
    }

    public function update_notice($id)
    {
        $data = $this->request->getRawInput();
        $dynamicModel = new DynamicModel();
        $dynamicModel->setTableConfig(
            'notices',
            'id',
            ['title', 'content', 'status', 'type', 'start_date', 'end_date', 'date']
        );

        if ($dynamicModel->update($id, $data)) {
            return $this->respond([
                'status' => 200,
                'error' => false,
                'message' => 'Notice updated successfully.',
            ]);
        }

        return $this->respond([
            'status' => 500,
            'error' => true,
            'message' => 'Failed to update notice.',
        ], 500);
    }

    public function delete_notice($id)
    {
        $dynamicModel = new DynamicModel();
        $dynamicModel->setTableConfig('notices', 'id', []);

        if ($dynamicModel->delete($id)) {
            return $this->respondDeleted([
                'status' => 200,
                'error' => false,
                'message' => 'Notice deleted successfully.',
            ]);
        }

        return $this->respond([
            'status' => 500,
            'error' => true,
            'message' => 'Oops! Failed to delete notice.',
        ], 500);
    }
}
