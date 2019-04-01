<?php

namespace App\com\adventure\school\employee;

use Illuminate\Database\Eloquent\Model;

class Employee extends Model
{
    protected $table="employees";
    protected $fillable = ['employeeidno','employeetypeid','designationid','departmentid','employmentstatusid','employeestatusid','joining_date','retirement_date','employeeposition','first_name','middle_name','last_name','father_name','mother_name','genderid','mobileno','dob','birthregno','nationalityid','nationalidno','bloodgroupid','marital_statusid','email','present_addressid','picture','signature','indexno','status'];
    public function getEmployees(){
        $sql="SELECT 
        employees.id,
        employees.employeeidno,
        CONCAT(employees.first_name,' ',employees.middle_name,' ',employees.last_name) AS name,
        genders.name AS genderName,
        employees.mobileno,
        designations.name AS designationName,
        departments.name AS departmentName,
        employeetypes.name AS employeeName,
        employmentstatus.name AS employmentstatusName,
        employees.picture
        FROM `employees`
        INNER JOIN employeetypes ON employees.employeetypeid=employeetypes.id
        INNER JOIN designations ON employees.designationid=designations.id
        INNER JOIN departments ON employees.departmentid=departments.id
        INNER JOIN employeestatus ON employees.employeestatusid=employeestatus.id
        INNER JOIN employmentstatus ON employees.employmentstatusid=employmentstatus.id
        INNER JOIN genders ON employees.genderid=genders.id
        INNER JOIN nationalities ON employees.nationalityid=nationalities.id
        INNER JOIN blood_groups ON employees.bloodgroupid=blood_groups.id
        INNER JOIN maritalstatus ON employees.marital_statusid=maritalstatus.id
        ORDER BY employees.id";
        $qResult=\DB::select($sql);
        $result=collect($qResult);
        return $result;
    }
    public function generateEmployeeIdNo(){
        $sql="SELECT * FROM `employees` ORDER BY `employeeidno` DESC";
        $qResult=\DB::select($sql);
        $result=collect($qResult);
        if($result->count()!=0){
            $employeeidno=$result->first()->employeeidno;
            $employeeidno=$employeeid+1;
        }else{
            $employeeidno=(int)(substr(date("Y"), 2)."00001");
        }
        return $employeeidno;
    }
}


// $isExist=realpath('admin/images/logo/'.$post->logo);
//         if($isExist){
//            unlink('admin/images/logo/'.$country->logo);
//         }
