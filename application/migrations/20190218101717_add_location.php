<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Migration_Add_location extends CI_Migration
{

    public function up()
    {
        $this->dbforge->add_field(array(
            'location_id' => array(
                'type' => 'INT',
                'unsigned' => true,
                'auto_increment' => true,
            ),
            
            'location_name' => array(
                'type' => 'VARCHAR',
                'constraint' => '100',
                'null' => false,
            ),
            'location_parent' => array(
                'type' => 'VARCHAR',
                'constraint' => '100',
                'null' => false,
            ),
            'location_status' => array(
                'type' => 'TINYINT',
                'constraint' => '1',
                'null' => false,
                'default'=>'1'
            ),
        ));
        $this->dbforge->add_field("`created_by` int NOT NULL ");
        $this->dbforge->add_field("`created_on` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP");
        $this->dbforge->add_field("`modified_by` int NULL ");
        $this->dbforge->add_field("`modified_on` timestamp NULL DEFAULT CURRENT_TIMESTAMP");
        $this->dbforge->add_field("`deleted_by` int NULL");
        $this->dbforge->add_field("`deleted` tinyint NOT NULL DEFAULT 0");
        $this->dbforge->add_field("`deleted_on` timestamp NULL DEFAULT CURRENT_TIMESTAMP");
        $this->dbforge->add_key('location_id', true);
        $this->dbforge->create_table('location');
// $this->db->query('ALTER TABLE `partner` ADD FOREIGN KEY(`partner_type_id`) REFERENCES `partner_type`(`partner_type_id`) ON DELETE CASCADE ON UPDATE CASCADE;');
    }

    public function down()
    {
        $this->dbforge->drop_table('location');
    }
}
