CREATE TABLE IF NOT EXISTS teaching(
    professor_id VARCHAR(30) NOT NULL,
    course_id VARCHAR(7) NOT NULL,
    course_year INTEGER(4) UNSIGNED NOT NULL,
    course_semester INTEGER(1) UNSIGNED NOT NULL,
    course_section INTEGER(2) UNSIGNED NOT NULL,
    CONSTRAINT teaching_pk PRIMARY KEY (professor_id,course_id,course_year,course_semester,course_section),
    CONSTRAINT teaching_fk1 FOREIGN KEY (professor_id) REFERENCES professor(professor_id),
    CONSTRAINT teaching_fk2 FOREIGN KEY (course_id,course_year,course_semester,course_section)
    REFERENCES course_section(course_id,course_year,course_semester,course_section)
);
