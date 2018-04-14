DELIMITER $$
CREATE FUNCTION get_entry_year(sid VARCHAR(10))
RETURNS INTEGER(4) DETERMINISTIC
BEGIN
	DECLARE ret INTEGER(4);
    SELECT entry_year INTO ret
    FROM student
    WHERE sid = student_id;
    RETURN ret;
END $$
DELIMITER ;

CREATE TABLE IF NOT EXISTS bill(
    student_id VARCHAR(10) NOT NULL,
    academic_year INTEGER(4) NOT NULL,
    semester INTEGER(1) NOT NULL,
    amount DECIMAL,
    payment_status ENUM('Paid','Unpaid','Late1','Late2'),
    CONSTRAINT bill_pk PRIMARY KEY (student_id,semester,academic_year),
    CONSTRAINT bill_fk FOREIGN KEY (student_id) REFERENCES student(student_id),
    CONSTRAINT bill_year CHECK(academic_year >= get_entry_year(student_id)),
    CONSTRAINT bill_semester CHECK(semester > 0 AND semester <= 3)
);
