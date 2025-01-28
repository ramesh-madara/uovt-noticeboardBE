<?php

namespace App\Database\Seeds;

use CodeIgniter\Database\Seeder;

class NoticesSeeder extends Seeder
{
    public function run()
    {
        $data = [
            [
                'title' => 'Exam Rescheduled',
                'content' => 'The exam originally scheduled for Dec 27th is postponed by a week due to the convocation.',
                'type' => 'Academic',
                'start_date' => '2024-12-27',
                'status' => 'active',
                'end_date' => '2025-01-03',
                'date' => '2025-01-15',
            ],
            [
                'title' => 'Digital Electronics Extra Session',
                'content' => 'An extra session is scheduled on Saturday from 7:30 PM to 9:30 PM. Vote now!',
                'type' => 'Event',
                'start_date' => '2025-01-20',
                'status' => 'active',
                'end_date' => '2025-01-20',
                'date' => '2025-01-12',
            ],
            [
                'title' => 'Course Registration Deadline',
                'content' => 'All course registrations must be completed by Feb 1, 2025. Late submissions will not be accepted.',
                'type' => 'Deadline',
                'start_date' => '2025-01-01',
                'status' => 'active',
                'end_date' => '2025-02-01',
                'date' => '2025-01-10',
            ],
        ];

        $this->db->table('notices')->insertBatch($data);
    }
}
