<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Migration_Add_image extends CI_Migration {

        public function up()
        {
                $this->dbforge->add_field(array(
                        'image_id' => array(
                                'type' => 'INT',
                                'constraint' => 11,
                                'unsigned' => TRUE,
                                'auto_increment' => TRUE
                        ),
                        'item_image_name' => array(
                                'type' => 'VARCHAR',
                                'constraint' => '255',
                        ),
                        'profile_thumb' => array(
                                'type' => 'VARCHAR',
                                'constraint' => '255',
                        ),
                                           
                        'image_status' => array(
                            'type' => 'TINYINT',
                            'constraint' => '1',
                            'default'=>'1'
                        ),
                        'item_id' => array(
                                'type' => 'int',
                                'constraint' => 10,
                                'unsigned' => TRUE,
                                'null' => FALSE,
                                'foreign_key' => array( //relationship
                                'table' => 'item', // table to
                                'field' => 'item_id',
                                'auto_increment' => FALSE // field to
                                )),
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
                        
                ));
               
                $this->dbforge->add_field("`created_by` int NOT NULL ");
                $this->dbforge->add_field("`created_on` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP");
                $this->dbforge->add_field("`modified_by` int NULL ");
                $this->dbforge->add_field("`modified_on` timestamp NULL DEFAULT CURRENT_TIMESTAMP");
                $this->dbforge->add_field("`deleted_by` int NULL");
                $this->dbforge->add_field("`deleted` tinyint NOT NULL DEFAULT 0");
                $this->dbforge->add_field("`deleted_on` timestamp NULL DEFAULT CURRENT_TIMESTAMP");
                $this->dbforge->add_key('image_id', TRUE);
                $this->dbforge->create_table('image');
        }

        public function down()
        {
                $this->dbforge->drop_table('image');
        }
}