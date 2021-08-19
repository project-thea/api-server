<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use App\Models\Subject;
use App\Models\Project;
use App\Models\Questionnaire;
use App\Models\User;
use Inertia\Inertia;
use Illuminate\Support\Facades\DB;

class DashboardController extends Controller
{
	public function index()
	{
		//Get daily counts of subjects, questionnaires, projects, and users for the last 7 days
		$summary_query = "
			SELECT 
				t1.the_date AS the_date, 
				COUNT(t2.id) AS num_subjects,
				COUNT(t3.id) AS num_questionnaires,
				COUNT(t4.id) AS num_projects,
				COUNT(t5.id) AS num_users
			FROM (
				SELECT DATE(cal.date) AS the_date
				FROM (
					  SELECT SUBDATE(NOW(), INTERVAL 7 DAY) + INTERVAL xc DAY AS date
					  FROM (
							SELECT @xi:=@xi+1 as xc from
							(SELECT 1 UNION SELECT 2 UNION SELECT 3 UNION SELECT 4) xc1,
							(SELECT 1 UNION SELECT 2 UNION SELECT 3 UNION SELECT 4) xc2,
							(SELECT 1 UNION SELECT 2 UNION SELECT 3 UNION SELECT 4) xc3,
							(SELECT 1 UNION SELECT 2 UNION SELECT 3 UNION SELECT 4) xc4,
							(SELECT @xi:=-1) xc0
					  ) xxc1
				) cal
				WHERE cal.date <= NOW()
				ORDER BY cal.date ASC
			) AS t1 
			LEFT JOIN subjects t2 ON t1.the_date = DATE_FORMAT(t2.created_at,'%Y-%m-%d')
			LEFT JOIN questionnaires t3 ON t1.the_date = DATE_FORMAT(t3.created_at,'%Y-%m-%d')
			LEFT JOIN projects t4 ON t1.the_date = DATE_FORMAT(t4.created_at,'%Y-%m-%d')
			LEFT JOIN users t5 ON t1.the_date = DATE_FORMAT(t5.created_at,'%Y-%m-%d')
			GROUP BY t1.the_date
		";

		$summary  = DB::select($summary_query);
		
		return Inertia::render('Dashboard', [
			'num_subjects' => Subject::count(),
			'num_questionnaires' => Questionnaire::count(),
			'num_projects' => Project::count(),
			'num_users' => User::count(),
			'data' => $summary
		]);
	}
}
