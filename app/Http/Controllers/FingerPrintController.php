<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\com\adventure\school\basic\Institute;
use App\com\adventure\school\menu\Menu;
use DB;
use App\SendSms;

class FingerPrintController extends Controller
{
    public function __construct()
    {
        //$this->middleware('auth');
    }
    public function index()
    {
        $aMenu=new Menu();
        $sidebarMenu=$aMenu->getSidebarMenu();
        $dataList=[
            'institute'=>Institute::getInstituteName(),
            'sidebarMenu'=>$sidebarMenu
        ];
        return view('adminhome',$dataList);
    }

    //call when getting request from fingerprint machine
    public function take_attendance(Request $request) {

    	date_default_timezone_set("Asia/Dhaka");
	    $device_id = $request->input('device_id') ?? null;
	    $card_no = $request->input('card_no') ?? null;
	    $date_time = $request->input('date_time') ?? null;

	    if ( $device_id && $card_no && $date_time ) {
	        
	        $check = $this->checkEmployee($card_no);

	        //dd( $check );

	        if (!$check) {
	            $this->studentFinger($card_no, $device_id, $date_time);
	        } else {
	            $this->employeeFinger($card_no, $device_id, $date_time);
	        }

	    } else {
	    	dd('Action failed....');
	    }

    	//dd( $request->all() );
    }


    //Checking employee
    function checkEmployee($employeeId = 0) {
        $check = false;
        $emp = DB::table('employees')
        	->where('employeeidno', $employeeId)
        	->get();

        if ($emp->count() > 0) {
            $check = true;
        }
        return $check;
    }


    function getLastProgramOfferId($student_id = 0) {
        //print_r($student_id);exit;

        /*$sql = "
            SELECT 
                programOfferId
            FROM 
                promotedstudent 
            WHERE
                studentId = {$student_id}
            ORDER BY 
                promotionId DESC 
            LIMIT 1
            ";
        $query = mysqli_query($conn, $sql);
        $row = mysqli_fetch_assoc($query);*/

        $po_result = DB::table('students')
        	->select('programofferid')
        	->where('r_studentid', $student_id)
        	->where('currentclass', 1);

        $programOfferId = 0;
        if ($po_result->count() > 0) {
        	$programOfferId = $po_result->first()->programofferid;
        }

        //$programOfferId = isset($row['programOfferId']) ? $row['programOfferId'] : 0;
       // print_r($programOfferId);exit;
        return $programOfferId;
    }


    //......
    function studentFinger($student_id, $device_id, $date_time) {
        $programOfferId = 0;
        if ($student_id) {
            $programOfferId = $this->getLastProgramOfferId($student_id);
            //die('I am at line: '.$programOfferId.' '.__LINE__);
        }

        //$sendsms = new SendSms();
	    //$sendsms->MessageSend('01746736936', 'TT1234');

        $result = DB::table('event_log')
        	->where('device_id', $device_id)
        	->where('student_id', $student_id)
        	->where('date_time', $date_time)
        	->get();

        if ( $result->count() > 0 ) {
             die("Connect");
        } else {

            $isn_data['device_id'] = $device_id;
            $isn_data['student_id'] = $student_id;
            $isn_data['date_time'] = $date_time;
            $isn_data['programOfferId'] = $programOfferId;

            $sqlresult = DB::table('event_log')->insert($isn_data);

            if($sqlresult){

                $resultp = DB::table('lastsms')
                	->where('type', 1)
                	->get();

                $lastsms = null;
                if ($resultp->count() > 0) {
                	$lastsms = $resultp->first()->lastsms_student_id;
                }

                $smsresult = DB::table('event_log')
                	->select(
                		'event_log.sl', 'event_log.device_id', 'event_log.student_id', DB::raw('from_unixtime(event_log.date_time) as ptime'), 'applicants.firstName', 'applicants.middleName', 'applicants.lastName', 'applicants.father_Phone'
                	)
                	->join('students', 'students.studentId', '=', 'event_log.student_id')
                	->join('applicants', 'applicants.applicantid', '=', 'students.applicantid')
                	->where('event_log.student_id', $student_id)
                	->groupBy('event_log.student_id')
                	->get();

                
                if ( $smsresult->count() > 0 ) {

                   $row = $smsresult->first();

                   $splitTime = date('H:i:s', $date_time );

                   $split_dt = new \DateTime();
                   $split_dt->setTimestamp($date_time);
                   $date_now = $split_dt->format('d-M-Y h:i a');
                   
                   $formatted_splittime = $split_dt->format('h:i:s');
                   
                   $splitTime = $formatted_splittime;
                   
                   $to = $row->father_Phone;

                   //dd($to);

                   if ( empty($to) ) {
                   		echo '<b>Mobile number not found.</b>';
                   		return;
                   }

                   $student_name = $row->firstName." ".$row->middleName." ".$row->lastName;
                   $message = "Dear Parents, Your Child ".$student_name.", ID: " . $row->student_id;

                   $message_ok = true;


                    if($lastsms != $row->student_id && $splitTime >= '06:00:00' && $splitTime <= '08:10:00'){

                        $message = $message .  " is Attend at Time : $date_now In School. Thanks.";

                    }else if($lastsms != $row->student_id && $splitTime >= '08:11:00' && $splitTime <= '08:45:00'){

                        $message = $message .  " is Late at Time : $date_now In School. Thanks.";

                    }else if($lastsms != $row->student_id && $splitTime >= '10:00:00' && $splitTime <= '10:59:00'){

                        $message = $message .  " is Late at Time : $date_now In School. Thanks for Receiving your child.";
                                
                    }else if($lastsms != $row->student_id && $splitTime >= '11:00:00' && $splitTime <= '11:40:00'){

                        $message = $message .  " is Late at Time : $date_now In School. Thanks.";

                    }else if($lastsms != $row->student_id && $splitTime >= '11:41:00' && $splitTime <= '12:00:00'){

                        $message = $message .  " is Late at Time : $date_now In School. Thanks.";
                            
                    }else if($lastsms != $row->student_id && $splitTime >= '01:00:00' && $splitTime <= '04:00:00'){

                        $message = $message .  " is Leaves at Time : $date_now In School. Thanks for Receiving your child.";
                                
                    }else{
                    	$message_ok = false;
                        echo 'Already sms sent and Student is present';
                    }

                    //if checked, sending message
                    if ($message_ok) {
                    	
                    	if ( !empty($to) ) {

                    		$school_info = $this->get_school_info();

                    		$message = $message." ".$school_info->short_name.".";

                    		$sendsms = new SendSms();
	                    	if ( $sendsms->MessageSend($to, $message) ) {
	                    		echo '<b>The following message has been sent successfully.</b><br><br>';
	            				echo $message;
	                    	} else {
	                    		echo '<b>Message sending failed.</b>';
	                    	}

                    	} else {
                    		echo '<b>Mobile number not found.</b>';
                    	}
                    }

                } else{
                     echo "There is 0 results";
                }
            }  
        }   
    }

    function employeeFinger( $emp_id, $device_id, $date_time ) {

        $school_info = $this->get_school_info();
        $to = $school_info->phone_number;

        //dd($school_info);

        if ( $to == '' ) {
        	echo '<b>Mobile number not found.</b>';
        	return;
        }

        $result = DB::table('emp_event_log')
        	->where('device_id', $device_id)
        	->where('emp_id', $emp_id)
        	->where('date_time', $date_time)
        	->get();

        if ( $result->count() > 0 ){
            die("Reapet");
        } else {

            $isn_data['device_id'] = $device_id;
            $isn_data['emp_id'] = $emp_id;
            $isn_data['date_time'] = $date_time;

            $sqlresult = DB::table('emp_event_log')->insert($isn_data);

            if($sqlresult){

                $resultp = DB::table('lastsms')
                	->where('type', 2)
                	->get();

                $lastsms = null;
                if ($resultp->count() > 0) {
                	$lastsms = $resultp->first()->lastsms_student_id;
                }

                $smsresult = DB::table('emp_event_log')
                	->select(
                		'emp_event_log.id', 'emp_event_log.device_id', 'emp_event_log.emp_id', DB::raw('from_unixtime(emp_event_log.date_time) as ptime'), 'employees.first_name', 'employees.middle_name', 'employees.last_name'
                	)
                	->join('employees', 'employees.employeeidno', '=', 'emp_event_log.emp_id')
                	->where('emp_event_log.emp_id', $emp_id)
                	->groupBy('emp_event_log.emp_id')
                	->get();

                if ( $smsresult->count() > 0 ) {

                    $row = $smsresult->first();

                	$splitTime = date('H:i:s', $date_time );

                    //fixing time
                    $split_dt = new \DateTime();
                    $split_dt->setTimestamp($date_time);
                    $date_now = $split_dt->format('d-M-Y h:i a');

                    $full_name = $row->first_name." ".$row->middle_name." ".$row->last_name;
               		$message = "Dear Sir, Employee Name: ".$full_name.", ID: " . $row->emp_id;

               		$message_ok = true;

                     if($lastsms != $row->emp_id && $splitTime <= '09:00:00'){

                        $message = $message .  " is Present at Time : $date_now In Our School.";

                    }else if($lastsms != $row->emp_id && $splitTime >= '09:00:00' && $splitTime <= '12:59:59'){

                        $message = $message .  " is Late at Time : $date_now In Our School.";

                    }else if($lastsms != $row->emp_id && $splitTime >= '13:00:00' && $splitTime <= '19:00:00'){

                        $message = $message .  " is Out at Time : $date_now In Our School.";

                    }else{
                    	$message_ok = false;
                        echo 'Already sms sent and Employee is present';
                    }

                    //if checked, sending message
                    if ($message_ok) {

                    	if ($to != '') {

                    		$sendsms = new SendSms();
	                    	if ( $sendsms->MessageSend($to, $message) ) {
	                    		echo '<b>The following message has been sent successfully.</b><br><br>';
	            				echo $message;
	                    	} else {
	                    		echo '<b>Message sending failed.</b>';
	                    	}

                    	} else {
                    		echo '<b>Mobile number not found.</b>';
                    	}
                    }

                } else{
                    echo "   There is 0 results";
               }
           }  
       }   
    }


    function get_school_info() {

    	$school_info = new \stdClass();
        $school_info->name = '';
        $school_info->phone_number = '';
        $school_info->short_name = '';
        
        $result = DB::table('institutes')
        	->select('name', 'ins_mobile_no')
        	->limit(1)
        	->get();

        if ($result->count() > 0) {
        	$first_q = $result->first();
        	$school_info->name = $first_q->name;
        	$school_info->phone_number = $first_q->ins_mobile_no;

        	if ($school_info->name != '') {

	        	$str_ar = explode(" ", $school_info->name);
				foreach ($str_ar as $key => $value) {
					$str_ar[$key] = substr($value, 0, 1);
				}
				$school_info->short_name = implode($str_ar, "");
			}
        }

        return $school_info;
    }
}
