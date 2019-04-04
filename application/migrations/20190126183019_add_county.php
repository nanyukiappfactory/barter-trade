<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Migration_Add_county extends CI_Migration {

        public function up()
        {
                $this->dbforge->add_field(array(
                        'county_id' => array(
                                'type' => 'INT',
                                'constraint' => 11,
                                'unsigned' => TRUE,
                                'auto_increment' => TRUE
                        ),
                        'county_name' => array(
                                'type' => 'VARCHAR',
                                'constraint' => '100',
                        ),
                        'county_status' => array(
                                'type' => 'TINYINT',
                                'constraint' => '1',
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
                $this->dbforge->add_key('county_id', TRUE);
                $this->dbforge->create_table('county');
        }

        public function down()
        {
                $this->dbforge->drop_table('county');
        }
}