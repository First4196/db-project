CREATE TABLE IF NOT EXISTS course(
    course_id VARCHAR(7) NOT NULL,
    course_name_en VARCHAR(50),
    course_name_th VARCHAR(50),
    course_abbrev VARCHAR(20),
    credit INTEGER(3),
    CONSTRAINT course_pk PRIMARY KEY (course_id),
    CONSTRAINT name_not_null CHECK(course_name_en IS NOT NULL
	OR course_name_th IS NOT NULL),
    CONSTRAINT non_negative_credit CHECK(credit >= 0)
);
