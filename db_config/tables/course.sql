CREATE TABLE IF NOT EXISTS course(
    course_id VARCHAR(7) NOT NULL,
    course_name VARCHAR(50),
    course_abbrev VARCHAR(20),
    credit INTEGER(3),
    CONSTRAINT course_pk PRIMARY KEY (course_id)
);