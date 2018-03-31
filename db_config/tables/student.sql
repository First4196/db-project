CREATE TABLE IF NOT EXISTS student(
    student_id VARCHAR(11) NOT NULL,
    name VARCHAR(50),
    nameEN VARCHAR(50),
    CONSTRAINT student_pk PRIMARY KEY (student_id)
);