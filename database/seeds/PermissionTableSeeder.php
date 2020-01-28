<?php


use Illuminate\Database\Seeder;

use Spatie\Permission\Models\Permission;


class PermissionTableSeeder extends Seeder

{

    /**

     * Run the database seeds.

     *

     * @return void

     */

    public function run()

    {

       $permissions = [

           'role-list',
           'role-create',
           'role-edit',
           'role-delete',

           'invoice-list',
           'invoice-create',
           'invoice-edit',
           'invoice-delete',

           'product-list',
           'product-create',
           'product-edit',
           'product-delete',

           'user-list',
           'userWorker-create',
           'userMaster-create',
           'user-create',
           'user-edit',
           'user-delete'

        ];


        foreach ($permissions as $permission) {

             Permission::create(['name' => $permission]);

        }

    }

}