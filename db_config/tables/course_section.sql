CREATE TABLE IF NOT EXISTS course_section(
    course_id VARCHAR(7) NOT NULL,
    course_year INTEGER(4) NOT NULL,
    course_semester INTEGER(1) UNSIGNED NOT NULL,
    course_section INTEGER(2) UNSIGNED NOT NULL,
    capacity INTEGER(4) UNSIGNED,
    student_count INTEGER(4) UNSIGNED,
    CONSTRAINT course_section_pk PRIMARY KEY (course_id, course_year, course_semester, course_section),
    CONSTRAINT course_section_fk1 FOREIGN KEY (course_id, course_year, course_semester)
    REFERENCES course_sem(course_id, course_year, course_semester)
);
