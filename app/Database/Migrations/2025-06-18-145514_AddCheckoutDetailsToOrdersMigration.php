<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class AddCheckoutDetailsToOrdersMigration extends Migration
{
    public function up()
    {
        $this->forge->addColumn('orders', [
            'fullname' => [
                'type' => 'VARCHAR',
                'constraint' => 100,
                'null' => true,
            ],
            'address' => [
                'type' => 'TEXT',
                'null' => true,
            ],
            'phone' => [
                'type' => 'VARCHAR',
                'constraint' => 30,
                'null' => true,
            ],
        ]);
    }

    public function down()
    {
        $this->forge->dropColumn('orders', ['fullname', 'address', 'phone']);
    }
}
