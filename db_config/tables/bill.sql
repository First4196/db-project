CREATE TABLE IF NOT EXISTS bill(
    student_id VARCHAR(10) NOT NULL,
    academic_year INTEGER(4) NOT NULL,
    semester INTEGER(1) NOT NULL,
    amount DECIMAL,
    payment_status ENUM('Paid','Unpaid','Late1','Late2'),
    CONSTRAINT bill_pk PRIMARY KEY (student_id,semester,academic_year),
    CONSTRAINT bill_fk FOREIGN KEY (student_id) REFERENCES student(student_id)
);
