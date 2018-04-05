CREATE TABLE IF NOT EXISTS professor(
    professor_id VARCHAR(11) NOT NULL,
    fname_th VARCHAR(50),
    lname_th VARCHAR(50),
    fname_en VARCHAR(50),
    lname_en VARCHAR(50),
    name_abbrev VARCHAR(3),
    date_of_birth DATE,
    address VARCHAR(100),
    mobile_no VARCHAR(15),
    email VARCHAR(50),
    department CHAR(4),
    CONSTRAINT professor_pk PRIMARY KEY (professor_id),
    CONSTRAINT professor_fk FOREIGN KEY (department) REFERENCES department(department_id)
);
