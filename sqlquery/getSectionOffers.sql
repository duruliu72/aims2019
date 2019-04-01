SELECT sectionoffer.*,
CONCAT(employees.first_name,' ',employees.middle_name,' ',employees.last_name) AS employeeName
FROM `sectionoffer`
left JOIN employees ON sectionoffer.employeeid=employees.id
WHERE sectionoffer.programofferid=1 ORDER BY sectionoffer.sectionid;