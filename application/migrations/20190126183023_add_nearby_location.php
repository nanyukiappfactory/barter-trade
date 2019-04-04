<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Migration_Add_nearby_location extends CI_Migration {

        public function up()
        {
                $this->dbforge->add_field(array(
                        'nearby_location_id' => array(
                                'type' => 'INT',
                                'constraint' => 11,
                                'unsigned' => TRUE,
                                'auto_increment' => TRUE
                        ),
                        'nearby_location_name' => array(
                                'type' => 'VARCHAR',
                                'constraint' => '100',
                        ),
                        'nearby_location_status' => array(
                                'type' => 'TINYINT',
                                'constraint' => '1',
                                'default'=>'1'
                        ),
                        'constituency_id' => array(
                                'type' => 'int',
                                'constraint' => 10,
                                'unsigned' => TRUE,
                                'null' => FALSE,
                                'foreign_key' => array( //relationship
                                'table' => 'constituency', // table to
                                'field' => 'constituency_id', // field to
                                ))
                ));
               
                $this->dbforge->add_field("`created_by` int NOT NULL ");
                $this->dbforge->add_field("`created_on` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP");
                $this->dbforge->add_field("`modified_by` int NULL ");
                $this->dbforge->add_field("`modified_on` timestamp NULL DEFAULT CURRENT_TIMESTAMP");
                $this->dbforge->add_field("`deleted_by` int NULL");
                $this->dbforge->add_field("`deleted` tinyint NOT NULL DEFAULT 0");
                $this->dbforge->add_field("`deleted_on` timestamp NULL DEFAULT CURRENT_TIMESTAMP");
                $this->dbforge->add_key('nearby_location_id', TRUE);
                $this->dbforge->create_table('nearby_location');
        }

        public function down()
        {
                $this->dbforge->drop_table('nearby_location');
        }
}