<?php

use Illuminate\Database\Migrations\Migration;

class CreateUserCompanyProjectViewView extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        \DB::statement('
            CREATE VIEW user_company_project_view AS
            SELECT company_user.user_id, company_user.company_id, projects.id AS project_id
            FROM company_user
            LEFT JOIN projects
            ON company_user.company_id = projects.company_id
        ');
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        \DB::statement('DROP VIEW user_company_project_view');
    }
}
