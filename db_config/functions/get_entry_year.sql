CREATE FUNCTION get_entry_year(sid VARCHAR(10)) 
RETURNS INTEGER(4) DETERMINISTIC
BEGIN
	DECLARE ret INTEGER(4);
    SELECT entry_year INTO ret
    FROM student
    WHERE sid = student_id;
    RETURN ret;
END