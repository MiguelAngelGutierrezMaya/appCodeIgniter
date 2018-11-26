<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Migration_Create_Files extends CI_Migration {

        public function up()
        {
                $this->dbforge->add_field(array(
                        'id' => array(
                                'type' => 'INT',
                                'constraint' => 10,
                                'unsigned' => TRUE, //No se puede almacenar valores negativos si es TRUE
                                'auto_increment' => TRUE
                        ),
                        'file_date' => array(
                                'type' => 'DATETIME',
                                'null' => FALSE,
                        ),
                        'type_file' => array(
                                'type' => 'VARCHAR',
                                'constraint' => '150',
                                'null' => FALSE,
                        ),
                        'file_name' => array(
                                'type' => 'VARCHAR',
                                'constraint' => '150',
                                'null' => FALSE,
                        ),
                        'url' => array(
                                'type' => 'TEXT',
                                'null' => FALSE,
                        ),
                        'id_user' => array(
                                'type' => 'INT',
                                'constraint' => 10,
                                'unsigned' => TRUE, //No se puede almacenar valores negativos si es TRUE
                                'null' => FALSE,
                        ),
                ));
                $this->dbforge->add_key('id', TRUE);
                $this->dbforge->create_table('files');
                $this->db->query('ALTER TABLE `files` ADD CONSTRAINT `files_ibfk_1` FOREIGN KEY (`id_user`) REFERENCES `users` (`id`) ON DELETE CASCADE');
        }

        public function down()
        {
                $this->dbforge->drop_table('files');
        }
}