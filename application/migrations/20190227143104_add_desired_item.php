<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Migration_Add_desired_item extends CI_Migration {

        public function up()
        {
                $this->dbforge->add_field(array(
                        'desired_item_id' => array(
                                'type' => 'INT',
                                'constraint' => 11,
                                'unsigned' => TRUE,
                                'auto_increment' => TRUE
                        ),
                        'desired_item_name' => array(
                                'type' => 'VARCHAR',
                                'constraint' => '100',
                        ),
                        'desired_item_status' => array(
                                'type' => 'TINYINT',
                                'constraint' => '1',
                                'default'=>'1'
                        ),//
                        'user_id' => array(
                            'type' => 'int',
                            'constraint' => 10,
                            'unsigned' => TRUE,
                            'null' => FALSE,
                            'foreign_key' => array( //relationship
                            'table' => 'user', // table to
                            'field' => 'user_id',
                            'auto_increment' => FALSE // field to
                            )),
                        'category_id' => array(
                            'type' => 'int',
                            'constraint' => 10,
                            'unsigned' => TRUE,
                            'null' => FALSE,
                            'foreign_key' => array( //relationship
                            'table' => 'category', // table to
                            'field' => 'category_id', 
                            'auto_increment' => FALSE// field to
                            )),
                    
                        
                ));
               
                $this->dbforge->add_field("`created_by` int NOT NULL ");
                $this->dbforge->add_field("`created_on` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP");
                $this->dbforge->add_field("`modified_by` int NULL ");
                $this->dbforge->add_field("`modified_on` timestamp NULL DEFAULT CURRENT_TIMESTAMP");
                $this->dbforge->add_field("`deleted_by` int NULL");
                $this->dbforge->add_field("`deleted` tinyint NOT NULL DEFAULT 0");
                $this->dbforge->add_field("`deleted_on` timestamp NULL DEFAULT CURRENT_TIMESTAMP");
                $this->dbforge->add_key('desired_item_id', TRUE);
                $this->dbforge->create_table('desired_item');
        }

        public function down()
        {
                $this->dbforge->drop_table('desired_item');
        }
}