<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Migration_Create_Users extends CI_Migration {

        public function up()
        {
                $this->dbforge->add_field(array(
                        'id' => array(
                                'type' => 'INT',
                                'constraint' => 10,
                                'unsigned' => TRUE, //No se puede almacenar valores negativos si es TRUE
                                'auto_increment' => TRUE
                        ),
                        'username' => array(
                                'type' => 'VARCHAR',
                                'constraint' => '30',
                                'null' => FALSE,
                        ),
                        'password' => array(
                                'type' => 'VARCHAR',
                                'constraint' => '130',
                                'null' => FALSE,
                        ),
                        'first_name' => array(
                                'type' => 'VARCHAR',
                                'constraint' => '100',
                                'null' => FALSE,
                        ),
                        'last_name' => array(
                                'type' => 'VARCHAR',
                                'constraint' => '100',
                                'null' => FALSE,
                        ),
                        'email' => array(
                                'type' => 'VARCHAR',
                                'constraint' => '80',
                                'null' => FALSE,
                        ),
                        'last_session' => array(
                                'type' => 'DATETIME',
                                'null' => TRUE,
                        ),
                        'state' => array(
                                'type' => 'TINYINT',
                                'constraint' => 1,
                                'null' => TRUE,
                                'default' => 0,
                        ),
                        'token' => array(
                                'type' => 'VARCHAR',
                                'constraint' => '40',
                                'null' => TRUE,
                        ),
                        'token_password' => array(
                                'type' => 'VARCHAR',
                                'constraint' => '100',
                                'null' => TRUE,
                        ),
                        'password_request' => array(
                                'type' => 'TINYINT',
                                'constraint' => 1,
                                'null' => TRUE,
                                'default' => 0,
                        ),
                        'type' => array(
                                'type' => 'TINYINT',
                                'constraint' => 1,
                                'null' => TRUE,
                                'default' => 0,
                        ),
                        /*'blog_description' => array(
                                'type' => 'TEXT',
                                'null' => TRUE,
                        ),*/
                ));
                $this->dbforge->add_key('id', TRUE);
                $this->dbforge->create_table('users');
        }

        public function down()
        {
                $this->dbforge->drop_table('users');
        }
}