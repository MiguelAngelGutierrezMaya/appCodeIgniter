<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Migration_Create_Quotes extends CI_Migration {

        public function up()
        {
                $this->dbforge->add_field(array(
                        'id' => array(
                                'type' => 'INT',
                                'constraint' => 10,
                                'unsigned' => TRUE, //No se puede almacenar valores negativos si es TRUE
                                'auto_increment' => TRUE
                        ),
                        'quote_date' => array(
                                'type' => 'DATETIME',
                                'null' => FALSE,
                        ),
                        'password' => array(
                                'type' => 'VARCHAR',
                                'constraint' => '130',
                                'null' => FALSE,
                        ),
                        'type_quote' => array(
                                'type' => 'VARCHAR',
                                'constraint' => '150',
                                'null' => FALSE,
                        ),
                        'state_quote' => array(
                                'type' => 'TINYINT',
                                'constraint' => 1,
                                'null' => TRUE,
                                'default' => 0,
                        ),
                        'description' => array(
                                'type' => 'TEXT',
                                'null' => FALSE,
                        ),
                        'details' => array(
                                'type' => 'TEXT',
                                'null' => TRUE,
                        ),
                        'id_user' => array(
                                'type' => 'INT',
                                'constraint' => 10,
                                'unsigned' => TRUE, //No se puede almacenar valores negativos si es TRUE
                                'null' => FALSE,
                        ),
                ));
                $this->dbforge->add_key('id', TRUE);
                $this->dbforge->create_table('quotes');
                $this->db->query('ALTER TABLE `quotes` ADD CONSTRAINT `quotes_ibfk_1` FOREIGN KEY (`id_user`) REFERENCES `users` (`id`) ON DELETE CASCADE');
        }

        public function down()
        {
                $this->dbforge->drop_table('quotes');
        }
}