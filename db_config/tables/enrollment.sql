CREATE TABLE IF NOT EXISTS enrollment(
    student_id VARCHAR(11) NOT NULL,
    course_id VARCHAR(7) NOT NULL,
    course_year INTEGER(4) NOT NULL,
    course_semester INTEGER(1) NOT NULL,
    course_section INTEGER(2) NOT NULL,
    CONSTRAINT enrollment_pk PRIMARY KEY (student_id,course_id,course_year,course_semester,course_section),
    CONSTRAINT enrollment_fk1 FOREIGN KEY (student_id) REFERENCES student(student_id),
    CONSTRAINT enrollment_fk2 FOREIGN KEY (course_id,course_year,course_semester,course_section)
    REFERENCES course_section(course_id,course_year,course_semester,course_section)
);
