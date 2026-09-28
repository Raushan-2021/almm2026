<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class InstallationReviewLog extends Model
{
	protected $fillable = ['installation_id','review','docs','review_type','review_action','created_by'];

	public static function getLogs($installtionId)
	{
		return self::select(
						'installation_review_logs.review_type',
						'installation_review_logs.review',
						'installation_review_logs.review_action',
						'installation_review_logs.docs',
						'installation_review_logs.created_at',
						'state_implementing_agency_users.name as agency_username',
						'inspectors.name as inspector_username'
					)->where('installation_id', $installtionId)
					->leftjoin('state_implementing_agency_users', function ($join) {
						$join->on('state_implementing_agency_users.id', 'installation_review_logs.created_by')
							 ->where('installation_review_logs.review_type', 'A');
					})
					->leftjoin('inspectors', function ($join) {
						$join->on('inspectors.id', 'installation_review_logs.created_by')
							 ->where('installation_review_logs.review_type', 'I');
					})->get();
	}
}
