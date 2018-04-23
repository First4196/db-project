CREATE TABLE IF NOT EXISTS bill(
    student_id VARCHAR(10) NOT NULL,
    academic_year INTEGER(4) UNSIGNED NOT NULL,
    semester INTEGER(1) UNSIGNED NOT NULL,
    amount DECIMAL UNSIGNED,
    payment_status ENUM('Paid','Unpaid','Late1','Late2'),
    CONSTRAINT bill_pk PRIMARY KEY (student_id,semester,academic_year),
    CONSTRAINT bill_fk FOREIGN KEY (student_id) REFERENCES student(student_id),
    CONSTRAINT bill_year CHECK(academic_year >= get_entry_year(student_id)),
    CONSTRAINT bill_semester CHECK(semester BETWEEN 1 AND 3)
);
