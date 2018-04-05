CREATE TABLE IF NOT EXISTS department(
    department_id INTEGER(4) NOT NULL,
    dname VARCHAR(50) NOT NULL,
    faculty CHAR(2),
    CONSTRAINT department_pk PRIMARY KEY (department_id),
    CONSTRAINT department_fk FOREIGN KEY (faculty) REFERENCES faculty(faculty_code)
);
