<?php


use Phinx\Migration\AbstractMigration;

class Admins extends AbstractMigration
{
    /**
     * Change Method.
     *
     * Write your reversible migrations using this method.
     *
     * More information on writing migrations is available here:
     * http://docs.phinx.org/en/latest/migrations.html#the-abstractmigration-class
     *
     * The following commands can be used in this method and Phinx will
     * automatically reverse them when rolling back:
     *
     *    createTable
     *    renameTable
     *    addColumn
     *    renameColumn
     *    addIndex
     *    addForeignKey
     *
     * Remember to call "create()" or "update()" and NOT "save()" when working
     * with the Table class.
     */
    public function change()
    {
      // create the table
      $table = $this->table('admins');
      $table->addColumn('username', 'string')
            ->addColumn('permission_flag','integer')
            ->addColumn('group_id','integer',['null'=>true,'default'=>null])
            ->addColumn('password', 'string')
            ->addColumn('email', 'string')
            ->addColumn('temp_password','string',['null'=>true,'default'=>null])
            ->addIndex(['group_id'])
            ->addForeignKey('group_id', 'groups', 'id')
            ->create();

    }
}
