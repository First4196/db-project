CREATE TABLE IF NOT EXISTS course(
    course_id VARCHAR(7) NOT NULL,
    course_name_en VARCHAR(50),
    course_name_th VARCHAR(50),
    course_abbrev VARCHAR(20),
    credit INTEGER(3),
    prerequisite VARCHAR(7),
    CONSTRAINT course_pk PRIMARY KEY (course_id)
);
