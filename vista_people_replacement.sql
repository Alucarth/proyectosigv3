create view people_replacement as
select concat_ws(' ', people.nombres, people.paterno, people.materno)  as nombres, people.ci, users.email , replacements.*, institutions.razon_social 
from replacements
join contracts on contracts.id = replacements.contract_id 
join people  on people.id = contracts.person_id
join institutions  on institutions.id = contracts.institution_id
join officials  on officials.id = replacements.official_id 
join users on users.id =officials.user_id ;