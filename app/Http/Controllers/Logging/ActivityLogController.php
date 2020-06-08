<?php

namespace App\Http\Controllers\Logging;

use App\Http\Controllers\Controller;
use App\User;
use Carbon\Carbon;
use Spatie\Activitylog\Models\Activity;

class ActivityLogController extends Controller {
	public function index() {
		$dates = Activity::pluck("created_at")->groupBy(function ($value) {
			return Carbon::parse($value)->format("Y-m-d");
		});

		$users_ids = Activity::groupBy("causer_id")->pluck("causer_id");
		$users_info = User::whereIn("id", $users_ids)->pluck("name", "id");

		$selected_date = "all";
		if (isset($_GET['date']) && $_GET['date'] != "") {
			$selected_date = $_GET['date'];
		}

		$selected_user = "all";
		if (isset($_GET['user_id']) && (int) $_GET['user_id'] != "") {
			$selected_user = (int) $_GET['user_id'];
		}

		if ($selected_user != "all" && $selected_date != "all") {
			$activities = Activity::where("causer_id", $selected_user)
				->whereDate("created_at", $selected_date)->latest()->paginate(15);
		} else if ($selected_user != "all" && $selected_date == "all") {
			$activities = Activity::where("causer_id", $selected_user)->latest()->paginate(15);
		} else if ($selected_user == "all" && $selected_date != "all") {
			$activities = Activity::whereDate('created_at', $selected_date)->latest()->paginate(15);
		} else {
			$activities = Activity::latest()->paginate(15);
		}

		return view("logging.index",
			compact("activities", "users_info", "selected_user", "dates", "selected_date"));
	}

	public function show($id) {
		return Activity::find($id);
	}
}
