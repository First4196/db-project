CREATE TABLE IF NOT EXISTS faculty(
    faculty_code CHAR(2) NOT NULL,
    name_en VARCHAR(50),
    name_th VARCHAR(50),
    name_abbrev VARCHAR(15),
    CONSTRAINT faculty_pk PRIMARY KEY (faculty_code)
);
