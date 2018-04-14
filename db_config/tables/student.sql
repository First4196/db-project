CREATE TABLE IF NOT EXISTS student(
    student_id VARCHAR(10) NOT NULL,
    fname_th VARCHAR(50) NOT NULL,
    lname_th VARCHAR(50) NOT NULL,
    fname_en VARCHAR(50),
    lname_en VARCHAR(50),
    gender ENUM('M', 'F'),
    date_of_birth DATE,
    address VARCHAR(100),
    mobile_no VARCHAR(15),
    email VARCHAR(50),
    entry_year INTEGER(4),
    graduated BOOLEAN,
    gpax DOUBLE,
    credit_gain INTEGER(3),
    curriculum CHAR(5),
    department CHAR(4),
    advisor VARCHAR(30),
    CONSTRAINT student_pk PRIMARY KEY (student_id),
    CONSTRAINT student_fk1 FOREIGN KEY (curriculum) REFERENCES curriculum(curriculum_id),
    CONSTRAINT student_fk2 FOREIGN KEY (department) REFERENCES department(department_id),
    CONSTRAINT student_fk3 FOREIGN KEY (advisor) REFERENCES professor(professor_id),
	CONSTRAINT student_age CHECK(TIMEDIFF(date_of_birth, CURDATE()) > 14),
    CONSTRAINT student_mobile_no CHECK(mobile_no REGEXP '^[+]{0,1}[0-9]+$'),
    CONSTRAINT student_email CHECK(email LIKE '%_@__%.__%'),
    CONSTRAINT student_grade CHECK(gpax >= 0.0 AND gpax <=4.0),
    CONSTRAINT student_non_neg_credit CHECK(credit_gain >= 0)
);
