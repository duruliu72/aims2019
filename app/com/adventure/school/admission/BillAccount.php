<?php

namespace App\com\adventure\school\admission;

use Illuminate\Database\Eloquent\Model;

class BillAccount extends Model
{
    protected $table="bill_accounts";
	protected $fillable = ['programofferid','sender_receiver','amount','transactionid','payment_type','methodid','from_account','to_account','payment_date','approved_date','short_desc','status'];
	public function generateAdmissionRoll($sender_receiver){
		$sql="SELECT 
		bill_accounts.programofferid,
		bill_accounts.sender_receiver ,
		sum(bill_accounts.amount)  AS amount,
		IF(sum(bill_accounts.amount)>=500, 1, 0) AS checkstatus
		FROM `bill_accounts` WHERE sender_receiver=? GROUP BY sender_receiver";
		$qresult=\DB::select($sql,[$sender_receiver]);
		$result=collect($qresult)->first();
		// Admission Roll  create Here
		if($result->checkstatus==1){
			$sql="SELECT * FROM `applicants` WHERE programofferid=? ORDER BY admssion_roll DESC";
			$qresult=\DB::select($sql,[$result->programofferid]);
			$admssionroll=0;
			$aObj=collect($qresult)->first();
		    $admssion_roll=$aObj->admssion_roll;
		    if($admssion_roll!=null){
		       $admssionroll=$admssion_roll+1;
		       // check given applicant roll created or not
		       $sql="SELECT * FROM `applicants` WHERE programofferid=? AND applicantid=?";
		       $qresult=\DB::select($sql,[$result->programofferid,$sender_receiver]);
		       $aObj=collect($qresult)->first();
		       if($aObj->admssion_roll==null){
		       		\DB::table('applicants')
		            ->where('applicantid',$sender_receiver)
		            ->update(['admssion_roll' => $admssionroll]);
		       }
		    }else{
		    	$admssionroll=substr($result->sender_receiver, 0,2)."00001";
		    	\DB::table('applicants')
		            ->where('applicantid',$sender_receiver)
		            ->update(['admssion_roll' => $admssionroll]);
		    }
		}
	}
	
}
