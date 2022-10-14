SELECT concat(p.f_name,' ',p.l_name) AS full_name, users.email, users.phone_code as phone_code_id, users.contact_number, 
country.name AS country_name, country.phonecode AS phone_code, appointment.id AS appointment_id, appointment.ap_date 
FROM user_appointment
JOIN appointment ON user_appointment.appointment_id = appointment.id
JOIN users ON appointment.doctor_id = users.id



SELECT * FROM users_appointment 
WHERE doctor_id = 17;


SELECT concat(p.f_name,' ',p.l_name) AS full_name, p.email, p.phone_code as phone_code_id, p.phone_number, 
country.name AS country_name, country.phonecode AS phone_code, appointment.id AS appointment_id, appointment.ap_date 
FROM user_appointment 
JOIN appointment ON user_appointment.appointment_id = appointment.id
JOIN users p ON user_appointment.patient_id = p.id
JOIN country ON p.country_id = country.id
JOIN country phone ON p.phone_code = phone.id
WHERE doctor_id = 17 GROUP BY user_appointment.patient_id;



SELECT count(*) FROM user_appointment 
JOIN appointment ON user_appointment.appointment_id = appointment.id
WHERE doctor_id = 17 GROUP BY user_appointment.patient_id;







