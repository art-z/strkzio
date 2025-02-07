<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%track}}`.
 */
class m250206_092415_create_track_table extends Migration
{

    public function safeUp()
    {
        $this->createTable('{{%track}}', [
            'id' => $this->primaryKey(),
            'track_number' => $this->string()->unique(),
            'status' => $this->string(),
            'created_at' => $this->integer(11),
            'updated_at' => $this->integer(11)

            /*
            id – первичный ключ;
track_number – уникальный идентификатор или номер трека;
created_at – дата и время создания записи (заполняется автоматически);
updated_at – дата и время последнего обновления записи (заполняется автоматически);
status – статус трека (может принимать одно из пяти значений).

*/
        ]);
    }

    public function safeDown()
    {
        $this->dropTable('{{%track}}');
    }
}
