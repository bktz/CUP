<?php

class AdminDashboardController extends AdminController {

	/**
	 * Admin dashboard
	 *
	 */
	public function getIndex(){

		// Count how many projects are in each state
		$application = Project::where('state', '=', 'Application')->count();
		$available = Project::where('state', '=', 'Available')->count();
		$inProgress = Project::where('state', '=', 'InProgress')->count();
		$complete = Project::where('state', '=', 'Complete')->count();
		$canceled = Project::where('state', '=', 'Canceled')->count();
		$na = Project::where('state', '=', 'NA')->count();

		$states = Array('Application' => $application,
						'Available' => $available,
						'InProgress' => $inProgress,
						'Complete' => $complete,
						'Canceled' => $canceled,
						'NA' => $na);

		return View::make('admin/dashboard', compact('states'));
	}

}