CREATE TABLE IF NOT EXISTS professor(
    professor_id VARCHAR(30) NOT NULL,
    fname_en VARCHAR(50) NOT NULL,
    lname_en VARCHAR(50) NOT NULL,
    fname_th VARCHAR(50),
    lname_th VARCHAR(50),
    name_abbrev VARCHAR(3),
    date_of_birth DATE,
    address VARCHAR(100),
    mobile_no VARCHAR(15),
    email VARCHAR(50),
    department CHAR(4),
    CONSTRAINT professor_pk PRIMARY KEY (professor_id),
    CONSTRAINT professor_fk FOREIGN KEY (department) REFERENCES department(department_id),
    CONSTRAINT professor_age CHECK(TIMEDIFF(date_of_birth, CURDATE()) > 17),
    CONSTRAINT professor_mobile_no CHECK(mobile_no REGEXP '^[+]{0,1}[0-9]+$'),
    CONSTRAINT professor_email CHECK(email LIKE '%_@__%.__%')
);
