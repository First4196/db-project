CREATE TABLE IF NOT EXISTS student(
    student_id VARCHAR(11) NOT NULL,
    name VARCHAR(50),
    name_en VARCHAR(50),
    date_of_birth DATE,
    address VARCHAR(100),
    mobile_no VARCHAR(15),
    email VARCHAR(50),
    entry_year INTEGER(4),
    graduated BOOLEAN,
    gpax DOUBLE,
    credit INTEGER(3),
    CONSTRAINT student_pk PRIMARY KEY (student_id)
);