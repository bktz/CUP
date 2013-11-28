<?php

use Robbo\Presenter\Presenter;

class ProjectPresenter extends Presenter{
	public function presentState()	{
		switch ($this->object->state) {
			case "Application":
				return "Application";
				break;
			case "Available":
				return "Available";
				break;
			case "InProgress":
				return "In Progress";
				break;
			case "Complete":
				return "Complete";
				break;
			case "Canceled":
				return  "Canceled";
				break;
			case "NA":
				return "N/A";
				break;
			default:
				return $this->object->state;
		}
	}

	public function presentExpectedtime() {
		switch ($this->object->expected_time) {
			case "lessMonth":
				return "Less than a month";
				break;
			case "aMonth":
				return "A month";
				break;
			case "fourMonths":
				return "Four months";
				break;
			case "eightMonths":
				return "Eight months";
				break;
			case "ayear":
				return  "A year";
				break;
			case "moreYear":
				return "More than a year";
				break;
			default:
				return $this->object->expected_time;
		}
	}
}