<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Migration_Add_user extends CI_Migration {

        public function up()
        {
                $this->dbforge->add_field(array(
                        'user_id' => array(
                                'type' => 'INT',
                                'constraint' => 11,
                                'unsigned' => TRUE,
                                'auto_increment' => TRUE
                        ),
                        'first_name' => array(
                                'type' => 'VARCHAR',
                                'constraint' => '100',
                        ),
                        'last_name' => array(
                                'type' => 'VARCHAR',
                                'constraint' => '100',
                        ),
                        'profile_icon' => array(
                            'type' => 'VARCHAR',
                            'constraint' => '100',
                        ),
                        'profile_thumb' => array(
                            'type' => 'VARCHAR',
                            'constraint' => '255',
                        ),                        
                        'phone_number' => array(
                            'type' => 'VARCHAR',
                            'constraint' => '100',
                        ),
                        'username' => array(
                            'type' => 'VARCHAR',
                            'constraint' => '100',
                            
                        ),
                        'user_email' => array(
                            'type' => 'VARCHAR',
                            'constraint' => '100',
                           
                        ),
                        'password' => array(
                            'type' => 'VARCHAR',
                            'constraint' => '100',
                            
                        ),
                        'user_type' => array(
                            'type' => 'VARCHAR',
                            'constraint' => '100',
                            
                        ),
                        'user_status' => array(
                            'type' => 'TINYINT',
                            'constraint' => '1',
                            'default'=>'1'
                        ),
                        //
                        'user_type_id' => array(
                            'type' => 'int',
                            'constraint' => 10,
                            'unsigned' => TRUE,
                            'null' => FALSE,
                            'foreign_key' => array( //relationship
                            'table' => 'user_type', // table to
                            'field' => 'user_type_id',
                            'auto_increment' => FALSE // field to
                            )),
                        'location_id' => array(
                            'type' => 'int',
                            'constraint' => 10,
                            'unsigned' => TRUE,
                            'null' => FALSE,
                            'foreign_key' => array( //relationship
                            'table' => 'location', // table to
                            'field' => 'location_id', 
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
                $this->dbforge->add_key('user_id', TRUE);
                $this->dbforge->create_table('user');
        }

        public function down()
        {
                $this->dbforge->drop_table('user');
        }
}