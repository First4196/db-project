CREATE TABLE IF NOT EXISTS curriculum(
    curriculum_id VARCHAR(5) NOT NULL,
    name_en VARCHAR(50),
    name_th VARCHAR(50),
    start_year INTEGER(4),
    faculty CHAR(2),
    CONSTRAINT curricululm_pk PRIMARY KEY (curriculum_id),
    CONSTRAINT cuuriculum_fk FOREIGN KEY (faculty) REFERENCES faculty(faculty_code),
    CONSTRAINT curriculum_name_not_null CHECK(name_en IS NOT NULL OR name_th IS NOT NULL),
    CONSTRAINT curriculum_start_year CHECK(start_year >= 1899 AND start_year <= YEAR(CURDATE())+5)
);
